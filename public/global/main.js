$(function () {
    // Shared UI logic
    $(document).on('click', '.customer__login', function () {
        if ($(this).closest('.login').length > 0) {
            $('.checkout_registerArea').slideDown();
            $('.checkout_loginArea').slideUp();
        } else {
            $('.checkout_registerArea').slideUp();
            $('.checkout_loginArea').slideDown();
        }
    });

    $(document).on('input', '.ck-input, input, select, textarea', function () {
        $(this).removeClass('is-invalid');
        $(this).siblings('.field-error').hide().text('');
    });

    $(document).on('click', 'input[name="is_guest_login"]', function () {
        $('.checkout_loginBody').toggleClass('active');
        if ($('.checkout_loginBody').hasClass('active')) {
            $('.checkout_loginBody').slideDown();
        } else {
            $('.checkout_loginBody').slideUp();
        }
    });

    // Desktop expandable search
    $(document).on("click", ".si-btn", function (e) {
        const parent = $(this).closest(".desk-search");
        if (!parent.hasClass("active")) {
            e.preventDefault();
            e.stopPropagation();
            parent.addClass("active");
            parent.find("input").focus();
        }
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest(".desk-search").length) {
            $(".desk-search").removeClass("active");
        }
    });
});

// Theme Toggle
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', newTheme);
    document.body.classList.remove('theme-light', 'theme-dark');
    document.body.classList.add('theme-' + newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcons(newTheme);
}

function updateThemeIcons(theme) {
    const icons = document.querySelectorAll('#themeIcon, #themeIconMob');
    icons.forEach(icon => {
        if (theme === 'dark') {
            icon.classList.remove('bi-moon-stars-fill');
            icon.classList.add('bi-sun-fill');
        } else {
            icon.classList.remove('bi-sun-fill');
            icon.classList.add('bi-moon-stars-fill');
        }
    });
}

// Global Cart UI Controls
function openCart() {
    document.getElementById('cartSidebar')?.classList.add('open');
    document.getElementById('cartOverlay')?.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeCart() {
    document.getElementById('cartSidebar')?.classList.remove('open');
    document.getElementById('cartOverlay')?.classList.remove('open');
    document.body.style.overflow = '';
}

// Initial icon setup
$(function () {
    const savedTheme = localStorage.getItem('theme') || 'light';
    updateThemeIcons(savedTheme);
});

// Helper for waiting for Livewire
function withLivewire(callback) {
    if (typeof Livewire !== 'undefined') {
        callback();
    } else {
        document.addEventListener('livewire:init', callback);
    }
}

/**
 * Handle Item Details AJAX Loading (Old/Working JS Method)
 */
$(document).on('click', '[data-fetch-item], .itemView, .singleItemView', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const $this = $(this);
    let url = $this.data('url');
    const target = $this.data('target') || '#itemModalContent';
    const modal = $this.data('modal') || '#itemDetailsModal';

    // If card only has ID, construct URL
    if (!url) {
        const id = $this.data('id') || $this.data('item-id') || $this.data('uid');
        if (id && typeof vendorSlug !== 'undefined' && vendorSlug) {
            url = base_url.replace(/\/$/, '') + '/' + vendorSlug + '/item/' + id;
        }
    }

    if (url && target) {
        $(target).html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div></div>');
        if (modal) $(modal).modal('show');

        $.get(url, function (res) {
            // Support both object {load: ""} and raw string
            const html = (typeof res === 'object' && res.load) ? res.load : (typeof res === 'string' ? res : '');
            if (html) {
                $(target).html(html);

                // Re-initialize item details logic (prices, extras, etc.)
                if (typeof window.initItemDetails === 'function') {
                    window.initItemDetails();
                }

                // Re-trigger lazy loading if applicable
                if (typeof window.lazyLoad === 'function') {
                    window.lazyLoad();
                }
            } else {
                $(target).html('<div class="alert alert-warning m-3">Empty response from server.</div>');
            }
        }).fail(function () {
            $(target).html('<div class="alert alert-danger m-3">Could not load item details.</div>');
        });
    }
});

/**
 * Global Add To Cart Bridge
 */
function addToCart(btn) {
    if (btn.classList.contains('adding')) return;

    const $form = $(btn).closest('form');

    // 1. Validate Form (Required Extras, etc.)
    if (typeof window.validateForm === 'function') {
        if (!window.validateForm()) {
            console.warn('Form validation failed');
            return;
        }
    }

    $form.find('.errorMessage').hide().text('');

    const productId = $form.find('input[name="product_id"]').val();
    const quantity = $form.find('input[name="quantity"]').val() || $form.find('input[name="qty"]').val() || 1;
    const variantId = $form.find('input[name="item_size"]:checked').val() || null;

    // Collect Extras
    const extras = {};
    $form.find('input[name^="extras"]').each(function () {
        if ($(this).is(':checked')) {
            const extraId = $(this).val();
            const qtyInput = $form.find('input[name="extra_qty[' + extraId + ']"]');
            extras[extraId] = qtyInput.length > 0 ? parseInt(qtyInput.val()) : 1;
        }
    });

    console.log('--- addToCart Initialized ---', { productId, quantity, variantId, extras });

    if (!productId) {
        console.error('addToCart: No Product ID found!');
        return;
    }

    // Animation
    btn.classList.add('adding');

    // Dispatch to Livewire Sidebar
    withLivewire(() => {
        console.log('Dispatching add-to-cart to Livewire...');
        Livewire.dispatch('add-to-cart', {
            productId: productId,
            quantity: parseInt(quantity),
            variantId: variantId,
            options: {
                extras: extras
            }
        });
    });

    // Cleanup & Close Modal
    setTimeout(() => {
        btn.classList.remove('adding');
        $('#itemDetailsModal').modal('hide');
        // Optional: Open cart if not already open
        if (typeof openCart === 'function') openCart();
    }, 600);
}

// Global Qty Helpers
function incQty(btn) {
    const input = btn.parentNode.querySelector('input');
    if (input) {
        input.value = parseInt(input.value) + 1;
        $(input).trigger('change');
    }
}
function decQty(btn) {
    const input = btn.parentNode.querySelector('input');
    if (input && parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        $(input).trigger('change');
    }
}
