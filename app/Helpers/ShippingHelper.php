<?php

namespace App\Helpers;

use App\Models\Shipping;

class ShippingHelper
{
    /**
     * Undocumented function
     *
     * @param array $group_ids
     * @return void
     */
    public function getGroupShippingOptions(array $group_ids = [1])
    {
        $data = Shipping::with('shipping_options')
        ->whereHas('shipping_options', function ($query) use ($group_ids) {
            $query->whereIn('group_id', $group_ids);
        })
        ->orderBy('display_order', 'desc')
        ->get();

        return $data;
    }
}
