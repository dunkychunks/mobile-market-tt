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

        $shippings     = Shipping::orderBy('price')->get();
        $pointsBalance = $user->points_balance;

        return view('pages.default.checkoutpage', compact('cart_data', 'shippings', 'pointsBalance'));
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
            'shipping_id'      => ['required', 'in:' . implode(',', $shippingIds)],
            'payment_method'   => ['required', 'in:credit_card,bank_transfer,cheque,cash_on_delivery'],
            'terms'            => ['required', 'accepted'],
            'points_to_redeem' => ['nullable', 'integer', 'min:0'],
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

        /*
         * Points redemption rules (viva talking point):
         *   - 100 points = $1 discount
         *   - Minimum redemption: 500 points ($5 off)
         *   - Maximum redemption: 50% of the cart subtotal
         *   - Cannot redeem more points than the user currently holds
         *
         * These rules are validated here (server-side) and enforced again in
         * createDirectOrder() when the discount is applied to the order total.
         */
        $pointsToRedeem = (int) $request->input('points_to_redeem', 0);
        if ($pointsToRedeem > 0) {
            $user = Auth::user();
            $cart = $user->products()->withPrices()->get();
            $cart->calculateSubtotal();
            $subtotal        = $cart->getSubtotal();
            $pointsDiscount  = $pointsToRedeem / 100;
            $maxDiscount     = $subtotal * 0.5;

            if ($pointsToRedeem < 500) {
                $this->flashError('Minimum redemption is 500 points ($5 off).');
                return redirect()->back()->withInput();
            }
            if ($pointsToRedeem > $user->points_balance) {
                $this->flashError('You only have ' . $user->points_balance . ' points available.');
                return redirect()->back()->withInput();
            }
            if ($pointsDiscount > $maxDiscount) {
                $maxPoints = (int) ($maxDiscount * 100);
                $this->flashError('Maximum redemption is 50% of your subtotal (' . $maxPoints . ' points / $' . number_format($maxDiscount, 2) . ').');
                return redirect()->back()->withInput();
            }
        }

        // Tier 3 gate: Free Express Shipping (price = $0) is exclusive to Tier 3 members.
        // The tier check uses the relationship loaded on the current user; tier_id 3 = Tier 3.
        $selectedShipping = Shipping::find((int) $request->input('shipping_id'));
        if ($selectedShipping && (float) $selectedShipping->price === 0.0) {
            $user = Auth::user()->load('tier');
            if (!$user->tier || $user->tier->title !== 'Tier 3') {
                $this->flashError('Free Express Shipping is a Tier 3 benefit. Spend $1,000 to unlock.');
                // Revert selection to Standard Shipping (id 1) in the re-rendered form
                return redirect()->back()
                    ->withInput(array_merge($request->all(), ['shipping_id' => 1]))
                    ->withErrors(['shipping_id' => 'Free Express Shipping requires Tier 3.']);
            }
        }

        $method = $request->input('payment_method');

        // credit card goes through Stripe; store shipping and points in session
        if ($method === 'credit_card') {
            session([
                'checkout_shipping_id'      => (int) $request->input('shipping_id'),
                'checkout_points_to_redeem' => $pointsToRedeem,
            ]);
            return redirect()->route('checkout.payment.index', ['payment' => 'stripe']);
        }

        return $this->createDirectOrder($request, $method, $pointsToRedeem);
    }

    /**
     * Creates an order directly for non-Stripe payment methods.
     * $pointsToRedeem has already been validated in submit().
     */
    private function createDirectOrder(Request $request, string $method, int $pointsToRedeem = 0)
    {
        $user = Auth::user();
        $cart_data = $user->products()->withPrices()->get();

        if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $cart_data->calculateSubtotal();

        $shipping       = Shipping::findOrFail((int) $request->input('shipping_id'));
        $subtotal       = $cart_data->getSubtotal();
        $pointsDiscount = $pointsToRedeem / 100;
        $orderTotal     = max(0, $subtotal + $shipping->price - $pointsDiscount);

        $order = new Order();
        $order->user_id             = $user->id;
        $order->order_no            = 'MMTT-' . strtoupper(uniqid());
        $order->subtotal            = $subtotal;
        $order->total               = $orderTotal;
        $order->points_redeemed     = $pointsToRedeem;
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

        // Deduct redeemed points then award 10 pts per $1 of the discounted total
        if ($pointsToRedeem > 0) {
            $user->decrement('points_balance', $pointsToRedeem);
            $this->flashInfo('Applied $' . number_format($pointsDiscount, 2) . ' discount from ' . $pointsToRedeem . ' points.');
        }
        $pointsEarned = (int)($order->total * 10);
        $user->increment('points_balance', $pointsEarned);

        // clear the cart now that order is saved
        $user->products()->detach();

        $this->flashSuccess('Order placed successfully!');

        return redirect()->route('checkout.success', ['id' => $order->payment_id]);
    }
}
