{{-- Card details --}}
<div class="pay-extra" id="cardPanel">
    <div style="height:1px;background:var(--border);margin:1rem 0"></div>
    <div class="ck-form-group">
        <label class="ck-label">Card Number</label>
        <div class="card-input-wrap">
            <input type="text" name="card_number" class="ck-input" placeholder="1234  5678  9012  3456" maxlength="19">
            <i class="bi bi-credit-card card-icon"></i>
        </div>
        <div class="field-error" id="err-card_number"></div>
    </div>
    <div class="form-row">
        <div class="ck-form-group">
            <label class="ck-label">Expiry</label>
            <input type="text" name="card_expiry" class="ck-input" placeholder="MM / YY" maxlength="7">
            <div class="field-error" id="err-card_expiry"></div>
        </div>
        <div class="ck-form-group">
            <label class="ck-label">CVV</label>
            <input type="text" name="card_cvv" class="ck-input" placeholder="•••" maxlength="4">
            <div class="field-error" id="err-card_cvv"></div>
        </div>
    </div>
    <div class="ck-form-group">
        <label class="ck-label">Name on Card</label>
        <input type="text" name="card_name" class="ck-input" placeholder="SHEILA WANJIKU">
        <div class="field-error" id="err-card_name"></div>
    </div>
    <label style="display:flex;align-items:center;gap:8px;font-size:.78rem;color:var(--text-muted);cursor:pointer">
        <input type="checkbox" name="save_card" style="accent-color:var(--theme-color)"> Save card for future orders
    </label>
</div>

{{-- M-Pesa --}}
<div class="pay-extra" id="mpesaPanel">
    <div style="height:1px;background:var(--border);margin:1rem 0"></div>
    <div class="ck-form-group">
        <label class="ck-label">M-Pesa Number</label>
        <input type="tel" name="mpesa_phone" class="ck-input" placeholder="+254 7XX XXX XXX">
        <div class="field-error" id="err-mpesa_phone"></div>
    </div>
    <p style="font-size:.75rem;color:var(--text-muted)">
        <i class="bi bi-info-circle" style="color:var(--theme-color)"></i>
        An STK push will be sent to your phone. Confirm with your M-Pesa PIN.
    </p>
</div>
