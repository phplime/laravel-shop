@extends('backend.vendor.layouts.app')
@section('content')
    <!-- /.dash-menu -->
    <div class="row">
        @include('backend.vendor_settings.inc.v_order_config_menu')
        <div class="col-lg-8 col-xs-12">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4><?= lang('order_types-configuration') ?></h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="20%"><?= __('name') ?></th>
                                    <th width="70%"><?= __('status') ?></th>
                                    <th width="10%"><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td width="40%">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="order_types[1]" value="1" checked>Cash on
                                            delivery
                                        </label>
                                    </td>
                                    <td>
                                        <div class="orderTypeDetails">
                                            <ul>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_payment[]"
                                                            value=""><?= __('enable_payment') ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_required[1]"
                                                            value="1"><?= __('payment_required') ?>
                                                    </label>
                                                </li>

                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_service_charge[]"
                                                            value=""><?= __('enable-service_charge') ?>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('vendor/settings/order-type-settings/cod') }}" class="btn btn-secondary"><i class="fa fa-cogs"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td width="40%">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="order_types[1]" value="1" checked>Pickup / takeaway
                                        </label>
                                    </td>
                                    <td>
                                        <div class="orderTypeDetails">
                                            <ul>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_payment[]"
                                                            value=""><?= __('enable_payment') ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_required[1]"
                                                            value="1"><?= __('payment_required') ?>
                                                    </label>
                                                </li>

                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_service_charge[]"
                                                            value=""><?= __('enable-service_charge') ?>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-secondary"><i class="fa fa-cogs"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td width="40%">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="order_types[1]" value="1" checked>Dine-in
                                        </label>
                                    </td>
                                    <td>
                                        <div class="orderTypeDetails">
                                            <ul>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_payment[]"
                                                            value=""><?= __('enable_payment') ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_required[1]"
                                                            value="1"><?= __('payment_required') ?>
                                                    </label>
                                                </li>

                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_service_charge[]"
                                                            value=""><?= __('enable-service_charge') ?>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-secondary"><i class="fa fa-cogs"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td width="40%">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="order_types[1]" value="1" checked>	Pay cash
                                        </label>
                                    </td>
                                    <td>
                                        <div class="orderTypeDetails">
                                            <ul>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_payment[]"
                                                            value=""><?= __('enable_payment') ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_required[1]"
                                                            value="1"><?= __('payment_required') ?>
                                                    </label>
                                                </li>

                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="is_service_charge[]"
                                                            value=""><?= __('enable-service_charge') ?>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-secondary"><i class="fa fa-cogs"></i></a>
                                    </td>
                                </tr>
                                {{-- <input type="hidden" name="ids[]" value=" $row->order_type_id ?>">
                                <input type="hidden" name="activeIds[ $row->order_type_id ?>]"
                                    value=" $row->active_id ?>"> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
