@extends('index')
@section('content')
<div class="paymentFailedPage">
    <div class="row justify-content-center mt-2rm">
        <div class="col-md-3">
            <div class="card successPage d-flex align-items-center justify-content-center flex-column gap-20">
                <div class="success-card d-flex align-items-center justify-content-center flex-column gap-20">
                    <img class="avatar-large" src="<?= asset("assets/images/failed.gif"); ?>" alt="img-thumbnail">
                    <div class="successDetails text-center">
                        <h4 class="mb-10"><?= lang('payment_failed'); ?></h4>
                        @if($error)
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ $error }}
                        </div>
                        @else
                        <div class="alert alert-warning">
                            The payment error has expired or is no longer available.
                        </div>
                        @endif
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-success btn-block"><i class="fa fa-arrow-left"></i> <?= __('back'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection