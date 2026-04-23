<?php

namespace App\Http\Controllers;

use App\Traits\PhpFlasher;
use App\Helpers\ShippingHelper;
use App\Helpers\StripeCheckout;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class CheckoutPaymentController extends Controller
{
    use PhpFlasher;

    /**
     * Coordinates the checkout process, bridging the shopping cart,
     * the local database, and the external payment gateway.
     *
     * @param string $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($payment)
    {
        $user = Auth::user();
        $shipping_helper = new ShippingHelper();
        $stripe_checkout = new StripeCheckout();
        $order = new Order();
        $insert_data = [];
        $completed = false;

        // Retrieve cart items and their current prices
        $cart_data = $user->products()->withPrices()->get();

        // Prevent processing of empty carts
        if ($cart_data->isEmpty()) {
            $this->flashWarning('Your cart is empty.');
            return redirect()->route('cart.index');
        }

        $cart_data->calculateSubtotal();

        // Route logic based on the selected payment provider
        switch ($payment) {
            case 'stripe':
                // Initialize the external API handshake
                $stripe_checkout->startCheckoutSession();
                $stripe_checkout->addEmail($user->email);
                $stripe_checkout->addProducts($cart_data);
                $stripe_checkout->addPointsCoupon();
                $stripe_checkout->enablePromoCodes();
                $stripe_checkout->addShippingOptions($shipping_helper->getGroupShippingOptions());

                // Finalize the session generation on Stripe's servers
                $stripe_checkout->createSession();

                // Retrieve the generated session token to link our local record to Stripe
                $insert_data = $stripe_checkout->getOrderCreateData();
                $completed = true;
                break;

            default:
                // Fallback for development testing
                $insert_data = [
                    'payment_provider' => 'testing',
                    'payment_id' => 'testing',
                ];
                $completed = true;
                break;
        }

        if (!$completed || empty($insert_data)) {
            dd('Payment is incomplete or checkout is missing');
        }

        // Database Persistence: Save the primary order details
        $order->user_id = $user->id;
        $order->order_no = 'MMTT-' . strtoupper(uniqid()); // Generate unique order reference
        $order->subtotal = $cart_data->getSubtotal();
        $order->total = $cart_data->getTotal();
        $order->payment_provider = $insert_data['payment_provider'];
        $order->payment_id = $insert_data['payment_id']; // The 'cs_test_...' string
        $order->shipping_id = 1;
        $order->shipping_address_id = 1;
        $order->billing_address_id = 1;
        $order->payment_status = 'unpaid'; // Set initial state pending confirmation
        $order->payment_method = 'credit_card';
        $order->save();

        // Database Persistence: Save individual line items mapped to the order
        $records = [];
        foreach ($cart_data as $data) {
            array_push($records, new OrderProduct([
                'product_id' => $data->id,
                'user_id' => $user->id,
                'price' => $data->getPrice(),
                'quantity' => $data->pivot->quantity
            ]));
        }
        $order->order_products()->saveMany($records);

        // Clear the user's cart now that the order has been successfully staged
        $user->products()->detach();

        // Redirect the user to finalize the transaction
        if ($payment == 'stripe') {
            return redirect($stripe_checkout->getUrl());
        }

        $this->flashSuccess('Order placed successfully!');
        return redirect()->route('checkout.success', ['id' => $order->payment_id]);
    }
}
