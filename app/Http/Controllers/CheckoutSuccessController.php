<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use App\Events\OrderPaid;            // Added: Event for Gamification triggers
use App\Helpers\TierHelper;          // Added: Helper for loyalty calculations
use Illuminate\Support\Facades\Auth; // Added: Facade for the authenticated user
use App\Helpers\StripeCheckoutSuccess; // Essential import for payment verification

class CheckoutSuccessController extends Controller
{
    use PhpFlasher;

    /**
     * Finalizes the transaction lifecycle upon the user's return from the payment gateway.
     */
    public function index($id)
    {
        // Initialize the verification helper
        $stripe_check = new StripeCheckoutSuccess();

        // Verifies the session ID with Stripe and updates the local database status to 'paid'
        $succesfull = $stripe_check->updateCheckoutOrder($id);

        // Implement secure fallback if the session ID is invalid or the transaction failed
        if (!$succesfull) {
            abort(404);
        }

        // Retrieve the verified order record to populate the receipt view
        $order = Order::where('payment_id', $id)->first();

                // FEATURE::Tiers - Event/Listener to update user after an order
        $order = Order::findOrFail($stripe_checkout->order_id);
        OrderPaid::dispatch($order);

        // FEATURE::Tiers - Checkout success
        $tier_helper = new TierHelper(Auth::user()->load('tier'));
        $tier_helper->checkTierProgress();



        return view('pages.default.checkout-successpage', compact('order'));
    }
}
