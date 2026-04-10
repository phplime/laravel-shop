<div>
    {{-- Overlay --}}
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>

    {{-- Sidebar --}}
    <div class="cart-sidebar" id="cartSidebar" wire:ignore.self>

        {{-- Header --}}
        <div class="cart-hd">
            <h5>
                <i class="bi bi-cart3 me-2" style="color:var(--green)"></i>
                <?= __('your_cart'); ?>
                <span id="cartBadgeText" style="color:var(--text-muted);font-weight:400;font-size:.82rem">( {{ $summary['total_count'] ?? 0 }} {{ ($summary['total_count'] ?? 0) == 1 ? 'item' : 'items' }} )</span>
            </h5>
            <button class="cart-x" onclick="closeCart()"><i class="bi bi-x-lg"></i></button>
        </div>

        {{-- Use unified summary component --}}
        <div class="cart-body js-cart-items" id="cartBody">
            @livewire('cart.summary', ['page' => 'sidebar'])
        </div>

        {{-- Footer checkout button --}}
        @if(($summary['total_count'] ?? 0) > 0)
            <div class="cart-ft" id="cartFt">
                <a href='<?= url("checkout") ?>' class="checkout-btn">
                    <i class="bi bi-bag-check me-2"></i><?= __('checkout'); ?>
                </a>
            </div>
        @endif

    </div>

    @script
    <script>
        $wire.on('open-cart-sidebar', () => {
            if (typeof openCart === 'function') openCart();
        });
    </script>
    @endscript
</div>