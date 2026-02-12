<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Helpers\ShippingHelper;
use App\Helpers\StripeCheckout;

class CheckoutPaymentController extends Controller
{


    /**
     * Undocumented function
     *
     * @param [type] $payment
     * @return void
     */
    public function index($payment)
    {
         // Get groups - check if user is authenticated, which group they belong to, no group automatic assigned to group 1
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        // Get user - gets current user and stores in variable - the auth facade fetches the user model
        $user = Auth::user();

        // Create variables
        $shipping_helper = new ShippingHelper();
        $stripe_checkout = new StripeCheckout();
        $order = new Order();
        $insert_data = [];
        $completed = false;

        // Get products - gets all prodcts user added to cart to determine if there is anything to checkout
         $cart_data = $user->products()->withPrices()->get();

        // Check if cart is empty - if cart is empty go back o cart page since there is nothing to checkout
             if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }
        
        // Get Subtotal
        $cart_data->calculateSubtotal();

        // Determine payment
        switch ($payment) {
            case 'stripe':
                # code...
                break;
            default:
                $insert_data = [
                    'payment_provider' => 'testing',
                    'payment_id' => 'testing',
                ];
                $completed = true;
                break;
        }

        // Validate
        if (!$completed || empty($insert_data)) {
            dd('Payment is incomplete or checkout is missing');
        }

        // Create order details

        // Create order details

        // Redirect
    }
}
