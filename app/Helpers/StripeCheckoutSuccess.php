<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Order;
use App\Models\Shipping;

class StripeCheckoutSuccess
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = StripeClient::getClient();
    }

    /**
     * Undocumented function
     *
     * @param [type] $session_id
     * @return void
     */
    public function updateCheckoutOrder($session_id)
    {

        // Get order from the data
        $order = Order::where('payment_id', $session_id)->first();
        if (!$order) {
            return false;
        }

        // Get order from stripe
        $stripe_helper = new StripeCheckout();
        $session = $stripe_helper->getCheckoutOrder($session_id);

        // Extracts data from stripe
        $order_completed_data = $stripe_helper->getOrderCompletedData($session);

        // Validate
        if ($order && $order->payment_status == 'unpaid') {

            $user_id = $order->user_id;
            $user = User::where('id', $user_id)->first();

            // Which shipping did the user select
            $shipping_id = Shipping::where('stripe_id', $order_completed_data['stripe_id'])
                ->get()
                ->first()
                ->id;


            $order->subtotal = $order_completed_data['subtotal'];
            $order->total = $order_completed_data['total'];
            $order->shipping_id = $shipping_id;
            $order->payment_status = 'paid';
            $order->save();

            // User::find($user_id)->products()->detach();

            return true;
        }




        return true;
    }
}
