<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class StripeCheckout
{
    // Stripe api key to authenticate requests
    protected $stripe;
    // A customer's session as they pay
    protected $checkout_session;
    // Data needed for stripe pre-built checkout
    protected $stripe_checkout_data = [];
    // variable to determine if coupon was used or not
    private $coupon_used = false;
    // Add checkout session id to url
    private const URL_ID = '{CHECKOUT_SESSION_ID}';

    public function __construct()
    {
        $this->stripe = StripeClient::getClient();
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function startCheckoutSession()
    {
        $YOUR_DOMAIN = url('');
        $this->stripe_checkout_data = [
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/checkout/success/' . self::URL_ID,
            'cancel_url' => $YOUR_DOMAIN . '/checkout',
        ];
    }


    /**
     * Undocumented function
     * Source: https://docs.stripe.com/checkout/quickstartt
     * Source: https://docs.stripe.com/payments/accept-a-payment
     *
     * @param Collection $products_data
     * @return void
     */
    public function addProducts(Collection $products_data)
    {
        $line_items = [];
        foreach ($products_data as $data) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $data->title,
                        'images' => ['https://img.freepik.com/free-photo/shopping-cart-front-side_187299-40118.jpg?w=826&t=st=1694476992~exp=1694477592~hmac=ed69117d05f541bbc1b719146a75df3ceba0afeef9797d4bafb4c4faaa90437d'],
                    ],
                    'unit_amount' => $data->getPrice() * 100,
                ],
                'quantity' => $data->pivot->quantity,
            ];
            $this->stripe_checkout_data['line_items'] = $line_items;
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function createSession()
    {
        header('Content-Type: application/json');
        $this->checkout_session = $this->stripe->checkout->sessions->create($this->stripe_checkout_data);
        header("HTTP/1.1 303 See Other");
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getUrl()
    {
        return $this->checkout_session->url;
    }

    /**
     * ==================== OPTIONAL FUNCTIONS TO ADD TO CHECKOUT SESSION ===========================.
     */


    /**
     * Undocumented function
     *
     * @param [type] $email
     * @return void
     */
    public function addEmail($email)
    {
        $this->stripe_checkout_data['customer_email'] = $email;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function addPointsCoupon()
    {
        return false;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function enablePromoCodes()
    {

        if ($this->coupon_used) {
            return false;
        }

        $this->stripe_checkout_data['allow_promotion_codes'] = true;
        return true;
    }

    /**
     * Undocumented function
     *
     * @param Collection $shipping_data
     * @return void
     */
    public function addShippingOptions(Collection $shipping_data)
    {
        $shipping_options = [];
        foreach ($shipping_data as $data) {
            $shipping_options[] = ['shipping_rate' => $data->stripe_id];
        }

        $this->stripe_checkout_data['shipping_options'] = $shipping_options;
    }

    /**
     * ====================  FUNCTIONS TO RETREIVE A CHECKOUT SESSION ===========================.
     */

    /**
     * Undocumented function
     *
     * @param [type] $session_id
     * @return void
     */
    public function getCheckoutOrder($session_id)
    {
        return $this->stripe->checkout->sessions->retrieve($session_id, []);
    }

    /**
     * Undocumented function
     *
     * @param [type] $checkout_session
     * @return boolean
     */
    public function isCheckoutCompleted($checkout_session)
    {
        return $checkout_session->status = 'complete' && $checkout_session->payment_status = 'paid';
    }

    /**
     * ====================  FUNCTIONS TO DATA FROM A CHECKOUT SESSION ===========================.
     */

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getOrderCreateData()
    {
        return [
            'payment_provider' => 'stripe',
            'payment_id' => $this->checkout_session->id,
        ];
    }

    /**
     * Undocumented function
     *
     * @param [type] $checkout_session
     * @return void
     */
    public function getOrderCompletedData($checkout_session)
    {
        $shipping_stripe_id = $checkout_session->shipping_cost->shipping_rate;

        return [
            'subtotal' => $checkout_session->amount_subtotal / 100,
            'total' => $checkout_session->amount_total / 100,
            'stripe_id' => $shipping_stripe_id,
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testCheckoutSession()
    {
        dd($this->checkout_session);
    }

} // end Class
