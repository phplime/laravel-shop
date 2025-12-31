@extends('index')

@section('content')

<section class="paymentGateways">
    <div class="menuBar">
        <div class="container">
            <a href="{{ url()->previous() ?? url('/') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> {{ __('back') }}</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if(user('role') != 'user')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="singlePayment">
                            <label class="custom-radio">
                                <input type="radio" name="payment_method" value="paypal" {{ (isset($active_method) && $active_method == 'paypal') ? 'checked' : '' }}>
                                <div class="paymentMethodDetails">
                                    <img src="{{ asset('assets/images/payout/paypal.png') }}" alt="Paypal">
                                    <h4>{{ __('paypal') }}</h4>
                                </div>
                            </label>

                            <label class="custom-radio">
                                <input type="radio" name="payment_method" value="stripe" {{ (isset($active_method) && $active_method == 'stripe') ? 'checked' : '' }}>
                                <div class="paymentMethodDetails">
                                    <img src="{{ asset('assets/images/payout/stripe.svg') }}" alt="Stripe">
                                    <h4>{{ __('stripe') }}</h4>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="paymentList">
                        @if(isset($active_method))
                        @include('payment.inc.' . $active_method)
                        @endif
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('order_summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="pricing-summary">
                            <h3 class="text-primary mb-3">{{ $invoice_info['package_name'] ?? '' }}</h3>

                            @if(isset($invoice_info['package_type']))
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fz-14">{{ __('type') }}</span>
                                <span class="text-capitalize fw-bold fz-14">{{ $invoice_info['package_type'] }}</span>
                            </div>
                            @endif

                            @if(isset($invoice_info['duration']))
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fz-14">{{ __('duration') }}</span>
                                <span class="fw-bold fz-14">{{ getDuration($invoice_info['package_type'], $invoice_info['duration']) }} </span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fz-14">{{ __('price') }}</span>
                                <span class="fw-bold fz-14">{{ admin_currency_position($invoice_info['price'] ?? 0) }}</span>
                            </div>



                            @if(isset($invoice_info['tax_fee']))
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fz-14">{{ __('tax') }} <small class="text-muted fz-12">({{ $invoice_info['tax_percent'] }}%)</small></span>
                                <span class="fw-bold fz-14"> {{ admin_currency_position($invoice_info['tax_fee'] ?? 0) }}</span>
                            </div>
                            @endif

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fz-14">{{ __('total') }}</h5>
                                <h4 class="text-primary mb-0">{{ admin_currency_position($invoice_info['total'] ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{user('role') == 'admin' ? 'col-md-8' : 'col-md-12'}}">
                <div class="invoiceArea">
                    @include('invoices.include.subscription_invoice_thumb')
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).on('change', 'input[name="payment_method"]', function() {
        let method = $(this).val();
        let url = new URL(window.location.href);
        url.searchParams.set('method', method);
        window.history.pushState({}, '', url);

        $('.paymentList').html('<div class="text-center p-5"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

        $.ajax({
            url: window.location.href,
            type: 'GET',
            data: {
                method: method
            },
            success: function(response) {
                $('.paymentList').html(response);
            },
            error: function() {
                $('.paymentList').html('<div class="alert alert-danger">{{ __("something_went_wrong") }}</div>');
            }
        });
    });
</script>

@endsection