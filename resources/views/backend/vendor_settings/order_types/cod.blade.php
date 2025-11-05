@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ url('vendor/settings/order_types') }}" class="backBtn"><i
                                    class="fas fa-chevron-left"></i></a> Cash on delivery</h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="form-group col-md-12 ">
                                <ul class="shippingMenu flex gap-15 flex-wrap p-5 pt-10">
                                    <li class="badge badge-secondary default active">
                                        <label class="custom-radio-2">
                                            <input type="radio" name="shipping_type" value="default" checked
                                                onclick="location=''"><?= __('default') ?>
                                        </label>
                                    </li>

                                    <li class="badge badge-secondary area">
                                        <label class="custom-radio-2">
                                            <input type="radio" name="shipping_type" value="0"
                                                onclick="location=''"><?= __('area_based') ?>
                                        </label>
                                    </li>

                                    <li class="badge badge-secondary radius">
                                        <label class="custom-radio-2">
                                            <input type="radio" name="shipping_type" value="0"
                                                onclick="location=''"><?= __('radius_based') ?>
                                        </label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- row -->


    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"><?= lang('Default') ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row p-10">
                            <div class="col-md-6 form-group">
                                <label><?= __('shipping_charge') ?></label>
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="shipping_charge" id="shipping" class="form-control"
                                        value="">
                                    <div class="input-group">
                                        <span>$</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- row -->


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">area base</h5>
                    <?= __addbtn('', '', ['is_sidebar' => 1, 'class' => 'area']) ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('area_name') ?></th>
                                    <th><?= __('charge') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>rajibpur</td>
                                    <td>$3</td>
                                    <td> <?= __status(1, 1, 'vendor_shipping_area_list') ?></td>
                                    <td class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'area_1']) ?>
                                        <?= __deleteBtn(1, 'vendor_shipping_area_list', true) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->

    <?= __header(__('add_new'), 'vendor/settings/add_shipping_area', 'area') ?>
    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge') ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="">
            <div class="input-group">
                <span>$</span>
            </div>
        </div>
    </div>
    <?= __footer() ?>



    <?= __header(__('edit'), 'vendor/settings/add_shipping_area', 'area_1') ?>
    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" value="rajibpur">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge') ?></label>
        <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="5">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>




    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Radius base</h5>
                    <?= __addbtn('', '', ['is_sidebar' => 1, 'class' => 'radius']) ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('min_distance') ?></th>
                                    <th><?= __('max_distance') ?></th>
                                    <th><?= __('charge') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>$23</td>
                                    <td> <?= __status(1, 1, 'vendor_radius_list') ?></td>
                                    <td class="btnGroup">

                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'radius_1']) ?>
                                        <?= __deleteBtn(1, 'vendor_radius_list', true) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->


    <?= __header(__('add_new'), url('vendor/settings/add_radius'), 'radius') ?>
    <div class="form-group">
        <label><?= __('min_distance') ?></label>
        <input type="text" name="min_distance" id="min_distance" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('max_distance') ?></label>
        <input type="text" name="max_distance" id="max_distance" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge') ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number"
                value="">
            <div class="input-group">
                <span>$</span>
            </div>
        </div>

    </div>
    <?= __footer() ?>



    <?= __header(__('edit'), url('vendor/settings/add_radius'), 'radius_1') ?>
    <div class="form-group">
        <label><?= __('min_distance') ?></label>
        <input type="text" name="min_distance" id="min_distance" class="form-control" value="12">
    </div>

    <div class="form-group">
        <label><?= __('max_distance') ?></label>
        <input type="text" name="max_distance" id="max_distance" class="form-control" value="12">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge') ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number"
                value="23">
            <div class="input-group">
                <span>$</span>
            </div>
        </div>
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
