<?php

namespace App\Helpers;

class StripeClient
{
    public static function getClient()
    {
        try {
            return new \Stripe\StripeClient(env('STRIPE_SECRET', false));
        } catch (\Exception $e) {
            echo 'Invalid API key';
            exit;
        }
    }
}
