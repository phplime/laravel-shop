<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\SubscriptionService;
use App\Support\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public $vendorId = 0;
    public $isVendor = 0;
    public $subscriptionId = 0;
    public $userId = 0;
    public $vendorInfo = [];
    public $userInfo = [];
    protected $subscriptionService;
    protected $paymentService;
    public $order;

    public function __construct(SubscriptionService $subscriptionService, PaymentService $paymentService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->paymentService = $paymentService;
        $this->order = session('order_data') ?? [];
    }

    public function index($userIdentifier = null, $packageIdentifier = null)
    {
        $data = [];
        if (empty($userIdentifier)) {
            return redirect()->back();
        }

        // Set user and vendor info
        $this->checkVendor($userIdentifier, $packageIdentifier);

        $data['page_title'] = 'Payment Method';
        $data['slug'] = $userIdentifier;
        $data['package_slug'] = $packageIdentifier;
        $data['u_info'] = $this->subscriptionService->findUser($userIdentifier);

        // if ($this->isVendor == 1) {
        //     $data['vendor_id'] = $this->vendorId;

        //     // Assuming vendor_m is a model or repository not available here, using DB fallback
        //     // $orderData = $this->vendor_m->single_order_uid($packageIdentifier);

        //     $orderData = null;
        //     if (empty($this->order)) {
        //         $orderData = DB::table('vendor_order_list')->where('uid', $packageIdentifier)->first();
        //         $data['order'] = $orderData;
        //     } else {
        //         $data['order'] = $this->order;
        //     }

        //     $data['order_info'] = [
        //         'name' => $this->order['name'] ?? '',
        //         'email' => $this->order['email'] ?? '',
        //         'phone' => $this->order['phone'] ?? '',
        //         'is_vendor' => $this->isVendor,
        //         'vendor_id' => $this->vendorId,
        //         'currency' => __settings('currency_code', $this->vendorId),
        //     ];

        //     $data['invoice_info'] = (object) ['total' => $this->order['total'] ?? ($data['order']->total ?? 0)];
        // }

        if ($this->isVendor == 0) {
            $data['order_info'] = [
                'name' => $data['u_info']->name ?? $data['u_info']->username ?? '',
                'email' => $data['u_info']->email ?? '',
                'phone' => $data['u_info']->phone ?? '',
                'is_vendor' => $this->isVendor,
                'vendor_id' => $this->vendorId,
                'currency' => __settings('currency'),
            ];

            $packageInfo = $this->subscriptionService->getPackageInfo($packageIdentifier);
            $data['invoice_info'] = $this->get_invoice_info(array_merge($data['u_info']->toArray(), $packageInfo->toArray()));
        }

        if (request()->ajax()) {
            $method = request('method');
            $data['method'] = $method;
            $data['config'] = $this->paymentService->getCredentials($userIdentifier, $method, $this->isVendor);
            return view('payment.inc.' . $method, $data)->render();
        }

        // Initial load with method param
        if (request()->has('method')) {
            $method = request('method');
            $data['active_method'] = $method;
            $data['method'] = $method;
            $data['config'] = $this->paymentService->getCredentials($userIdentifier, $method, $this->isVendor);
        }

        return view('payment.payment_gateway', $data);
    }

    private function checkVendor($userIdentifier = null, $packageIdentifier = null)
    {
        $userinfo = $this->subscriptionService->findUser($userIdentifier);
        // $packageinfo = $this->subscriptionService->getPackageInfo($packageIdentifier); // Not used

        if (!$userinfo) {
            return;
        }

        $vendorInfo = DB::table('vendor_list')->where('user_id', $userinfo->id)->first();

        if (isset($vendorInfo->id)) {
            $this->isVendor = 1;
            $this->vendorId = $vendorInfo->id;
            $this->userId = $userinfo->id; // Fixed: user_id -> id
            $this->vendorInfo = $vendorInfo;
        } else {
            $this->isVendor = 0;
            $this->userId = $userinfo->id;
            $this->userInfo = $userinfo;
            $this->subscriptionId = $userinfo->subscription_id ?? 0;
        }
    }

    function get_invoice_info($invoice_info)
    {

        $tax_percent = __settings('tax_percent') ?? 0;

        $subtotal = $invoice_info['price'] ?? $invoice_info['package_price'] ?? 0;

        $tax_fee = !empty($tax_percent) ? getPercent($subtotal, $tax_percent) : 0;

        $total = $subtotal + $tax_fee;

        $order_id = Make::serialize('subscription_list', 'order_id', 0, 5);

        $calculated_data = [
            'package_id' => $invoice_info['id'] ?? 0,
            'subtotal' => $subtotal,
            'tax_fee' => $tax_fee,
            'total' => $total,
            'order_id' => $order_id,
            'tax_percent' => $tax_percent,
            'created_at' => dateTime(),
        ];

        return array_merge($invoice_info, $calculated_data);
    }




    public function process($slug = null, $package_slug = null, $method = null)
    {
        if (empty($slug) || empty($method)) {
            return redirect()->back()->with('error', __('invalid_information'));
        }

        $this->checkVendor($slug, $package_slug);
        $payment_credentials = $this->paymentService->getCredentials($slug, $method, $this->isVendor);


        if (empty($payment_credentials)) {
            return redirect()->back()->with('error', __('invalid_credentials'));
        }


        switch ($method) {
            case 'stripe':
                return $this->paymentService->stripe_process($slug, $package_slug, $payment_credentials);
            case 'paypal':
                return $this->paypal($slug, $package_slug, $payment_credentials);
            default:
                return redirect()->back()->with('error', __('invalid_payment_method'));
        }
    }



    public function paypal($slug = null, $package_slug = null)
    {
        // 1. Get Data using request() helper (works for GET/POST)
        $input = request()->all();

        // Validation
        if (empty($input) || !isset($input['amt'])) {
            return redirect()->back()->with('error', __('invalid_information'));
        }

        // 2. Prepare Payment Data
        $payData = [
            'amount' => $input['amt'],
            'currency' => $input['cc'],
            'status' => $input['st'],
            'method' => 'paypal',
            'payment_by' => 'self',
            'is_payment' => 1,
            'txn_id' => $input['txn_id'],
            'all_info' => json_encode($input),
        ];

        try {
            // 3. Prepare Additional Data based on User Type
            $additionalData = [];

            if ($this->isVendor == 0) {
                // Customer Logic
                $additionalData = [
                    'is_expired' => 0,
                    'active_date' => dateTime(),
                    'payment_date' => dateTime(),
                ];
            } elseif ($this->isVendor == 1) {
                // Vendor Logic
                if (empty($this->order)) {
                    // Fetch order using Eloquent
                    $orderData = VendorOrder::where('uid', $package_slug)->first();
                    $this->order = $orderData ? $orderData->toArray() : [];
                }

                if (empty($this->order)) {
                    throw new \Exception('Order not found');
                }

                $additionalData = [
                    'vendor_id' => $this->vendorId,
                    'user_id' => $this->userId,
                    'order_id' => $this->order['uid'],
                    'is_online_payment' => 1,
                    'created_at' => now(),
                    'order_type' => $this->order['order_type'],
                ];
            }

            // Merge data
            $finalData = array_merge($payData, $additionalData);

            // 4. Call Service
            $result = $this->paymentService->addPaymentInfo($slug, $finalData, $this->isVendor);

            // 5. Handle Response

            // Check if service returned a specific redirect URL
            if (isset($result['redirectUrl'])) {
                return redirect()->to($result['redirectUrl']);
            }
            dd($result['error']);
            // Check if service returned an error
            if (isset($result['error'])) {

                $this->sendFailed($result);
                return redirect()->route('payment.failed');
            }
        } catch (\Exception $e) {

            dd($e->getMessage());
            // Optional: Log error
            // \Log::error('PayPal Error: ' . $e->getMessage());

            // return redirect()->route('payment.failed')
            //     ->with('error', $e->getMessage());
        }
    }


    public function success($slug = null, $order_id = null)
    {
        $data = [];
        if (!empty($slug)) {
            $data['u_info'] = $this->subscriptionService->findUser($slug);
        }
        $data['page_title'] = 'Success';
        return view('payment.success', $data);
    }



    public function failed()
    {
        $data = [];
        $errorMessage = null;
        $sessionError = session()->get('temp_payment_error');
        if ($sessionError && now()->lt($sessionError['expires_at'])) {
            $errorMessage = $sessionError['message'];
        } else {
            session()->forget('temp_payment_error');
        }
        $data['page_title'] = 'Payment failed';
        $data['meta_description'] = 'Payment failed';
        $data['error'] = $errorMessage;
        return view('payment.failed', $data);
    }


    public function sendFailed($result)
    {
        session()->put('temp_payment_error', [
            'message' => $result['error'],
            'expires_at' => now()->addMinutes(3)
        ]);
    }



    public function prepareSubscriptionPaymentData($invoice_info)
    {
        $payData = [
            'amount' => $invoice_info['amount'],
            'currency' => $invoice_info['currency'],
            'status' => $invoice_info['status'],
            'method' => 'self',
            'payment_by' => 'self',
            'is_payment' => 1,
            'txn_id' => $invoice_info['txn_id'],
            'all_info' => json_encode($invoice_info),
        ];

        return $payData;
    }
}
