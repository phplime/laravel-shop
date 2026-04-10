{{-- resources/views/profile/pages/checkout.blade.php --}}
@extends('profile.layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="toast-stack" id="toastStack"></div>

<div class="checkout-page">
    <div class="checkout-wrap">

        {{-- Heading --}}
        <div class="ck-heading">
            <a href="{{ url()->previous() }}" class="back-btn"><i class="bi bi-arrow-left"></i></a>
            <h1>Checkout</h1>
        </div>

        {{-- ═══════════════ LEFT ═══════════════ --}}
        <div class="checkout-left">
            {{-- STEP 1 – ORDER TYPE --}}
            @include('profile.common_layouts.checkout_content.steps.order_type')

            {{-- STEP 2 – YOUR DETAILS --}}
            @include('profile.common_layouts.checkout_content.steps.details')

            {{-- STEP 3 – PAYMENT --}}
            @include('profile.common_layouts.checkout_content.steps.payment')
        </div>{{-- /left --}}

        {{-- ═══════════════ RIGHT: ORDER SUMMARY ═══════════════ --}}
        <div>
            <livewire:cart.summary page="checkout" />
        </div>

    </div>{{-- /checkout-wrap --}}
</div>{{-- /checkout-page --}}
@endsection

@push('scripts')
<script>
    $(function() {
        let customerAuth = `<?= auth('customer')->check() ? 'true' : 'false' ?>`;

        /* ═══ CK – minimal UI logic ═══ */
        window.CK = {

            /* Step 1: Order Type toggle */
            selectOrderType: function(el) {
                $('.ot-option').removeClass('selected');
                $(el).addClass('selected');
                var type = $(el).data('type');
                $('#orderTypeInput').val(type);
                $('#dineSection').toggleClass('show', type === 'dine_in');
                $('#deliverySection').toggleClass('show', type === 'delivery');
            },

            pinLocation: function() {
                if (!navigator.geolocation) return alert('Geolocation not supported');
                var $lbl = $('#mapLabel').text('Locating…');
                navigator.geolocation.getCurrentPosition(
                    function(p) {
                        $lbl.text('📍 ' + p.coords.latitude.toFixed(4) + ', ' + p.coords.longitude.toFixed(4));
                    },
                    function() {
                        $lbl.text('Could not get location – enter manually.');
                    }
                );
            },

            /* Step 2: Auth tab switching */
            switchAuth: function(tab, panel) {
                $('.lt-tab').removeClass('active').filter(tab).addClass('active');
                $('.lt-panel').removeClass('active');
                $('#panel-' + panel).addClass('active');
            },

            togglePwd: function() {
                var $i = $('#pwdInput'),
                    show = $i.attr('type') === 'password';
                $i.attr('type', show ? 'text' : 'password');
                $('#pwdEye').attr('class', show ? 'bi bi-eye-slash' : 'bi bi-eye');
            },

            /* OTP helpers */
            otpNext: function(inp, i) {
                if (inp.value && i < 3) $('#otp' + (i + 1)).focus();
            },
            otpBack: function(e, i) {
                if (e.key === 'Backspace' && !e.target.value && i > 0) $('#otp' + (i - 1)).focus();
            },

            /* Step 3: Payment toggle */
            selectPayment: function(el) {
                $('.pay-option').removeClass('selected');
                $(el).addClass('selected');
                var method = $(el).data('method');
                $('#payMethodInput').val(method);
                $('#cardPanel').toggleClass('show', method === 'card' || method === 'stripe');
                $('#mpesaPanel').toggleClass('show', method === 'mpesa');
            },

            /* Promo */
            applyPromo: function() {
                var $f = $('<form>').append($('#promoInput').clone().attr('name', 'code'));
                __request($f, '{{ route("checkout.promo.apply") }}').then(function(res) {
                    if (res.discount !== undefined) {
                        $('#totDiscount').text('— Ksh ' + Number(res.discount).toLocaleString());
                        $('#totTotal').text('Ksh ' + Number(res.total).toLocaleString());
                        $('#promoApplyBtn').hide();
                        $('#promoInput').prop('disabled', true);
                        $('#promoRemoveBtn').css('display', 'flex');
                    }
                });
            },

            removePromo: function() {
                $.ajax({
                    url: '{{ route("checkout.promo.remove") }}',
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function(res) {
                    $('#totDiscount').text('— Ksh 0');
                    $('#totTotal').text('Ksh ' + Number(res.total).toLocaleString());
                    $('#promoApplyBtn').show();
                    $('#promoInput').prop('disabled', false).val('');
                    $('#promoRemoveBtn').hide();
                });
            },

            /* Place Order – collect all named inputs from checkout area */
            placeOrder: function() {
                var $btn = $('#placeOrderBtn');
                var originalHtml = $btn.html();

                // Basic check if auth required
                if (customerAuth == false) {
                    // Alert if no auth, maybe highlight details section
                    window.scrollTo({
                        top: $('.checkout-left').offset().top,
                        behavior: 'smooth'
                    });
                    alert('Please provide your details first (Step 2).');
                    return;
                }

                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

                // We can just gather all inputs from checkout-left that are NOT inside other forms
                var data = {};
                $('.checkout-left').find('input[name], select[name], textarea[name]').each(function() {
                    var $el = $(this);
                    // Only take inputs not inside other active forms OR from specific sections
                    if ($el.attr('name')) {
                        data[$el.attr('name')] = $el.val();
                    }
                });

                // Use __request with a mock form or just call axios directly if we want more control
                // But let's stick to __request for consistency
                var $tempForm = $('<form>').hide();
                $.each(data, function(k, v) {
                    $tempForm.append($('<input>').attr('type', 'hidden').attr('name', k).val(v));
                });
                $('body').append($tempForm);

                __request($tempForm, '{{ url("place-order") }}').then(function(res) {
                    if (res.order_id) {
                        $btn.html('<i class="bi bi-check-circle-fill"></i> Order Placed! 🎉')
                            .css('background', 'linear-gradient(135deg,#22c55e,#16a34a)');
                        setTimeout(function() {
                            window.location.href = res.redirect_url;
                        }, 1800);
                    }
                    $tempForm.remove();
                }).catch(function() {
                    $btn.prop('disabled', false).html(originalHtml);
                    $tempForm.remove();
                });
            }
        };

        /* ── Auth form submissions via __request() ── */
        if (customerAuth == false) {

            $('#guestForm').on('submit', function() {
                __request(this, '{{ route("checkout.guest") }}').then(function(res) {
                    $('#guestAlert').html('<div class="ck-alert success"><i class="bi bi-check-circle-fill"></i> ' + (res.message || 'Details saved!') + '</div>');
                });
            });

            $('#otpSendForm').on('submit', function() {
                __request(this, '{{ route("checkout.otp.send") }}').then(function(res) {
                    $('#otpEntry').show();
                    $('#otpPhoneDisplay').text($('#otpPhone').val());
                    $('#otpPhoneHidden').val($('#otpPhone').val());
                    $('#otp0').focus();
                });
            });

            $('#otpVerifyForm').on('submit', function() {
                // Combine OTP digits into one hidden field
                var code = $('#otp0').val() + $('#otp1').val() + $('#otp2').val() + $('#otp3').val();
                $(this).find('[name=otp]').remove();
                $(this).append('<input type="hidden" name="otp" value="' + code + '">');
                __request(this, '{{ route("checkout.otp.verify") }}').then(function(res) {
                    $('#otpEntry').hide();
                    $('#otpVerified').css('display', 'flex');
                });
            });

            $('#loginForm').on('submit', function() {
                __request(this, '{{ url("/login") }}').then(function(res) {
                    setTimeout(function() {
                        location.reload();
                    }, 800);
                });
            });

        }

        /* Login tabs */
        $('.login-tabs .lt-tab').on('click', function() {
            CK.switchAuth(this, $(this).data('panel') || $(this).text().trim().toLowerCase());
        });
    });
</script>
@endpush