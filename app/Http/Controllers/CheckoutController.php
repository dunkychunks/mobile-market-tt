<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    use PhpFlasher;

    // stub - reserved for future points redemption at checkout
    public function points()
    {
        return redirect()->route('checkout.index');
    }

    public function index()
    {
        $user = Auth::user();

        $cart_data = $user->products()->withPrices()->get();

        if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }

        $cart_data->calculateSubtotal();

        return view('pages.default.checkoutpage', compact('cart_data'));
    }

    /**
     * Validates the form and routes to the right payment flow.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', 'in:credit_card,bank_transfer,cheque,cash_on_delivery'],
            'terms'          => ['required', 'accepted'],
        ], [
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in'       => 'Invalid payment method selected.',
            'terms.required'          => 'You must accept the Terms & Conditions to continue.',
            'terms.accepted'          => 'You must accept the Terms & Conditions to continue.',
        ]);

        $method = $request->input('payment_method');

        // credit card goes through Stripe; everything else is handled here
        if ($method === 'credit_card') {
            return redirect()->route('checkout.payment.index', ['payment' => 'stripe']);
        }

        return $this->createDirectOrder($method);
    }

    /**
     * Creates an order directly for non-Stripe payment methods.
     */
    private function createDirectOrder(string $method)
    {
        $user = Auth::user();
        $cart_data = $user->products()->withPrices()->get();

        if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $cart_data->calculateSubtotal();

        // payment_status depends on method - bank transfer is treated as confirmed for demo
        $status = match($method) {
            'bank_transfer'    => 'paid',
            'cheque'           => 'pending',
            'cash_on_delivery' => 'pending',
            default            => 'pending',
        };

        $order = new Order();
        $order->user_id             = $user->id;
        $order->order_no            = 'MMTT-' . strtoupper(uniqid());
        $order->subtotal            = $cart_data->getSubtotal();
        $order->total               = $cart_data->getTotal();
        $order->payment_provider    = $method;
        $order->payment_id          = 'direct-' . uniqid();
        $order->shipping_id         = 1;
        $order->shipping_address_id = 1;
        $order->billing_address_id  = 1;
        $order->payment_status      = $status;
        $order->payment_method      = $method;
        $order->save();

        // save line items against the order
        $records = [];
        foreach ($cart_data as $data) {
            $records[] = new OrderProduct([
                'product_id' => $data->id,
                'user_id'    => $user->id,
                'price'      => $data->getPrice(),
                'quantity'   => $data->pivot->quantity,
            ]);
        }
        $order->order_products()->saveMany($records);

        // award loyalty points (10 per dollar)
        $points = (int)($order->total * 10);
        $user->increment('points_balance', $points);

        // clear the cart now that order is saved
        $user->products()->detach();

        $this->flashSuccess('Order placed successfully!');

        return redirect()->route('checkout.success', ['id' => $order->payment_id]);
    }
}
