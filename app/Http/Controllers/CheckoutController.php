<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $this->flashWarning('Your cart is empty.');
            return redirect()->route('cart.index');
        }

        $cart_data->calculateSubtotal();

        $shippings = Shipping::orderBy('price')->get();

        return view('pages.default.checkoutpage', compact('cart_data', 'shippings'));
    }

    /**
     * Validates the form and routes to the right payment flow.
     *
     * Form-level failures (no payment method, terms not accepted) are surfaced via
     * PhpFlasher toast so the UI stays consistent with the rest of the application.
     * Field-level @error directives in the view still fire via withErrors().
     */
    public function submit(Request $request)
    {
        $shippingIds = Shipping::pluck('id')->toArray();

        $validator = Validator::make($request->all(), [
            'shipping_id'    => ['required', 'in:' . implode(',', $shippingIds)],
            'payment_method' => ['required', 'in:credit_card,bank_transfer,cheque,cash_on_delivery'],
            'terms'          => ['required', 'accepted'],
        ], [
            'shipping_id.required'    => 'Please select a shipping method.',
            'shipping_id.in'          => 'Invalid shipping method selected.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in'       => 'Invalid payment method selected.',
            'terms.required'          => 'You must accept the Terms & Conditions to continue.',
            'terms.accepted'          => 'You must accept the Terms & Conditions to continue.',
        ]);

        if ($validator->fails()) {
            // Surface the first error as a toast; @error directives handle inline feedback
            $this->flashError($validator->errors()->first());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $method = $request->input('payment_method');

        // credit card goes through Stripe; store shipping in session for the payment controller
        if ($method === 'credit_card') {
            session(['checkout_shipping_id' => (int) $request->input('shipping_id')]);
            return redirect()->route('checkout.payment.index', ['payment' => 'stripe']);
        }

        return $this->createDirectOrder($request, $method);
    }

    /**
     * Creates an order directly for non-Stripe payment methods.
     */
    private function createDirectOrder(Request $request, string $method)
    {
        $user = Auth::user();
        $cart_data = $user->products()->withPrices()->get();

        if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $cart_data->calculateSubtotal();

        $shipping    = Shipping::findOrFail((int) $request->input('shipping_id'));
        $subtotal    = $cart_data->getSubtotal();
        $orderTotal  = $subtotal + $shipping->price;

        $order = new Order();
        $order->user_id             = $user->id;
        $order->order_no            = 'MMTT-' . strtoupper(uniqid());
        $order->subtotal            = $subtotal;
        $order->total               = $orderTotal;
        $order->payment_provider    = $method;
        $order->payment_id          = 'direct-' . uniqid();
        $order->shipping_id         = $shipping->id;
        $order->shipping_address_id = 1;
        $order->billing_address_id  = 1;
        $order->payment_status      = 'pending';
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
