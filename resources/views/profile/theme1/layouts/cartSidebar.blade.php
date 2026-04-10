<!-- ═════════════════════════════════════════
     CART SIDEBAR
════════════════════════════════════════════ -->

<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-sidebar" id="cartSidebar">

    {{-- Header --}}
    <div class="cart-hd">
        <h5 id="cartHeaderContainer">
            <i class="bi bi-cart3 me-2" style="color:var(--green)"></i>
            <?= __('your_cart'); ?>
            <span style="color:var(--text-muted);font-weight:400;font-size:.82rem" id="cartBadgeText">(0 items)</span>
        </h5>
        <button class="cart-x" onclick="closeCart()"><i class="bi bi-x-lg"></i></button>
    </div>

    {{-- Items list --}}
    <div class="cart-body js-cart-items" id="cartBody">
        <div class="cart-empty">
            <i class="bi bi-cart-x" style="font-size:2.5rem;color:var(--text-muted)"></i>
            <p style="margin-top:.5rem;color:var(--text-muted)"><?= __('your_cart_is_empty'); ?></p>
        </div>
    </div>

    {{-- Footer totals --}}
    <div class="cart-ft" id="cartFt" style="display:none">
        <div id="cartTotalsContainer" class="js-cart-totals"></div>
        <a href='<?= url("{$vendor->username}/checkout") ?>' class="checkout-btn">
            <i class="bi bi-bag-check me-2"></i><?= __('checkout'); ?>
        </a>
    </div>

</div>

@push('scripts')
<script>
    /** 
     * Cart Sync Logic
     * Simplified to use direct jQuery .html() updates with chunks from the server.
     */
    function syncCartUI(json) {
        if (!json.items_html) return;

        const count = json.cart_count || 0;

        // Update all items containers (sidebar & checkout)
        $('.js-cart-items').html(json.items_html);

        // Update all totals containers (sidebar & checkout)
        $('.js-cart-totals').html(json.totals_html);

        // Update global counters & badges
        $('.cart-badge, #cartCount, .js-cart-count').text(count);
        $('#summaryCount').text(`${count} items`);
        $('#cartBadgeText').text(`(${count} ${count === 1 ? 'item' : 'items'})`);

        // Toggle sidebar footer visibility
        const ft = document.getElementById('cartFt');
        if (ft) ft.style.display = count > 0 ? 'block' : 'none';
    }

    /** Unified cart action helper */
    window.cartAction = function(method, url, data = {}) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        // Show global loader
        if (window.loader) window.loader.show();

        fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: (method !== 'GET' && method !== 'DELETE') ? JSON.stringify(data) : undefined,
            })
            .then(r => r.json())
            .then(json => {
                if (json.st == 1 || json.summary) {
                    syncCartUI(json);
                }
                if (json.message && method !== 'GET') {
                    if (typeof MSG !== 'undefined') MSG('success', json.message);
                }
            })
            .catch(err => {
                console.error('Cart Action Error:', err);
                if (typeof MSG !== 'undefined') MSG('error', 'Something went wrong');
            })
            .finally(() => {
                if (window.loader) window.loader.hide();
            });
    };

    /* ── Hydrate on load ─────── */
    document.addEventListener('DOMContentLoaded', function() {
        cartAction('GET', '/cart');
    });
</script>
@endpush