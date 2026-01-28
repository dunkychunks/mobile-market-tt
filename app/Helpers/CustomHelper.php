<?php

namespace App\Helpers;

use Carbon\Carbon;

class CustomHelper
{
    /**
     * Show price with 2 decimal place, $400.00.
     *
     * @param [double] $price to format
     * @return void
     */
    public static function formatPrice($price)
    {
        return number_format($price, 2, '.', '');
    }


    /**
     * Date as text, April 30th, 2024.
     * Mainly used.
     *
     * @param [string] $date to format
     * @return Carbon date formatted
     */
    public static function dateToReadable($dateString)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dateString)
            ->format('F jS, Y');
    }


    /**
     * Date as text, Tuesday, April 30th 2024
     *
     * @param [string] $dateString
     * @return Carbon date formatted
     */
    public static function dateToReadableFull($dateString)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dateString)
            ->format('l, F jS Y');
    }


    /**
     * Date as text, Tue, Apr 30th 2024
     *
     * @param [string] $dateString
     * @return Carbon date formatted
     */
    public static function dateToReadableFullAbbr($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('D, M jS Y');
    }




    /**
     * Get price after a discount is applied.
     *
     * @param [double] $total
     * @param [int] $discount
     * @return void
     */
    public static function calculateDiscountedPrice($total, $discount)
    {
        // $value = $total - (($discount / 100) * $total);
        $value = $total - bcmul(bcdiv($discount, 100, 10), $total, 10);

        return number_format($value, 2, '.', '');
    }

    /**
     * What is x percent of a value
     *
     * @param [double] $total
     * @param [int] $percent
     * @return void
     */
    public static function calculatePercentOf($total, $percent)
    {
        return number_format(bcmul(bcdiv($percent, 100, 10), $total, 10), 2);
    }


    /**
     * Format date to Tue 30 Apr, 2024.
     * Outdated
     *
     * @param [string] $dateString
     *
     * @return void
     */
    public static function formatDateToReadable($dateString)
    {
        $date = date_create($dateString);

        return date_format($date, 'D d M, Y');
    }


    public static function createOrderID($prefix = 'ORD')
    {
        $orderID = $prefix . '-' . time() . '-' . Str::random(5);

        return $orderID;
    }
}
