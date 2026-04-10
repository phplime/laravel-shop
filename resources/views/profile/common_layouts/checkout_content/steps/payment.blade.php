<div class="ck-card">
    <div class="ck-card-title"><span class="step-badge">3</span><i class="bi bi-credit-card"></i> Payment Method</div>
    <div class="payment-grid">
        <div class="pay-option selected" data-method="cod" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:#fef3c7;color:#d97706">💵</div>
            <div><span class="pay-label">Cash on Delivery</span><span class="pay-sub">Pay at door</span></div>
        </div>
        <div class="pay-option" data-method="mpesa" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:#dcfce7;font-size:.68rem;color:#15803d;font-weight:800">M-PESA</div>
            <div><span class="pay-label">M-Pesa</span><span class="pay-sub">STK Push</span></div>
        </div>
        <div class="pay-option" data-method="card" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:#ede9fe;color:#7c3aed">💳</div>
            <div><span class="pay-label">Card</span><span class="pay-sub">Visa / Mastercard</span></div>
        </div>
        <div class="pay-option" data-method="stripe" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:#e0e7ff;font-size:.68rem;color:#4338ca;font-weight:800">Stripe</div>
            <div><span class="pay-label">Stripe</span><span class="pay-sub">International</span></div>
        </div>
        <div class="pay-option" data-method="paypal" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:#dbeafe;font-size:.72rem;color:#1d4ed8;font-weight:800">PP</div>
            <div><span class="pay-label">PayPal</span><span class="pay-sub">Express</span></div>
        </div>
        <div class="pay-option" data-method="wallet" onclick="CK.selectPayment(this)">
            <span class="pay-check"><i class="bi bi-check"></i></span>
            <div class="pay-icon" style="background:rgba(13,205,148,.1);color:var(--theme-color)"><i class="bi bi-wallet2"></i></div>
            <div><span class="pay-label">Wallet</span><span class="pay-sub">Ksh {{ number_format($summary['wallet_bal'] ?? 0) }}</span></div>
        </div>
    </div>
    <input type="hidden" name="payment_method" id="payMethodInput" value="cod">

    @include('profile.common_layouts.checkout_content.payment_forms')
</div>
