<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Schema;
use App\Repositories\BaseRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    protected $baseRepo;
    protected $vendorRepo;

    public function __construct(BaseRepository $baseRepo, VendorRepository $vendorRepo)
    {
        $this->baseRepo = $baseRepo;
        $this->vendorRepo = $vendorRepo;
        //check login user
        if (!Auth::user()) {
            return redirect()->route('login');
        }
    }

    public function add_language_data(Request $request)
    {
        $slug = Make::slug($request->keyword); // normalize keyword

        // Check if keyword already exists
        $exists = LanguageData::where('keyword', $slug)->exists();
        if ($exists) {
            return __request(0, "{$slug} Keyword already exists", '');
        }

        // Validate value
        try {
            $request->validate([
                'keyword' => 'required|string',
                'value' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        // Insert new record
        $language = LanguageData::create([
            'keyword' => $slug,
            'en' => $request->value,
        ]);

        if ($language) {
            return __request(1, __('success_text'), url('admin/language-data?isAjax=1'));
        }

        return __request(0, 'Save change error!!', '');
    }

    public function add_payment_config(Request $request)
    {
        if (isset($request->is_paypal) && $request->is_paypal == 1) {
            try {
                $request->validate([
                    'paypal_email' => 'required|string',
                    'paypal_environment' => 'required|string',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors()->all();
                return __request(0, $errors, '');
            }
        }

        if (isset($request->is_stripe) && $request->is_stripe == 1) {
            try {
                $request->validate([
                    'stripe_public_key' => 'required|string',
                    'stripe_secret_key' => 'required|string',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors()->all();
                return __request(0, $errors, '');
            }
        }

        $user_id = $request->user_id ?? 0;

        $payment_data = [
            'paypal' => [
                'paypal_email' => $request->paypal_email,
                'paypal_environment' => $request->paypal_environment ?? 'sandbox',
                'is_paypal' => $request->is_paypal == 1 ? 1 : 0,
            ],
            'stripe' => [
                'is_stripe' => $request->is_stripe == 1 ? 1 : 0,
                'stripe_public_key' => $request->stripe_public_key,
                'stripe_secret_key' => $request->stripe_secret_key,
            ],
        ];


        foreach ($payment_data as $slug => $data) {
            if (isset($user_id) && !empty($user_id)) {
                $update = $this->baseRepo->updateWhere(['config' => json_encode($data)], ['slug' => $slug, 'user_id' => $user_id], 'vendor_payment_list');
            } else {
                $update = $this->baseRepo->updateWhere(['config' => json_encode($data)], ['slug' => $slug], 'payment_gateway_list');
            }
        }


        if ($update) {
            return __request(1, __('success_text'), url('admin/settings/payment-settings?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }


    public function dashboard_redirect()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard.index');
        }
        return redirect()->route('vendor.dashboard.index');
    }

    public function switch_language($code)
    {
        $language = \Illuminate\Support\Facades\DB::table('language_list')
            ->where('slug', $code)
            ->where('status', 1)
            ->first();

        if ($language) {
            session(['locale' => $code]);
            app()->setLocale($code);
        }

        return redirect()->back();
    }

    public function item_delete($id, $table)
    {
        $user = Auth::user();
        $vendorId = $this->vendorRepo->vendorId();
        $shopId = $this->vendorRepo->vendorId();

        if (!$user) {
            return __request(0, __('login_required'), route('login'));
        }

        // Check if table exists to prevent SQL injection or errors
        if (!Schema::hasTable($table)) {
            return __request(0, __('table_not_found'), '');
        }

        $query = DB::table($table)->where('id', $id);

        // If not admin, enforce ownership checks
        if ($user->role !== 'admin') {
            $hasUserId = Schema::hasColumn($table, 'user_id');
            $hasVendorId = Schema::hasColumn($table, 'vendor_id');
            $hasShopId = Schema::hasColumn($table, 'shop_id');

            $query->where(function ($q) use ($user, $hasUserId, $hasVendorId, $hasShopId, $vendorId, $shopId) {
                if ($hasUserId) {
                    $q->where('user_id', $user->id);
                }

                if ($hasVendorId) {
                    if ($vendorId) {
                        $q->orWhere('vendor_id', $vendorId);
                    }
                }

                if ($hasShopId) {
                    if ($shopId) {
                        $q->orWhere('shop_id', $shopId);
                    }
                }

                // If no ownership columns exist, deny access (fail-safe)
                if (!$hasUserId && !$hasVendorId && !$hasShopId) {
                    $q->whereRaw('1 = 0');
                }
            });
        }

        $item = $query->first();

        if ($item) {
            $query->delete();
            return __request(1, __('deleted_successfully'), '');
        } else {
            return __request(0, __('item_not_found_or_access_denied'), '');
        }
    }
}
