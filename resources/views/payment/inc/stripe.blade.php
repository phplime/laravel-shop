@if (!empty($config))
<div class="payment_content text-center {{ $method }}">
    <div class="payment_icon payment">
        <img src="{{ asset('assets/images/payout/' . $method . '.png') }}" alt="">
    </div>
    <div class="payment_details">
        <div class="userInfo">
            <h4> {{ isset($order_info['name']) ?   $order_info['name'] : '' }}</h4>
            @if (!empty($order_info['phone']))
            <p>{{ lang('phone') }}: {{ isset($order_info['phone']) ? $order_info['phone'] : '' }}</p>
            @endif

            @if (!empty($order_info['email']))
            <p>{{ lang('email') }}: {{ isset($order_info['email']) ? $order_info['email'] : '' }}</p>
            @endif
        </div>
        <div class="">
            @if (isset($order_info['is_vendor']) && $order_info['is_vendor'] == 1)
            <h2> {{ isset($invoice_info['total']) ? admin_currency_position($invoice_info['total'], $order_info['vendor_id']) : '' }} </h2>
            @else
            <h2> {{ isset($invoice_info['total']) ? admin_currency_position($invoice_info['total']) : '' }} </h2>
            @endif

        </div>
        <p class="payment_text">* {{ __('pay_with') }} <span class="dcolor">{{ lang($method) }}</span></p>
        <form action="{{ url('payment/process_payment/' . $slug . '/' . $package_slug . '/stripe') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ __numberFormat($invoice_info['total']) }}" name="amount">
            <button type="submit" class="btn btn-success mt-5">{{ __('pay_now') }}</button>
        </form>
    </div>

</div><!-- payment_content -->
@else
<div class="payment_content text-center">
    <h4>{{ !empty(lang('credentials_not_found')) ? lang('credentials_not_found') : "Credentials not found" }}</h4>
</div>
@endif