<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use App\Events\OrderPaid;
use App\Helpers\TierHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\StripeCheckoutSuccess;

class CheckoutSuccessController extends Controller
{
    use PhpFlasher;

    public function index($id)
    {
        // direct orders (non-Stripe) use a "direct-" prefixed payment_id
        if (str_starts_with($id, 'direct-')) {
            $order = Order::with(['products', 'shipping'])->where('payment_id', $id)->first();

            if (!$order) {
                abort(404);
            }
        } else {
            // Stripe flow - validate the session with the payment provider
            $stripe_check = new StripeCheckoutSuccess();
            $succesfull = $stripe_check->updateCheckoutOrder($id);

            if (!$succesfull) {
                abort(404);
            }

            $order = Order::with(['products', 'shipping'])->where('payment_id', $id)->first();

            // fire the OrderPaid event (handles tier auto-upgrade)
            OrderPaid::dispatch($order);

            // award 10 points per dollar spent
            $pointsAwarded = (int)($order->total * 10);
            $order->user->increment('points_balance', $pointsAwarded);
        }

        // reload user so tier helper sees the latest spending/points data
        $tier_helper = new TierHelper(Auth::user()->fresh()->load('tier'));
        $tier_helper->checkTierProgress();

        return view('pages.default.checkout-successpage', compact('order', 'tier_helper'));
    }
}
