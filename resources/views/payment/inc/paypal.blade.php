@if (!empty($config))
<div class="payment_content text-center {{ $method }}">
    <div class="paymentIcon payment">
        <img src="{{ asset('assets/images/payout/paypal.png') }}" alt="">
    </div>

    <form action="{{ isset($config->environment) && $config->environment == 'production' ? 'https://www.paypal.com/cgi-bin/webscr' : 'https://www.sandbox.paypal.com/cgi-bin/webscr' }}"
        method="post" target="_top">
        <!-- csrf token -->
        @csrf
        <input type='hidden' name='business'
            value='{{ !empty($config->paypal_email) ? $config->paypal_email : ""}}'>
        <input type='hidden'
            name='item_name' value='{{ $slug }}'>

        <input type='hidden'
            name='item_number' value='1'>

        <input type='hidden'
            name='amount' value="{{ __numberFormat($invoice_info['total'], $order_info['vendor_id']) }}">

        <input type='hidden'
            name='no_shipping' value='1'>

        <input type='hidden'
            name='currency_code' value="{{ $order_info['currency'] }}">

        <input type='hidden' name='notify_url' value="{{ url('payment/process/' . $slug . '/' . $package_slug . '/paypal') }}">

        <input type='hidden' name='cancel_return'
            value="{{ url('payment/failed/') }}">

        <input type='hidden' name='return' value="{{ url('payment/process/' . $slug . '/' . $package_slug . '/paypal') }}">

        <input type="hidden" name="cmd" value="_xclick">
        @if (is_test() == 0)
        <div class="card-footer mt-10">
            @if ($order_info['is_vendor'] == 1)
            <button
                type="submit" name="pay_now" id="pay_now" class="btn btn-success pay_now"> {{ __('pay_now') }} &nbsp;({{ isset($invoice_info['total']) ? admin_currency_position($invoice_info['total'], $order_info['vendor_id']) : '' }} ) <i class="icofont-paypal"></i> </button>
            @else
            <button
                type="submit" name="pay_now" id="pay_now" class="btn btn-primary btn-block pay_now"> {{ __('pay_now') }} &nbsp;({{ isset($invoice_info['total']) ? admin_currency_position($invoice_info['total']) : '' }} ) </button>
            @endif
        </div>
        @endif
    </form>

</div><!-- payment_content -->
@else
<div class="payment_content text-center">
    <h4>{{ !empty(lang('credentials_not_found')) ? lang('credentials_not_found') : "Credentials not found" }}</h4>
</div>
@endif