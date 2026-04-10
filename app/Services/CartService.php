<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getIdentifier(): array
    {
        if (Auth::guard('customer')->check()) {
            return ['customer_id' => Auth::guard('customer')->id()];
        }

        return ['session_id' => Session::getId()];
    }

    protected function query()
    {
        return Cart::where($this->getIdentifier());
    }

    public function add($product, int $quantity = 1, ?string $variantId = null, array $options = []): Cart
    {
        $identifier = $this->getIdentifier();

        $cartItem = Cart::where($identifier)
            ->where('product_id', $product->id)
            ->first();



        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            return $cartItem->fresh();
        }

        return Cart::create([
            'user_id'     => __activeOwnerId($product->vendor_id),
            'owner_id'    => __activeOwnerId($product->vendor_id),
            'customer_id' => $identifier['customer_id'] ?? null,
            'session_id'  => $identifier['session_id'] ?? null,
            'vendor_id'   => $product->vendor_id,
            'product_id'  => $product->id,
            'variant_id'  => $variantId ?? '',
            'quantity'    => $quantity,
            'price'       => $product->price,
            'options'     => $options,
        ]);
    }

    public function update(int $cartItemId, int $quantity): bool
    {
        if ($quantity <= 0) {
            return $this->remove($cartItemId);
        }

        return (bool) $this->query()
            ->where('id', $cartItemId)
            ->update(['quantity' => $quantity]);
    }

    public function remove(int $cartItemId): bool
    {
        return (bool) $this->query()
            ->where('id', $cartItemId)
            ->delete();
    }

    public function clear(): bool
    {
        return (bool) $this->query()->delete();
    }

    public function items(): Collection
    {
        return $this->query()->with(['product', 'vendor'])->get();
    }

    public function itemsByVendor(): Collection
    {
        return $this->items()->groupBy('vendor_id');
    }

    public function count(): int
    {
        return $this->query()->sum('quantity');
    }

    public function total(): float
    {
        return (float) $this->query()
            ->selectRaw('SUM(price * quantity) as total')
            ->value('total') ?? 0.0;
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function mergeGuestCart(int $id, string $type = 'user'): void
    {
        $sessionId  = Session::getId();
        $guestItems = Cart::where('session_id', $sessionId)->get();

        $idKey = $type === 'customer' ? 'customer_id' : 'user_id';

        foreach ($guestItems as $guestItem) {
            $existing = Cart::where($idKey, $id)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $guestItem->quantity);
                $guestItem->delete();
            } else {
                $guestItem->update([
                    $idKey       => $id,
                    'session_id' => null,
                ]);
            }
        }
    }
}
