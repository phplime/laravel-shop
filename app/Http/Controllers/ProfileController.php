<?php

namespace App\Http\Controllers;

use \App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    protected $vendorRepo;
    protected $vendorId;

    public function __construct(\App\Repositories\VendorRepository $vendorRepo)
    {
        $this->vendorRepo = $vendorRepo;
    }

    public function index($username)
    {
        $vendor = Vendor::where('username', $username)->firstOrFail();
        $this->vendorId = $vendor->id;
        session(['active_vendor_id' => $vendor->id]);

        $data = [];
        $data['page_title'] = 'Profile';
        $data['username'] = $username;
        $data['categories'] = $this->vendorRepo->getCategoryByLanguage($this->vendorId);
        $data['items'] = $this->vendorRepo->getVendorProducts($this->vendorId);

        return view('profile.theme1.home', compact('data', 'vendor'));
    }
    /* ======================================
    Profile Index End
    ======================================== */


    public function home($username)
    {
        $data = [];
        $data['page_title'] = 'Home';
        return view('profile.home', compact('data'));
    }
    /* ======================================
    Home Index Area End
    ======================================== */


    public function menu($username)
    {
        $data = [];
        $data['page_title'] = 'Menu';
        return view('profile.pages.menu', compact('data'));
    }
    /* ======================================
    Menu Index Area End
    ======================================== */


    public function all_items($username)
    {
        $data = [];
        $data['page_title'] = 'Items';
        return view('profile.pages.all_items', compact('data'));
    }
    /* ======================================
    All Items Index Area End
    ======================================== */


    public function special_items($username)
    {
        $data = [];
        $data['page_title'] = 'Special Items';
        return view('profile.pages.special_items', compact('data'));
    }
    /* ======================================
    All Items Index Area End
    ======================================== */



    public function my_order($username)
    {
        $data = [];
        $data['page_title'] = 'My Orders';
        return view('profile.pages.my_order', compact('data'));
    }
    /* ======================================
    My Order Index Area end
    ======================================== */



    public function view_order($username, $order_id)
    {
        $data = [];
        $data['page_title'] = 'View Order';
        return view('profile.pages.view_order', compact('data', 'order_id'));
    }
    /* ======================================
    View Order Index Area End
    ======================================== */



    public function checkout($username, $slug = null)
    {
        $data = [];
        $data['page_title'] = 'Checkout';

        $vendor = Vendor::where('username', $username)->firstOrFail();
        $this->vendorId = $vendor->id;
        session(['active_vendor_id' => $vendor->id]);

        $cart = app(\App\Services\CartService::class);
        $orderService = app(\App\Services\OrderService::class);
        $summary = $orderService->fullSummary($cart);

        if ($summary['total_count'] == 0) {
            return redirect(url('/' . $username));
        }

        return view('profile.pages.checkout', compact('data', 'summary', 'username', 'vendor'));
    }

    public function saveGuest(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $customer = \App\Models\Customer::updateOrCreate(
            ['phone' => $request->phone],
            [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'user_id' => __activeOwnerId(),
                'vendor_id' => __activeVendor('id'),
            ]
        );

        \Illuminate\Support\Facades\Auth::guard('customer')->login($customer);

        app(\App\Services\CartService::class)->mergeGuestCart($customer->id, 'customer');
        app(\App\Services\OrderService::class)->mergeGuestSession($customer->id, 'customer');

        return response()->json(['message' => 'Guest details saved!']);
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['phone' => 'required']);
        return response()->json(['message' => 'OTP sent successfully!', 'expires_in' => 300]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);

        // Mock verification - in real app, check DB/Cache
        if ($request->otp !== '1234') {
            // return response()->json(['message' => 'Invalid OTP'], 422);
        }

        $customer = \App\Models\Customer::where('phone', $request->phone)->first();

        if (!$customer) {
            $customer = \App\Models\Customer::create([
                'phone' => $request->phone,
                'name' => 'Customer ' . substr($request->phone, -4),
                'user_id' => __activeOwnerId(),
                'vendor_id' => __activeVendor('id'),
            ]);
        }

        \Illuminate\Support\Facades\Auth::guard('customer')->login($customer);

        app(\App\Services\CartService::class)->mergeGuestCart($customer->id, 'customer');
        app(\App\Services\OrderService::class)->mergeGuestSession($customer->id, 'customer');

        return response()->json(['message' => 'Phone verified!']);
    }

    public function applyPromo(Request $request)
    {
        return response()->json(['message' => 'Promo applied!', 'discount' => 500, 'total' => 4600]);
    }

    public function removePromo()
    {
        return response()->json(['message' => 'Promo removed!', 'total' => 5100]);
    }

    public function placeOrder(Request $request)
    {
        $rules = [
            'order_type' => 'required|in:delivery,takeaway,dine_in',
            'payment_method' => 'required|string',
        ];

        if ($request->order_type === 'delivery') {
            $rules['street'] = 'required|string';
        }

        if ($request->order_type === 'dine_in') {
            $rules['table_number'] = 'required|string';
            $rules['guest_count'] = 'required|integer|min:1';
        }

        if ($request->payment_method === 'mpesa') {
            $rules['mpesa_phone'] = 'required|string|min:10';
        }

        if ($request->payment_method === 'card' || $request->payment_method === 'stripe') {
            $rules['card_number'] = 'required|string';
            $rules['card_expiry'] = 'required|string';
            $rules['card_cvv'] = 'required|string';
            $rules['card_name'] = 'required|string';
        }

        $request->validate($rules);

        // Here you would normally create the order in DB
        // For now, we return success as it's a placeholder logic

        $username = __activeVendor('username');
        return response()->json([
            'order_id' => 'ORD-' . strtoupper(Str::random(6)),
            'redirect_url' => url(($username ?: '') . '/orders')
        ]);
    }

    public function item_details($username, $slug)
    {
        $vendor = \App\Models\Vendor::where('username', $username)->firstOrFail();
        $vendor_id = $vendor->id;

        $row = $this->vendorRepo->getProductByIdWithDetails($slug, $vendor_id);
        if (!$row) abort(404);

        $extra_list = $this->vendorRepo->getAddonListByItemId($row->id, $vendor_id);

        $data = [];
        $data['row']        = $row;
        $data['extra_list'] = $extra_list;
        $data['vendor_id']  = $vendor_id;
        $data['username']   = $username;

        // 🔥 Key difference
        $data['hideModal'] = request()->ajax() ? false : true;
        $data['page_type'] = request()->ajax() ? 'single-page' : 'modal';
        $data['url'] = url('cart/add');

        if (request()->ajax()) {

            $load = view('profile.common_layouts.item_details_thumb', $data)->render();

            return response()->json([
                'st'   => 1,
                'load' => $load
            ]);
        }

        return view('profile.pages.item_details', $data);
    }
}
