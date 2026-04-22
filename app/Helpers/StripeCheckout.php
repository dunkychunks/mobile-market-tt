<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Stripe\StripeClient;

class StripeCheckout
{
    protected $stripe;
    protected $checkout_session;
    protected $stripe_checkout_data = [];
    private $coupon_used = false;

    // Constant used by Stripe to dynamically append the secure session token
    private const URL_ID = '{CHECKOUT_SESSION_ID}';

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * Initializes the basic parameters for a secure payment session.
     */
    public function startCheckoutSession()
    {
        $YOUR_DOMAIN = url('');
        $this->stripe_checkout_data = [
            'mode' => 'payment',
            // Tells Stripe where to send the user after a successful payment
            'success_url' => $YOUR_DOMAIN . '/checkout/success/' . self::URL_ID,
            'cancel_url' => $YOUR_DOMAIN . '/checkout',
        ];
    }

    public function addProducts(Collection $products_data)
    {
        $line_items = [];
        foreach ($products_data as $data) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $data->title,
                        'images' => ['https://img.freepik.com/free-photo/shopping-cart-front-side_187299-40118.jpg?w=826'],
                    ],
                    // Stripe expects amounts in cents, so we multiply by 100
                    'unit_amount' => $data->getPrice() * 100,
                ],
                'quantity' => $data->pivot->quantity,
            ];
            $this->stripe_checkout_data['line_items'] = $line_items;
        }
    }

    public function createSession()
    {
        header('Content-Type: application/json');
        // Sends the prepared data payload to Stripe to generate the hosted checkout page
        $this->checkout_session = $this->stripe->checkout->sessions->create($this->stripe_checkout_data);
        header("HTTP/1.1 303 See Other");
    }

    public function getUrl()
    {
        return $this->checkout_session->url;
    }

    public function addEmail($email)
    {
        $this->stripe_checkout_data['customer_email'] = $email;
    }

    public function addPointsCoupon()
    {
        return false;
    }

    public function enablePromoCodes()
    {
        if ($this->coupon_used) {
            return false;
        }
        $this->stripe_checkout_data['allow_promotion_codes'] = true;
        return true;
    }

    public function addShippingOptions(Collection $shipping_data)
    {
        $shipping_options = [];
        foreach ($shipping_data as $data) {
            $shipping_options[] = ['shipping_rate' => $data->stripe_id];
        }
        $this->stripe_checkout_data['shipping_options'] = $shipping_options;
    }

    public function getCheckoutOrder($session_id)
    {
        return $this->stripe->checkout->sessions->retrieve($session_id, []);
    }

    public function isCheckoutCompleted($checkout_session)
    {
        return $checkout_session->status == 'complete' && $checkout_session->payment_status == 'paid';
    }

    /**
     * Extracts the secure session ID to store in the local database for future verification.
     */
    public function getOrderCreateData()
    {
        return [
            'payment_provider' => 'stripe',
            'payment_id' => $this->checkout_session->id,
        ];
    }

    public function getOrderCompletedData($checkout_session)
    {
        $shipping_stripe_id = $checkout_session->shipping_cost->shipping_rate ?? null;

        return [
            'subtotal' => $checkout_session->amount_subtotal / 100,
            'total' => $checkout_session->amount_total / 100,
            'stripe_id' => $shipping_stripe_id,
        ];
    }
}
