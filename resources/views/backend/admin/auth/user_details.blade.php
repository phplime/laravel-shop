@extends('backend.admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ __('user_details') }}</h4>
        <a href="{{ url('admin/subscriber_list') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> {{ __('back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('user_information') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('name') }}</label>
                                    <input type="text" class="form-control form-control-premium" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('email') }}</label>
                                    <input type="email" class="form-control form-control-premium" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('new_password') }} <span class="text-muted small">({{ __('leave_blank_to_keep_current') }})</span></label>
                                    <input type="password" class="form-control form-control-premium" placeholder="********">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('confirm_new_password') }}</label>
                                    <input type="password" class="form-control form-control-premium" placeholder="********">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- col-12 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('assign_access') }}</h4>
                    </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>{{ __('features') }}</legend>
                            <div class="access-grid mb-4">
                                @foreach($features as $feature)
                                @php
                                $is_package = isset($package_features[$feature->id]) && $package_features[$feature->id] == 1;
                                $is_available = $is_package; // Disabled if not in package
                                $is_checked = isset($user_features[$feature->id]) && $user_features[$feature->id] == 1;
                                @endphp
                                <div class="access-card {{ !$is_available ? 'disabled' : '' }}">
                                    <label class="custom-checkbox d-flex align-items-center space-between mb-2">
                                        <div class="itemDetails d-flex align-items-center gap-5">
                                            <input type="checkbox" name="feature[]" class="access-toggle"
                                                data-type="feature"
                                                data-id="{{ $feature->id }}"
                                                id="feature_{{ $feature->id }}"
                                                value="{{ $feature->id }}"
                                                {{ $is_checked ? 'checked' : '' }}
                                                {{ !$is_available ? 'disabled' : '' }}>
                                            <div class="itemContent">
                                                <span>{{ $feature->name }}</span>
                                                <span class="text-muted small">{{ $feature->slug }}</span>
                                            </div>
                                        </div>
                                        @if($is_package)
                                        <span class="badge-package text-warning"><i class="fa fa-box-open"></i></span>
                                        @endif
                                    </label>
                                </div>
                                @endforeach
                            </div>

                        </fieldset>

                        <fieldset class="mt-2rm">
                            <legend>{{ __('order_types') }}</legend>
                            <div class="access-grid mb-4">
                                @foreach($order_types as $type)
                                @php
                                $is_package = isset($package_order_types[$type->id]) && $package_order_types[$type->id] == 1;
                                $is_available = $is_package; // Disabled if not in package
                                $is_checked = isset($user_order_types[$type->id]) && $user_order_types[$type->id] == 1;
                                @endphp

                                <div class="access-card {{ !$is_available ? 'disabled' : '' }}">
                                    <label class="custom-checkbox d-flex align-items-center space-between mb-2">
                                        <div class="itemDetails d-flex align-items-center gap-5">
                                            <input type="checkbox" name="order_type[]" class="access-toggle"
                                                data-type="order_type"
                                                data-id="{{ $type->id }}"
                                                id="order_type_{{ $type->id }}"
                                                value="{{ $type->id }}"
                                                {{ $is_checked ? 'checked' : '' }}
                                                {{ !$is_available ? 'disabled' : '' }}>
                                            <div class="itemContent">
                                                <span>{{ $type->title??$type->name }}</span>
                                                <span class="text-muted small">{{ $type->slug }}</span>
                                            </div>
                                        </div>
                                        @if($is_package)
                                        <span class="badge-package text-warning"><i class="fa fa-box-open"></i></span>
                                        @endif
                                    </label>
                                </div>

                                @endforeach
                            </div>
                        </fieldset>


                        <fieldset class="mt-2rm">
                            <legend>{{ __('payment_methods') }}</legend>
                            <div class="access-grid">
                                @foreach($payment_gateways as $gateway)
                                @php
                                $is_checked = isset($user_payments[$gateway->slug]) && $user_payments[$gateway->slug] == 1;
                                @endphp
                                <div class="access-card">
                                    <label class="custom-checkbox d-flex space-between align-items-center mb-2">
                                        <div class="itemDetails d-flex">
                                            <input type="checkbox" class="access-toggle"
                                                id="payment_{{ $gateway->slug }}"
                                                data-type="payment"
                                                data-id="{{ $gateway->slug }}"
                                                {{ $is_checked ? 'checked' : '' }}>
                                            <span>{{ $gateway->title }}</span>
                                        </div>

                                        <img src="{{ asset('assets/images/payout/' . $gateway->slug . '.png') }}" alt="{{ $gateway->title }}" class="paymentLogo">
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- col-8 mainDiv-->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-weight-bold">{{ __('current_package') }}</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="font-weight-bold text-primary mb-1">{{ $user->package->package_name ?? __('n/a') }}</h6>
                        <p class="text-muted small mb-0">{{ __('expiry_date') }}: {{ $user->subscription->expire_date ?? __('n/a') }}</p>
                    </div>
                    <i class="fas fa-box-open text-muted fa-2x opacity-20"></i>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('account_status') }}</h4>
            </div>
            <div class="card-body account-status-card">
                <div class="user-profile-summary">
                    <img src="<?= avatar($user->image, 'profile') ?>" alt="User">
                    <h5>{{ $user->name }}</h5>
                    <p>{{ __('member_since') }} {{ $user->created_at->format('M d, Y') }}</p>
                </div>

                <div class="status-badge-container">
                    <span class="text-muted font-weight-bold small">{{ __('status') }}</span>
                    <span class="badge badge-pill badge-success px-3 py-2">{{ __('active') }}</span>
                </div>

                <button class="btn-suspend">
                    <i class="fas fa-pause-circle"></i> {{ __('suspend_user') }}
                </button>

                <div class="danger-zone text-left">
                    <h6>{{ __('danger_zone') }}</h6>
                    <p>{{ __('once_you_delete_a_user_there_is_no_going_back_please_be_certain') }}</p>
                    <button class="btn-delete-user">
                        <i class="fas fa-trash-alt"></i> {{ __('delete_user') }}
                    </button>
                </div>
            </div>
        </div>
    </div><!-- col-4 -->
</div><!-- row/main -->


@endsection

@section('scripts')
<script>
    $(document).on('change', '.access-toggle', function() {
        var $this = $(this);
        var type = $this.data('type');
        var id = $this.data('id');
        var status = $this.prop('checked') ? 1 : 0;
        var user_id = "{{ $user->id }}";

        $this.prop('disabled', true);

        $.post("{{ url('admin/dashboard/update_user_access') }}", {
            _token: "{{ csrf_token() }}",
            user_id: user_id,
            type: type,
            id: id,
            status: status
        }, function(json) {
            $this.prop('disabled', false);
            if (json.st == 1) {
                MSG('success', json.msg);
            } else {
                MSG('error', json.msg);
                $this.prop('checked', !status);
            }
        }, 'json').fail(function() {
            $this.prop('disabled', false);
            $this.prop('checked', !status);
            MSG('error', "{{ __('something_went_wrong') }}");
        });
    });


    //suspend and delete user
    $(document).on('click', '.btn-suspend', function() {
        var $this = $(this);
        var user_id = "{{ $user->id }}";

        $this.prop('disabled', true);

        $.post("{{ url('admin/dashboard/suspend_user') }}", {
            _token: "{{ csrf_token() }}",
            user_id: user_id
        }, function(json) {
            $this.prop('disabled', false);
            if (json.st == 1) {
                MSG('success', json.msg);
            } else {
                MSG('error', json.msg);
            }
        }, 'json').fail(function() {
            $this.prop('disabled', false);
            MSG('error', "{{ __('something_went_wrong') }}");
        });
    });

    $(document).on('click', '.btn-delete-user', function() {
        var $this = $(this);
        var user_id = "{{ $user->id }}";

        $this.prop('disabled', true);

        $.post("{{ url('admin/dashboard/delete_user') }}", {
            _token: "{{ csrf_token() }}",
            user_id: user_id
        }, function(json) {
            $this.prop('disabled', false);
            if (json.st == 1) {
                MSG('success', json.msg);
            } else {
                MSG('error', json.msg);
            }
        }, 'json').fail(function() {
            $this.prop('disabled', false);
            MSG('error', "{{ __('something_went_wrong') }}");
        });
    });


</script>
@endsection