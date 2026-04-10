<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Services\CartService;
use App\Services\OrderService;
use App\Models\Product;
use App\Models\Cart;
use Livewire\Attributes\On;

class CartComponent extends Component
{
    public $summary = [];

    protected $listeners = [
        'cart-updated' => 'refreshData',
        'add-to-cart' => 'handleAddToCart'
    ];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $cart = app(CartService::class);
        $orderService = app(OrderService::class);
        $summaryData = $orderService->fullSummary($cart);
        $this->summary = json_decode(json_encode($summaryData), true);
    }

    #[On('add-to-cart')]
    public function handleAddToCart($productId = null, $quantity = 1, $variantId = null, $options = [])
    {
        \Log::debug('Livewire Cart ADD: ', [
            'productId' => $productId,
            'quantity' => $quantity,
            'variantId' => $variantId,
            'options' => $options
        ]);

        try {
            if (!$productId) {
                \Log::warning('handleAddToCart: No Product ID provided');
                return;
            }

            $cart = app(CartService::class);
            $product = Product::find($productId);
            
            if (!$product) {
                \Log::error("handleAddToCart: Product not found [ID: $productId]");
                return;
            }

            $cart->add($product, (int)$quantity, $variantId, $options);
            
            $this->refreshData();
            $this->dispatch('cart-updated');
            $this->dispatch('open-cart-sidebar');
            
            \Log::debug('Cart ADD Success');
        } catch (\Exception $e) {
            \Log::error('CartComponent AddToCart Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
        }
    }

    public function increment($itemId)
    {
        $cart = app(CartService::class);
        $item = Cart::find($itemId);
        if ($item) {
            $cart->update($itemId, $item->quantity + 1);
            $this->refreshData();
            $this->dispatch('cart-updated');
        }
    }

    public function decrement($itemId)
    {
        $cart = app(CartService::class);
        $item = Cart::find($itemId);
        if ($item) {
            if ($item->quantity > 1) {
                $cart->update($itemId, $item->quantity - 1);
            } else {
                $cart->remove($itemId);
            }
            $this->refreshData();
            $this->dispatch('cart-updated');
        }
    }

    public function remove($itemId)
    {
        $cart = app(CartService::class);
        $cart->remove($itemId);
        $this->refreshData();
        $this->dispatch('cart-updated');
    }
}
