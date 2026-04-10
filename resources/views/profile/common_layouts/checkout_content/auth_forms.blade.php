{{-- Guest form --}}
<div class="lt-panel active" id="panel-guest">
    <form id="guestForm" onsubmit="return false">
        <div id="guestAlert"></div>
        <div class="form-row">
            <div class="ck-form-group">
                <label class="ck-label"><?= __('first_name'); ?></label>
                <input type="text" name="first_name" class="ck-input" placeholder="Sheila">
                <div class="field-error" id="err-first_name"></div>
            </div>
            <div class="ck-form-group">
                <label class="ck-label"><?= __('last_name'); ?></label>
                <input type="text" name="last_name" class="ck-input" placeholder="Wanjiku">
                <div class="field-error" id="err-last_name"></div>
            </div>
        </div>
        <div class="ck-form-group">
            <label class="ck-label"><?= __('phone'); ?></label>
            <input type="tel" name="phone" class="ck-input" placeholder="+254 7XX XXX XXX">
            <div class="field-error" id="err-phone"></div>
        </div>
        <div class="ck-form-group">
            <label class="ck-label"><?= __('email'); ?> <span style="font-weight:400;text-transform:none">(optional)</span></label>
            <input type="email" name="email" class="ck-input" placeholder="sheila@email.com">
            <div class="field-error" id="err-email"></div>
        </div>
        <button type="submit" class="ck-btn" id="guestBtn">
            <i class="bi bi-arrow-right-circle"></i> <?= __('continue_as_guest'); ?>
        </button>
    </form>
</div>

{{-- OTP --}}
<div class="lt-panel" id="panel-otp">
    <form id="otpSendForm" onsubmit="return false">
        <div id="otpAlert"></div>
        <div class="ck-form-group">
            <label class="ck-label"><?= __('phone'); ?></label>
            <div style="display:flex;gap:8px">
                <input type="tel" name="phone" class="ck-input" id="otpPhone" placeholder="+254 7XX XXX XXX" style="flex:1">
                <button type="submit" class="promo-apply-btn" id="sendOtpBtn">Send OTP</button>
            </div>
            <div class="field-error" id="err-otp-phone"></div>
        </div>
    </form>
    <div id="otpEntry" style="display:none">
        <p style="font-size:.75rem;color:var(--text-muted);text-align:center;margin-bottom:.5rem">
            Code sent to <strong id="otpPhoneDisplay"></strong>
            <span id="otpTimer" style="color:var(--theme-color);margin-left:4px"></span>
        </p>
        <form id="otpVerifyForm" onsubmit="return false">
            <input type="hidden" name="phone" id="otpPhoneHidden">
            <div class="otp-row">
                <input class="otp-box" name="d1" id="otp0" type="text" maxlength="1" oninput="CK.otpNext(this,0)">
                <input class="otp-box" name="d2" id="otp1" type="text" maxlength="1" oninput="CK.otpNext(this,1)" onkeydown="CK.otpBack(event,1)">
                <input class="otp-box" name="d3" id="otp2" type="text" maxlength="1" oninput="CK.otpNext(this,2)" onkeydown="CK.otpBack(event,2)">
                <input class="otp-box" name="d4" id="otp3" type="text" maxlength="1" oninput="CK.otpNext(this,3)" onkeydown="CK.otpBack(event,3)">
            </div>
            <p style="text-align:center;font-size:.72rem;color:var(--text-muted);margin-bottom:.75rem">
                Didn't receive it? <a href="#" style="color:var(--theme-color);font-weight:600" onclick="CK.sendOtp(true);return false">Resend</a>
            </p>
            <button type="submit" class="ck-btn" id="verifyOtpBtn">
                <i class="bi bi-check-circle"></i> <?= __('verify_and_continue'); ?>
            </button>
        </form>
    </div>
    <div class="ck-alert success" id="otpVerified" style="display:none">
        <i class="bi bi-check-circle-fill"></i> <?= __('phone_verified_successfully'); ?>
    </div>
</div>

{{-- Account Login --}}
<div class="lt-panel" id="panel-account">
    <form id="loginForm" onsubmit="return false">
        <div id="accountAlert"></div>
        <div class="ck-form-group">
            <label class="ck-label"><?= __('email_or_phone'); ?></label>
            <input type="text" name="email" class="ck-input" placeholder="you@email.com">
        </div>
        <div class="ck-form-group">
            <label class="ck-label"><?= __('password'); ?></label>
            <div style="position:relative">
                <input type="password" name="password" class="ck-input" id="pwdInput" placeholder="••••••••" style="padding-right:42px">
                <button type="button" onclick="CK.togglePwd()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:.9rem;padding:0">
                    <i class="bi bi-eye" id="pwdEye"></i>
                </button>
            </div>
        </div>
        <div style="display:flex;justify-content:flex-end;margin-bottom:.75rem">
            <a href="{{ url('/forgot-password') }}" style="font-size:.75rem;color:var(--theme-color);font-weight:600"><?= __('forgot_password'); ?></a>
        </div>
        <button type="submit" class="ck-btn" id="loginBtn">
            <i class="bi bi-box-arrow-in-right"></i> <?= __('sign_in_and_continue'); ?>
        </button>
    </form>
    <div class="ck-divider">or continue with</div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem">
        <a href="{{ url('/auth/google') }}" class="ck-btn secondary" style="text-decoration:none;font-size:.82rem">
            <img src="https://www.google.com/favicon.ico" style="width:15px;height:15px;object-fit:contain"> <?= __('google'); ?>
        </a>
        <a href="{{ url('/auth/facebook') }}" class="ck-btn secondary" style="text-decoration:none;font-size:.82rem">
            <i class="bi bi-facebook" style="color:#1877f2"></i> <?= __('facebook'); ?>
        </a>
    </div>
</div>
