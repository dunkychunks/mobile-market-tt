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
    public $next_tier; // next tier available
    public $max_tier; // max tier available
    public $next_tier_amount = 0;
    public $next_tier_percent = 0;
    public $max_tier_amount = 0;
    public $max_tier_percent = 0;
    private $user;
    private $testing = true; //true/false


    /**
     * Undocumented function
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        if (is_null($user->tier)) {
            throw new \RuntimeException('User has no tier assigned.');
        }

        $this->user = $user;
        $this->getUserTier();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getUserTier()
    {
        $this->spending = $this->getUserSpending($this->user);

        $this->tier = $this->getTier($this->spending);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testing()
    {
        if ($this->testing) {
            $this->spending_before = 600; // last purchase
            $this->spending = 2500; // total spending
            $this->tier_before = $this->getTier($this->spending - $this->spending_before);
            $this->tier = $this->getTier($this->spending);
            $this->next_tier = $this->getNextTier($this->spending);
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function checkTierProgress()
    {
        try {
            $this->testing();

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

            $total = Order::where('user_id', $this->user->id)
                ->where('payment_status', 'paid')
                ->get()
                ->last()
                ->total ?? 0;

            $this->spending_before = $this->spending - $total;
            $this->tier_before = $this->getTier($this->spending - $total);
            $this->testing();
            $this->tier_upgraded = $this->compareTier($this->tier_before, $this->tier);

            $this->is_valid = true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ============================== QUERIES ==============================

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function getUserSpending(User $user)
    {
        return $user->orders()->where('payment_status', 'paid')->sum('total');
    }

    /**
     * Undocumented function
     *
     * @param [type] $total_spending
     * @return void
     */
    public function getTier($total_spending)
    {
        return Tier::where('spending_range', '<=', $total_spending)->orderBy('spending_range', 'desc')->limit(1)->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $total_spending
     * @return void
     */
    public function getNextTier($total_spending)
    {
        return Tier::where('spending_range', '>', $total_spending)->orderBy('spending_range')->limit(1)->first();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getMaxTier()
    {
        return Tier::orderByDesc('spending_range')->first();
    }

    // ============================== CALCULATIONS / OPERATIONS ==============================

    /**
     * Undocumented function
     *
     * @param Tier $next_tier
     * @param [type] $total_spending
     * @return void
     */
    public function calculateNextTierAmount(Tier $next_tier, $total_spending)
    {
        return !empty($next_tier) ? $next_tier->spending_range - $total_spending : 0;
    }

    /**
     * Undocumented function
     *
     * @param [type] $total_spending
     * @param [type] $next_tier_spending
     * @return void
     */
    public function calculateNextTierPercent($total_spending, $next_tier_spending)
    {
        return (int) (($total_spending / $next_tier_spending) * 100);
    }

    /**
     * Undocumented function
     *
     * @param [type] $tier_before
     * @param [type] $tier
     * @return void
     */
    public function compareTier($tier_before, $tier)
    {
        return $tier->spending_range <=> $tier_before->spending_range;
    }

    /**
     * Undocumented function
     *
     * @param Tier $next_tier
     * @return void
     */
    public function nextTierProgress(Tier $next_tier)
    {
        $this->next_tier_amount = $this->calculateNextTierAmount($next_tier, $this->spending);

        $progress = $this->spending - $this->tier->spending_range;
        $range = $this->next_tier->spending_range - $this->tier->spending_range;

        $this->next_tier_percent = $this->calculateNextTierPercent($progress, $range);
    }

    // ============================== QUICK CHECKS ==============================

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->is_valid;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasNextTier()
    {
        return !empty($this->next_tier) ? true : false;
    }
}
