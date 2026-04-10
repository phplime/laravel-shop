<div>
    @if($page == 'checkout')
        <div class="summary-card">
            <div class="summary-header">
                <h3><i class="bi bi-receipt me-1"></i> Order Summary</h3>
                <span class="item-count-pill" id="summaryCount">{{ $summary['total_count'] ?? 0 }} items</span>
            </div>

            <div class="summary-items">
                @foreach($summary['items_by_vendor'] ?? [] as $items)
                    @foreach($items as $item)
                        @php
                            $thumb = !empty($item['product']['thumb']) ? __image($item['product']['thumb']) : 'https://placehold.co/80x80/1a1a2e/ffffff?text=%F0%9F%8D%BD';
                        @endphp
                        <div class="cart-row" wire:key="checkout-item-{{ $item['id'] }}">
                            <img src="<?= $thumb ?>" alt="<?= $item['product']['name'] ?? 'Item' ?>">
                            <div class="cri" style="flex:1">
                                <h6 style="margin:0"><?= $item['product']['name'] ?? 'Item' ?></h6>
                                <div class="cp" style="font-weight:600;font-size:.9rem;color:var(--green)"><?= __currency_position($item['price']) ?></div>
                            </div>
                            <div class="cqty">
                                <button class="cq-btn" wire:click="decrement({{ $item['id'] }})">
                                    @if($item['quantity'] > 1) − @else <i class="bi bi-trash"></i> @endif
                                </button>
                                <input type="number" value="<?= $item['quantity'] ?>" readonly class="qty-input">
                                <button class="cq-btn" wire:click="increment({{ $item['id'] }})">+</button>
                            </div>
                        </div>
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
        {{-- Default sidebar summary or partial items --}}
        <div class="cart-items-list js-cart-items" id="cartItemsList">
            @forelse($summary['items_by_vendor'] ?? [] as $items)
                @foreach($items as $item)
                    @php
                        $thumb = !empty($item['product']['thumb']) ? __image($item['product']['thumb']) : 'https://placehold.co/80x80/1a1a2e/ffffff?text=%F0%9F%8D%BD';
                    @endphp
                    <div class="cart-row" wire:key="sidebar-item-{{ $item['id'] }}">
                        <img src="<?= $thumb ?>" alt="<?= $item['product']['name'] ?? 'Item' ?>">
                        <div class="cri">
                            <h6><?= $item['product']['name'] ?? 'Item' ?></h6>
                            <div class="cp"><?= __currency_position($item['price']) ?></div>
                            @if (!empty($item['vendor']['app_name']))
                                <div class="ck"><i class="bi bi-shop me-1"></i><?= $item['vendor']['app_name'] ?></div>
                            @endif
                        </div>
                        <div class="cqty">
                            <button class="cq-btn" wire:click="decrement({{ $item['id'] }})">
                                @if($item['quantity'] > 1) − @else <i class="bi bi-trash"></i> @endif
                            </button>
                            <input type="number" value="<?= $item['quantity'] ?>" readonly class="qty-input">
                            <button class="cq-btn" wire:click="increment({{ $item['id'] }})">+</button>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="cart-empty">
                    <i class="bi bi-cart-x" style="font-size:2.5rem;color:var(--text-muted)"></i>
                    <p style="margin-top:.5rem;color:var(--text-muted)"><?= __('your_cart_is_empty'); ?></p>
                </div>
            @endforelse
        </div>

        @if(($summary['total_count'] ?? 0) > 0)
        <div class="cart-totals-data js-cart-totals">
                {!! __cartOrder($summary) !!}
        </div>
        @endif
    @endif
</div>