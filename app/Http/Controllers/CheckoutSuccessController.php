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
        $stripe_check = new StripeCheckoutSuccess();

        $succesfull = $stripe_check->updateCheckoutOrder($id);

        if (!$succesfull) {
            abort(404);
        }

        $order = Order::where('payment_id', $id)->first();

        OrderPaid::dispatch($order);

        // award 10 points per dollar spent (as per gamification spec)
        $pointsAwarded = (int)($order->total * 10);
        $order->user->increment('points_balance', $pointsAwarded);

        // reload user so tier helper sees up-to-date data after tier update
        $tier_helper = new TierHelper(Auth::user()->fresh()->load('tier'));
        $tier_helper->checkTierProgress();

        return view('pages.default.checkout-successpage', compact('order', 'tier_helper'));
    }
}
