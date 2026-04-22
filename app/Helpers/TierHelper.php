<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\tier\Tier;
use App\Models\User;

class TierHelper
{
    private $is_valid = false;
    public $spending_before = 0;
    public $spending = 0;
    public $tier_before;
    public $tier;
    public $tier_upgraded = 0;
    public $next_tier;
    public $max_tier;
    public $next_tier_amount = 0;
    public $next_tier_percent = 0;
    public $max_tier_amount = 0;
    public $max_tier_percent = 0;
    private $user;
    private $testing = false;

    public function __construct(User $user)
    {
        if (is_null($user->tier)) {
            throw new \RuntimeException('User has no tier assigned.');
        }

        $this->user = $user;
        $this->getUserTier();
    }

    public function getUserTier()
    {
        $this->spending = $this->getUserSpending($this->user);
        $this->tier = $this->getTier($this->spending);
    }

    public function checkTierProgress()
    {
        try {
            $this->next_tier = $this->getNextTier($this->spending);

            if ($this->next_tier) {
                $this->nextTierProgress($this->next_tier);
            }

            if ($this->next_tier) {
                $max_tier = Tier::orderBy('spending_range', 'desc')->first();
                $this->max_tier = $max_tier;
                $this->max_tier_amount = $this->calculateNextTierAmount($max_tier, $this->spending);
                $this->max_tier_percent = $this->calculateNextTierPercent($this->spending, $max_tier->spending_range);
            }

            $lastOrder = Order::where('user_id', $this->user->id)
                ->where('payment_status', 'paid')
                ->latest()
                ->first();

            $lastTotal = $lastOrder ? $lastOrder->total : 0;

            $this->spending_before = $this->spending - $lastTotal;
            $this->tier_before = $this->getTier($this->spending_before);
            $this->tier_upgraded = $this->compareTier($this->tier_before, $this->tier);

            $this->is_valid = true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ============================== QUERIES ==============================

    public function getUserSpending(User $user)
    {
        return $user->orders()->where('payment_status', 'paid')->sum('total');
    }

    public function getTier($total_spending)
    {
        return Tier::where('spending_range', '<=', $total_spending)
            ->orderBy('spending_range', 'desc')
            ->limit(1)
            ->first();
    }

    public function getNextTier($total_spending)
    {
        return Tier::where('spending_range', '>', $total_spending)
            ->orderBy('spending_range')
            ->limit(1)
            ->first();
    }

    public function getMaxTier()
    {
        return Tier::orderByDesc('spending_range')->first();
    }

    // ============================== CALCULATIONS ==============================

    public function calculateNextTierAmount(Tier $next_tier, $total_spending)
    {
        return !empty($next_tier) ? $next_tier->spending_range - $total_spending : 0;
    }

    public function calculateNextTierPercent($total_spending, $next_tier_spending)
    {
        return (int) (($total_spending / $next_tier_spending) * 100);
    }

    public function compareTier($tier_before, $tier)
    {
        return $tier->spending_range <=> $tier_before->spending_range;
    }

    public function nextTierProgress(Tier $next_tier)
    {
        $this->next_tier_amount = $this->calculateNextTierAmount($next_tier, $this->spending);

        $progress = $this->spending - $this->tier->spending_range;
        $range = $this->next_tier->spending_range - $this->tier->spending_range;

        $this->next_tier_percent = $this->calculateNextTierPercent($progress, $range);
    }

    // ============================== QUICK CHECKS ==============================

    public function isValid()
    {
        return $this->is_valid;
    }

    public function hasNextTier()
    {
        return !empty($this->next_tier) ? true : false;
    }
}
