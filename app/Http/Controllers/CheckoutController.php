<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService         $cart,
        protected OrderService $orderService
    ) {}

    public function index()
    {
        if ($this->cart->isEmpty()) {
            return redirect(url('/'))->with('error', 'Your cart is empty.');
        }

        return view('profile.pages.checkout', [
            'summary' => $this->orderService->fullSummary($this->cart),
        ]);
    }

    public function setOrderType(Request $request)
    {
        $request->validate(['order_type' => 'required|string|exists:vendor_order_type_config,order_type']);
        $vendorId = $request->input('vendor_id', __activeVendor('id'));

        if ($vendorId > 0) {
            $this->orderService->setOrderType($vendorId, $request->order_type);
        }

        $summary = $this->orderService->fullSummary($this->cart);
        return response()->json([
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }

    public function setTip(Request $request)
    {
        $request->validate([
            'type'  => 'required|in:flat,percentage',
            'value' => 'required|numeric|min:0',
        ]);
        $vendorId = $request->input('vendor_id', __activeVendor('id'));

        if ($vendorId > 0) {
            $this->orderService->setTip($vendorId, $request->type, (float) $request->value);
        }

        $summary = $this->orderService->fullSummary($this->cart);
        return response()->json([
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $vendorId = $request->input('vendor_id', __activeVendor('id'));

        $result = ['success' => false, 'message' => 'No vendor context.'];
        if ($vendorId > 0) {
            $result = $this->orderService->applyCoupon($vendorId, $request->code, $this->cart->total());
        }

        $summary = $this->orderService->fullSummary($this->cart);
        $result['summary'] = $summary;
        $result['items_html']  = view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render();
        $result['totals_html'] = view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render();

        return response()->json($result);
    }

    public function removeCoupon(Request $request)
    {
        $vendorId = $request->input('vendor_id', __activeVendor('id'));
        if ($vendorId > 0) {
            $this->orderService->removeCoupon($vendorId);
        }

        $summary = $this->orderService->fullSummary($this->cart);
        return response()->json([
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }
}
