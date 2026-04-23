<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Models\tier\Tier;

class UpdateUserTier
{
    public function __construct()
    {
        //
    }

    public function handle(OrderPaid $event): void
    {
        $user = $event->order->user;

        if (is_null($user)) {
            return;
        }

        $totalSpending = $user->orders()->where('payment_status', 'paid')->sum('total');

        $newTier = Tier::where('spending_range', '<=', $totalSpending)
            ->orderBy('spending_range', 'desc')
            ->first();

        if ($newTier && $user->tier_id !== $newTier->id) {
            $user->tier_id = $newTier->id;
            $user->save();
            session(['tier_just_upgraded_to' => $newTier->id]);
        }
    }
}
