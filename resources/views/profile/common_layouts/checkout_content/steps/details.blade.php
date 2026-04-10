<div class="ck-card">
    <div class="ck-card-title"><span class="step-badge">2</span><i class="bi bi-person-check"></i> Your Details</div>

    @if(auth('customer')->check())
    <div class="ck-alert success">
        <i class="bi bi-check-circle-fill"></i>
        Signed in as <strong>{{ auth('customer')->user()->name }}</strong>
    </div>
    @else
    <div class="login-tabs">
        <button class="lt-tab active" data-panel="guest"><i class="bi bi-person"></i> Guest</button>
        <button class="lt-tab" data-panel="otp"><i class="bi bi-phone"></i> OTP</button>
        <button class="lt-tab" data-panel="account"><i class="bi bi-shield-lock"></i> Login</button>
    </div>
    @include('profile.common_layouts.checkout_content.auth_forms')
    @endif
</div>
