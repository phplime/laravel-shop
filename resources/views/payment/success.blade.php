@extends('index')

@section('content')
<div class="paymentSuccessPage">
    <div class="row justify-content-center mt-2rm">
        <div class="col-md-3">
            <div class="card successPage d-flex align-items-center justify-content-center flex-column gap-20">
                <div class="success-card d-flex align-items-center justify-content-center flex-column gap-20">
                    <img class="avatar-large mb-4" src="{{ asset('assets/images/success.gif') }}" alt="Success">
                    <div class="successDetails text-center">
                        <h4 class="mb-10"><?= lang('payment_success'); ?></h4>
                        <div class="alert alert-success">
                            <div class="payment-info-box">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="opacity-75">{{ lang('txn_id') }}:</span>
                                    <span class="fw-bold">{{ request()->get('txn_id') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="opacity-75">{{ lang('payment_method') }}:</span>
                                    <span class="fw-bold text-capitalize">{{ request()->get('method') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="opacity-75">{{ lang('amount') }}:</span>
                                    <span class="fw-bold h5 mb-0">{{ admin_currency_position(request()->get('amount')) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-10 w-100 mt-2 pb-1rm">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4"><i class="fa fa-home"></i> {{ __('home') }}</a>
                        @auth
                        <a href="{{ url('admin/dashboard') }}" class="btn btn-success px-4"><i class="fa fa-dashboard"></i> {{ __('dashboard') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection