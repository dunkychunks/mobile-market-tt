<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Helpers\TierHelper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = Auth::user()->fresh()->load('tier');
        $tier_helper = new TierHelper($user);
        $tier_helper->checkTierProgress();

        return view('pages.user.profile', compact('user', 'tier_helper'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('products')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.user.orders', compact('orders'));
    }
}
