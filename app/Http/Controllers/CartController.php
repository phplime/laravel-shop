<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService         $cart,
        protected OrderService $orderService
    ) {}

    public function index()
    {
        $summary = $this->orderService->fullSummary($this->cart);

        if (request()->expectsJson()) {
            return response()->json([
                'st'          => 1,
                'summary'     => $summary,
                'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
                'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
                'cart_count'  => $summary['total_count'],
            ]);
        }

        return redirect()->route('checkout.index');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:vendor_item_list,id',
            'quantity'   => 'integer|min:1',
            'variant_id' => 'nullable|string',
            'options'    => 'nullable|array',
        ]);

        $product = Product::findOrFail($request->product_id);

        $this->cart->add(
            $product,
            $request->input('quantity', 1),
            $request->input('variant_id'),
            $request->input('options', [])
        );

        $summary = $this->orderService->fullSummary($this->cart);

        return response()->json([
            'st'          => 1,
            'message'     => 'Item added to cart.',
            'cart_count'  => $summary['total_count'],
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }

    public function update(Request $request, int $cartItemId)
    {
        $request->validate(['quantity' => 'required|integer|min:0']);

        $this->cart->update($cartItemId, $request->quantity);
        $summary = $this->orderService->fullSummary($this->cart);

        return response()->json([
            'st'          => 1,
            'message'     => 'Cart updated.',
            'cart_count'  => $summary['total_count'],
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }

    public function remove(int $cartItemId)
    {
        $this->cart->remove($cartItemId);
        $summary = $this->orderService->fullSummary($this->cart);

        return response()->json([
            'st'          => 1,
            'message'     => 'Item removed.',
            'cart_count'  => $summary['total_count'],
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }

    public function clear()
    {
        $this->cart->clear();
        $summary = $this->orderService->fullSummary($this->cart);

        return response()->json([
            'st'          => 1,
            'message'     => 'Cart cleared.',
            'summary'     => $summary,
            'items_html'  => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'items'])->render(),
            'totals_html' => view('profile.theme1.layouts.ajax_cart_summary', ['summary' => $summary, 'chunk' => 'totals'])->render(),
        ]);
    }
}
