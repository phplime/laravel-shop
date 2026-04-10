@extends('profile.layouts.app')

@section('content')
<section class="checkout-section">
    <div class="container">
        <a href="{{ url('/') }}" class="checkout-back mb-4">
            <i class="bi bi-arrow-left"></i> Back to restaurant
        </a>

        <h1 class="checkout-title">Secure Checkout</h1>

        <form action="{{ url('/confirm-order') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    {{-- 1. Login/Auth Mode --}}
                    @if(!auth()->check())
                    <div class="checkout-card">
                        <h5 class="card-title text-muted"><i class="bi bi-person-lock"></i> Checkout Method</h5>
                        <div class="auth-modes">
                            <div class="auth-mode-btn active" onclick="setAuthMode('guest', this)">Guest</div>
                            <div class="auth-mode-btn" onclick="setAuthMode('otp', this)">OTP Login</div>
                            <div class="auth-mode-btn" onclick="setAuthMode('system', this)">Account</div>
                        </div>
                        <input type="hidden" name="auth_mode" id="authModeInput" value="guest">

                        <div id="authContent">
                            {{-- Guest Form --}}
                            <div id="guestMode" class="auth-form-wrap">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" placeholder="01XXX-XXXXXX">
                                    </div>
                                </div>
                            </div>

                            {{-- OTP Mode --}}
                            <div id="otpMode" class="auth-form-wrap" style="display:none">
                                <div class="row align-items-end">
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="otp_phone" class="form-control" placeholder="01XXX-XXXXXX">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button type="button" class="btn btn-primary w-100 h-50-px">Send OTP</button>
                                    </div>
                                </div>
                            </div>

                            {{-- System Login Mode --}}
                            <div id="systemMode" class="auth-form-wrap" style="display:none">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="your@email.com">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 2. Order Type --}}
                    <div class="checkout-card">
                        <h5 class="card-title"><i class="bi bi-truck"></i> Choose Order Type</h5>
                        <div class="order-types-grid">
                            <label class="type-card active" onclick="setOrderType('cod', this)">
                                <input type="radio" name="order_type" value="cod" checked class="d-none">
                                <i class="bi bi-house-door"></i>
                                <span>Home Delivery</span>
                            </label>
                            <label class="type-card" onclick="setOrderType('takeaway', this)">
                                <input type="radio" name="order_type" value="takeaway" class="d-none">
                                <i class="bi bi-bag-check"></i>
                                <span>Takeaway</span>
                            </label>
                            <label class="type-card" onclick="setOrderType('dinein', this)">
                                <input type="radio" name="order_type" value="dinein" class="d-none">
                                <i class="bi bi-shop"></i>
                                <span>Dine-in</span>
                            </label>
                        </div>

                        {{-- Dynamic details based on order type --}}
                        <div id="typeDetails" class="mt-4">
                            <div id="codDetails">
                                <label class="form-label">Delivery Address</label>
                                <textarea name="address" class="form-control" rows="3" style="height:auto !important" placeholder="Street address, apartment, suite..."></textarea>
                            </div>
                            <div id="takeawayDetails" style="display:none">
                                <label class="form-label">Pickup Time</label>
                                <select name="pickup_time" class="form-control">
                                    <option value="asap">As soon as possible (20-30 min)</option>
                                    <option value="1h">In 1 hour</option>
                                    <option value="2h">In 2 hours</option>
                                </select>
                            </div>
                            <div id="dineinDetails" style="display:none">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Select Table</label>
                                        <select name="table_id" class="form-control">
                                            <option value="1">Inside Table 1</option>
                                            <option value="2">Inside Table 2</option>
                                            <option value="3">Window Table 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Number of Persons</label>
                                        <input type="number" name="persons" class="form-control" value="2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Payment Method --}}
                    <div class="checkout-card">
                        <h5 class="card-title"><i class="bi bi-credit-card"></i> Payment Method</h5>
                        <div class="payment-grid">
                            <label class="pay-card active">
                                <input type="radio" name="payment_method" value="cod" class="d-none" checked>
                                <i class="bi bi-cash-stack fz-24 mb-2"></i>
                                <span>Cash on Delivery</span>
                            </label>
                            <label class="pay-card">
                                <input type="radio" name="payment_method" value="bkash" class="d-none">
                                <img src="https://www.logo.wine/a/logo/BKash/BKash-Logo.wine.svg" alt="bkash">
                                <span>bKash</span>
                            </label>
                            <label class="pay-card">
                                <input type="radio" name="payment_method" value="nagad" class="d-none">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Nagad_Logo.svg/1200px-Nagad_Logo.svg.png" alt="nagad">
                                <span>Nagad</span>
                            </label>
                            <label class="pay-card">
                                <input type="radio" name="payment_method" value="card" class="d-none">
                                <i class="bi bi-credit-card-2-front fz-24 mb-2"></i>
                                <span>Debit/Credit Card</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">
                    <div class="checkout-card sticky-top" style="top: 100px;">
                        <h5 class="card-title">Order Summary</h5>
                        
                        {{-- Tip Selection --}}
                        <div class="mb-4">
                            <label class="form-label">Add a Tip?</label>
                            <div class="tips-grid">
                                <div class="tip-btn" data-value="0">No Tip</div>
                                <div class="tip-btn" data-value="5">$5</div>
                                <div class="tip-btn active" data-value="10">$10</div>
                                <div class="tip-btn" data-value="20">$20</div>
                            </div>
                            <input type="hidden" name="tip_amount" id="tipAmountInput" value="10">
                        </div>

                        <div class="summary-item">
                            <span>Subtotal</span>
                            <b id="summarySubtotal" data-value="500.00">$500.00</b>
                        </div>
                        <div class="summary-item" id="deliveryRow">
                            <span>Delivery Fee</span>
                            <b id="summaryDelivery" data-value="50.00">$50.00</b>
                        </div>
                        <div class="summary-item">
                            <span>Service Charge</span>
                            <b id="summaryService" data-value="15.00">$15.00</b>
                        </div>
                        <div class="summary-item">
                            <span>Tax (10%)</span>
                            <b id="summaryTax" data-value="50.00">$50.00</b>
                        </div>
                        <div class="summary-item">
                            <span>Tip</span>
                            <b id="summaryTip">$10.00</b>
                        </div>
                        <div class="summary-total">
                            <span>Grand Total</span>
                            <span id="summaryTotal">$625.00</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4 py-3 fw-bold checkout-confirm-btn">
                            <i class="bi bi-check-circle-fill"></i> Confirm Order
                        </button>
                        <p class="text-center text-muted fz-12 mt-3 mb-0">
                            By placing order, you agree to our terms & conditions.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
const subtotalVal = 500.00;
const taxVal = 50.00;
const serviceVal = 15.00;
const deliveryVal = 50.00;

function updateSummary() {
    const isCOD = document.querySelector('input[name="order_type"]:checked').value === 'cod';
    const currentDelivery = isCOD ? deliveryVal : 0;
    const currentTip = parseFloat(document.getElementById('tipAmountInput').value) || 0;
    
    // Update UI values
    document.getElementById('summaryDelivery').textContent = '$' + currentDelivery.toFixed(2);
    document.getElementById('deliveryRow').style.opacity = isCOD ? '1' : '0.4';
    document.getElementById('summaryTip').textContent = '$' + currentTip.toFixed(2);
    
    // Calculate total
    const total = subtotalVal + currentDelivery + taxVal + serviceVal + currentTip;
    document.getElementById('summaryTotal').textContent = '$' + total.toFixed(2);
}

function setAuthMode(mode, el) {
    document.querySelectorAll('.auth-mode-btn').forEach(btn => btn.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('authModeInput').value = mode;
    
    document.getElementById('guestMode').style.display = (mode === 'guest') ? 'block' : 'none';
    document.getElementById('otpMode').style.display = (mode === 'otp') ? 'block' : 'none';
    document.getElementById('systemMode').style.display = (mode === 'system') ? 'block' : 'none';
}

function setOrderType(type, el) {
    document.querySelectorAll('.type-card').forEach(card => card.classList.remove('active'));
    el.classList.add('active');
    el.querySelector('input').checked = true;

    document.getElementById('codDetails').style.display = (type === 'cod') ? 'block' : 'none';
    document.getElementById('takeawayDetails').style.display = (type === 'takeaway') ? 'block' : 'none';
    document.getElementById('dineinDetails').style.display = (type === 'dinein') ? 'block' : 'none';
    
    updateSummary();
}

// Payment card selection
document.querySelectorAll('.pay-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        this.querySelector('input').checked = true;
    });
});

// Tip selection logic
document.querySelectorAll('.tip-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tip-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('tipAmountInput').value = this.dataset.value;
        updateSummary();
    });
});

// Initial calc
updateSummary();
</script>
@endpush
@endsection
