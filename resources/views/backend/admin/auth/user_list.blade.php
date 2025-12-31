@extends('backend.admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $page_title }}</h5>
                <div class="card-tools d-flex gap-10">
                    @if(request()->anyFilled(['q', 'package_type', 'is_expired']))
                    <a href="{{ url()->current() }}" class="btn text-danger btn-sm ajaxFilterLink" data-target=".card-content">
                        <i class="fas fa-times"></i> {{ __('clear_filter') }}
                    </a>
                    @endif
                    <button type="button" class="btn bg-secondary btn-sm" onclick="$('#filterCollapse').slideToggle()">
                        <i class="fas fa-filter"></i> {{ __('filter') }}
                    </button>
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'subscriber']) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="filter-area mb-1rm" id="filterCollapse" style="display: <?= request()->anyFilled(['q', 'package_type', 'is_expired']) ? 'block' : 'none'; ?>">
                    <form action="{{ url()->current() }}" method="GET" class="row g-3 align-items-end ajaxFilterForm" data-target=".card-content">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('search') }}</label>
                            <input type="text" name="q" class="form-control" placeholder="{{ __('search_by_name_email') }}" value="{{ request('q') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">{{ __('package_type') }}</label>
                            <select name="package_type" class="form-control">
                                <option value="">{{ __('all') }}</option>
                                <option value="monthly" {{ request('package_type') == 'monthly' ? 'selected' : '' }}>{{ __('monthly') }}</option>
                                <option value="yearly" {{ request('package_type') == 'yearly' ? 'selected' : '' }}>{{ __('yearly') }}</option>
                                <option value="free" {{ request('package_type') == 'free' ? 'selected' : '' }}>{{ __('free') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">{{ __('status') }}</label>
                            <select name="is_expired" class="form-control">
                                <option value="">{{ __('all') }}</option>
                                <option value="0" {{ request('is_expired') === '0' ? 'selected' : '' }}>{{ __('active') }}</option>
                                <option value="1" {{ request('is_expired') === '1' ? 'selected' : '' }}>{{ __('expired') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> {{ __('search') }}</button>
                        </div>
                    </form>
                </div>

                <div class="card-content" data-ajax-container=".card-content">
                    <div class="table-responsive responsiveTable">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('username') }}</th>
                                    <th>{{ __('account_type') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('overview') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriber_list as $row)
                                @php
                                $days_left = 0;
                                $expire_date = $row->subscription->expire_date ?? null;
                                if ($expire_date) {
                                $days_left = (int)\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($expire_date), false);
                                }
                                $is_expired = (($row->subscription->is_expired ?? 0) == 1 || ($expire_date && $days_left < 0));
                                    @endphp

                                    <tr id="hide_{{ $row->id }}">
                                    <td data-label="#">{{ $loop->iteration }} </td>
                                    <td data-label="username">{{ $row->username }}</td>
                                    <td data-label="account_type">
                                        <div class="statusList">
                                            <ul class="d-flex gap-10 flex-column">
                                                <li>
                                                    <small><i class="fab fa-gitkraken"></i> {{ __('package_name') }}</small> :
                                                    <label class="label bg-soft-info"> {{ $row->package->package_name ?? __('n/a') }}</label>
                                                </li>
                                                <li>
                                                    <small><i class="fas fa-calendar-week"></i> {{ __('package_type') }}</small>
                                                    :
                                                    <label class="label bg-soft-warning"> {{ $row->package->package_type ?? __('n/a') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td data-label="date">
                                        <div class="statusList">
                                            <ul class="d-flex gap-10 flex-column">
                                                <li>
                                                    <small><i class="fas fa-user-shield"></i> {{ __('active_date') }}</small> :
                                                    <label class="label bg-soft-info"> {{ makeDate($row->subscription->start_date ?? null) }}</label>
                                                </li>
                                                <li>
                                                    <small><i class="fas fa-ban"></i> {{ __('expire_date') }}</small> :
                                                    <label class="label bg-soft-warning"> {{ makeDate($expire_date) }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td data-label="overview">
                                        @if($is_expired)
                                        <label class="badge badge-danger" data-toggle="tooltip" data-title="{{ __('expired') }}">
                                            <i class="fas fa-ban"></i> {{ __('expired') }}
                                        </label>
                                        @else
                                        <label class="badge badge-success" data-toggle="tooltip" data-title="{{ __('active') }}">
                                            <i class="fas fa-check"></i> {{ __('active') }}
                                        </label>
                                        @endif

                                        <div class="statusList mt-2">
                                            <ul class="d-flex gap-10 flex-column">
                                                <li>
                                                    <small><i class="fa fa-credit-card"></i> {{ __('payment') }}</small> :
                                                    @if(($row->subscription->is_payment ?? 0) == 1)
                                                    <span class="label bg-soft-success">
                                                        <i class="fa fa-check"></i> {{ __('paid') }}
                                                    </span>
                                                    @else
                                                    <span class="label bg-soft-danger">
                                                        <i class="fa fa-times"></i> {{ __('pending') }}
                                                    </span>
                                                    @endif
                                                </li>
                                                <li>
                                                    <small><i class="fas fa-envelope"></i> {{ __('verification') }}</small> :
                                                    @if($row->email_verified_at)
                                                    <span class="label bg-soft-success">
                                                        <i class="fas fa-check"></i> {{ __('verified') }}
                                                    </span>
                                                    @else
                                                    <span class="label bg-soft-warning">
                                                        <i class="fas fa-clock"></i> {{ __('pending') }}
                                                    </span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td data-label="status">
                                        <a href="javascript:;" data-status="{{ $row->status }}"
                                            onclick="changeStatus(event, this, '{{ $row->id }}', '{{ $row->status }}', 'users')"
                                            class="badge {{ $row->status == 1 ? 'badge-success' : 'badge-danger' }} changeStatus">
                                            <i class="fa {{ $row->status == 1 ? 'fa-check' : 'fa-times' }}"></i>
                                            &nbsp;{{ $row->status == 1 ? __('activated') : __('deactivated') }}
                                        </a>
                                        <div class="mt-5">
                                            @if($days_left > 0)
                                            <label class="label label-soft-default">{{ $days_left }} {{ __('days_left') }}</label>
                                            @elseif($days_left == 0 && $expire_date)
                                            <label class="label label-soft-warning">{{ __('last_day') }}</label>
                                            @else
                                            <label class="label label-soft-danger">{{ __('expired') }}</label>
                                            @endif
                                        </div>
                                    </td>
                                    <td data-label="action">
                                        <div class="btnGroup">
                                            <a href="{{ url('admin/user_details/' . $row->username) }}"
                                                class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:;"
                                                class="btn btn-info btn-sm change_packageSidebar_{{ $row->id }}"
                                                onclick="sidebar('change_package_{{ $row->id }}Sidebar')"
                                                data-title="{{ __('change_package') }}" data-toggle="tooltip">
                                                <i class="fas fa-exchange-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex justify-content-center ui-pagination">
                        {{ $subscriber_list->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?= __header(__('add_subscriber'), 'admin/auth/create_subscriber', 'subscriber') ?>
<div class="form-group">
    <label><?= lang('username') ?></label>
    <input class="form-control" type="text" name="username" id="username" placeholder="Name" value="">
</div>

<div class="form-group">
    <label><?= lang('email') ?></label>
    <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="">
</div>

<div class="form-group">
    <label for="Name"><?= lang('package_list') ?></label>
    <select name="package_id" class="form-control niceSelect wide" id="packageList">
        <option value=""><?= lang('select') ?></option>
        <option value="1">free</option>
        <option value="2">free</option>
        <option value="3">free</option>
    </select>
</div>
<?= hidden('id', 0) ?>
<?= __footer() ?>



<?= __header(__('change_package'), 'admin/auth/change_package', 'change_package_1') ?>

<div class="form-group">
    <label for="Name"><?= lang('package_list') ?></label>
    <select name="package_id" class="form-control niceSelect wide" id="packageList">
        <option value=""><?= lang('Select') ?></option>
        <option value="trial">Trial/1 Trial - $&nbsp;0</option>
        <option value="pro">Pro/10 Yearly - $&nbsp;10</option>
        <option value="gold" selected="">Gold/1 Monthly - $&nbsp;0</option>
    </select>
</div>
<?= hidden('id', 0) ?>
<?= __footer() ?>



<div id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keybard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modalContent">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection