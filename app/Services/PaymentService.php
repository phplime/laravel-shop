<?php

namespace App\Services;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\DB;

class PaymentService
{

    public $vendorId = 0;
    public $isVendor = 0;
    public $subscriptionId = 0;
    public $userId = 0;
    public $vendorInfo = [];
    public $userInfo = [];


    public $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }



    public function stripe_process($slug = null, $package_slug = null, $credentials = null)
    {
        $amount = request()->amount ?? 0;

        $stripeClient = new \Stripe\StripeClient($credentials->stripe_secret_key);

        $checkout_session = $stripeClient->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => $credentials->currency,
                    'product_data' => [
                        'name' => $slug,
                    ],
                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url("payment/stripe/{$slug}/{$package_slug}?token={CHECKOUT_SESSION_ID}"),
            'cancel_url' => url("payment/cancel/{$slug}?method=stripe"),
        ]);

        header("HTTP/1.1 303 See Other");
        redirect($checkout_session->url);
    }






    public function addPaymentInfo(string $username, array $data, bool $isVendor = false)
    {
        return DB::transaction(function () use ($username, $data, $isVendor) {
            try {
                $user = $this->subscriptionService->findUser($username);
                // --- Customer Logic (Subscription) ---

                if ($isVendor == 0) {
                    // Mark all user's previous subscriptions as expired
                    Subscription::where('user_id', $user->id)
                        ->update(['is_expired' => 1]);

                    // Update the specific subscription
                    $subscription = Subscription::findOrFail($user->subscription_id);



                    if (!$subscription->update($data)) {
                        return ['error' => __('Failed to update subscription')];
                    }

                    return ['redirectUrl' => "payment/success/{$username}?txn_id={$data['txn_id']}&method={$data['method']}&amount={$data['amount']}"];
                }

                // --- Vendor Logic (Order) ---
                if ($isVendor) {
                    // 1. Update or Create Order
                    // If order with 'uid' exists, update it. Otherwise create new.
                    $orderData = array_merge($this->order, [
                        'payment_status' => 'paid',
                        'payment_method' => $data['method'],
                        'is_online_payment' => 1
                    ]);

                    VendorOrder::updateOrCreate(
                        ['uid' => $this->order['uid']], // Unique check
                        $orderData                      // Data to insert/update
                    );

                    // 2. Update or Create Payment Info
                    OrderPaymentInfo::updateOrCreate(
                        [
                            'order_id' => $this->order['uid'],
                            'vendor_id' => $this->vendor_id
                        ],
                        $data
                    );

                    // 3. Clear Cart (Assuming a Cart service or method exists)
                    // Cart::clear(); 
                    // Or if it's in the controller:
                    // $this->clearCart();

                    return ['redirectUrl' => "success/{$data['uid']}?txn_id={$data['txn_id']}&method={$data['method']}&amount={$data['amount']}"];
                }
            } catch (\Exception $e) {
                // Log the error
                // Log::error('Failed to add payment info: ' . $e->getMessage(), [
                //     'slug' => $username,
                //     'data' => $data,
                //     'is_vendor' => $isVendor
                // ]);

                return ['error' => $e->getMessage()];
            }
        });
    }


    public function getCredentials($username, $method, $isVendor)
    {
        $config = '';
        if ($isVendor == 1) {
            $config = __config($method . '_config', $username);
        } else {
            $payment = DB::table('payment_gateway_list')->where('slug', $method)->first();
            $config = !empty($payment->config) && isJson($payment->config) ? json_decode($payment->config) : '';
        }

        return $config;
    }
}
