@if(isset($chunk) && $chunk == 'items')
    @forelse($summary['items_by_vendor'] ?? [] as $vendorId => $items)
        @foreach($items as $item)
            @include('profile.common_layouts.ajax_cart_item', ['item' => $item])
        @endforeach
    @empty
        <div class="cart-empty">
            <i class="bi bi-cart-x" style="font-size:2.5rem;color:var(--text-muted)"></i>
            <p style="margin-top:.5rem;color:var(--text-muted)">Your cart is empty</p>
        </div>
    @endforelse
@elseif(isset($chunk) && $chunk == 'totals')
    {!! __cartOrder($summary) !!}
@else
    @if(isset($page) && $page == 'checkout')
        <div class="summary-card">
            <div class="summary-header">
                <h3><i class="bi bi-receipt me-1"></i> Order Summary</h3>
                <span class="item-count-pill" id="summaryCount">{{ $summary['total_count'] }} items</span>
            </div>

            <div class="summary-items js-cart-items">
                @foreach($summary['items_by_vendor'] as $vendorId => $items)
                    @foreach($items as $item)
                        @include('profile.common_layouts.ajax_cart_item', ['item' => $item])
                    @endforeach
                @endforeach
            </div>

            {{-- Promo --}}
            <div class="promo-row">
                <input type="text" class="ck-input" id="promoInput" placeholder="Promo code">
                <button class="promo-apply-btn" id="promoApplyBtn" onclick="CK.applyPromo()">Apply</button>
                <button class="promo-remove-btn" id="promoRemoveBtn" onclick="CK.removePromo()">
                    <i class="bi bi-x-circle"></i> Remove
                </button>
            </div>

            <div class="summary-totals js-cart-totals">
                {!! __cartOrder($summary) !!}
            </div>

            <div class="summary-action">
                <button class="place-order-btn" id="placeOrderBtn" onclick="CK.placeOrder()">
                    <i class="bi bi-bag-check-fill"></i> Place Order
                </button>
            </div>

            <div class="trust-row">
                <div class="trust-item"><i class="bi bi-shield-check"></i> Secure</div>
                <div class="trust-item"><i class="bi bi-truck"></i> Fast delivery</div>
                <div class="trust-item"><i class="bi bi-arrow-counterclockwise"></i> Refundable</div>
            </div>
        </div>
    @else
        @php
            $itemsByVendor = $summary['items_by_vendor'] ?? [];
            $totalCount = $summary['total_count'] ?? 0;
        @endphp

        <div class="cart-header-data" data-count="{{ $totalCount }}">
            Your Cart <span style="color:var(--text-muted);font-weight:400;font-size:.82rem">({{ $totalCount }} {{ $totalCount == 1 ? 'item' : 'items' }})</span>
        </div>

        <div class="cart-items-list js-cart-items" id="cartItemsList">
            @forelse($itemsByVendor as $vendorId => $items)
                @foreach($items as $item)
                    @include('profile.common_layouts.ajax_cart_item', ['item' => $item])
                @endforeach
            @empty
                <div class="cart-empty">
                    <i class="bi bi-cart-x" style="font-size:2.5rem;color:var(--text-muted)"></i>
                    <p style="margin-top:.5rem;color:var(--text-muted)">Your cart is empty</p>
                </div>
            @endforelse
        </div>

        <div class="cart-totals-data js-cart-totals" id="cartTotalsData">
            @if($totalCount > 0)
                {!! __cartOrder($summary) !!}
            @endif
        </div>
    @endif
@endif