@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">

        @include('backend.vendor_settings.inc.v_order_config_menu')

        <div class="col-lg-8 col-xs-12">
            <div class="topSection">
                <form action="" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= __('tax-configuration') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-switch prefrence-item">
                                        <div class="gap">
                                            <input type="checkbox" id="is_item_tax" name="is_item_tax" class="switch-input"
                                                data-type="item_tax" value="1"
                                                onchange="toggleDiv(this,'taxPercentDiv')">
                                            <label for="is_item_tax" class="switch-label"> <span class="toggle--on"> <i
                                                        class="fa fa-check c_green"></i> <?= __('activated') ?></span><span
                                                    class="toggle--off"><i class="fa fa-ban c_red"></i>
                                                    <?= __('inactive') ?></span> </label>
                                        </div>
                                        <div class="preText">
                                            <label class="custom-label"><?= __('item_tax') ?></label>
                                            <p class="text-muted"><small><?= __('enable_to_allow') ?></small> </p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> <?= __('tax_system') ?> </label>
                                    <select name="tax_system" id="tax_system" class="form-control">
                                        <option value="percentage" selected><?= __('percentage') ?> </option>
                                        <option value="default"><?= __('tax_including_formula') ?> </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <div class="taxPercentDiv ">
                                        <label> <?= __('tax_percentage') ?> </label>
                                        <div class="">
                                            <div class="ci-input-group input-group-prepand append-prepand">
                                                <div class="input-group input-prepand">
                                                    <select name="tax_status" class="" id="">
                                                        <option value="include" selected>
                                                            +</option>
                                                        <option value="exclude">
                                                            -</option>
                                                    </select>
                                                </div>
                                                <input type="text" name="tax_percentage" class="form-control number"
                                                    autocomplete="off" value="5">
                                                <div class="input-group">
                                                    <button type="button" class="btn max-w-100 ci-color">%</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- card-body -->
                        <div class="card-footer text-right">
                            <?= __submitBtn() ?>
                        </div>
                    </div>
                </form>
            </div><!-- topSection -->




            <div class="taxArea">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= __('tax_list') ?></h4>
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'tax_list']) ?>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <th>#</th>
                                    <th><?= __('tax_name') ?></th>
                                    <th><?= __('tax_percentage') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>GST</td>
                                        <td>6</td>

                                        <td> <?= __status(1, 1, 'tax_table') ?></td>
                                        <td class="btnGroup">
                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'tax_list_1']) ?>
                                            <?= __deleteBtn(1, 'tax_table', true) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= __header(__('add_new'), url('vendor/settings/add_new_tax'), 'tax_list') ?>

    <div class="form-group">
        <label><?= __('tax_name') ?></label>
        <input type="text" name="tax_name" id="area_name" class="form-control" placeholder="<?= __('tax_name') ?>">
    </div>

    <div class="form-group">
        <label><?= __('tax_percentage') ?></label>
        <div class="ci-input-group input-group-prepand ">
            <input type="text" name="tax_percentage" id="tax_percentage" class="form-control"
                placeholder="<?= __('tax_percentage') ?>">
            <div class="input-group ci-color">
                <span> %</span>
            </div>
        </div>

    </div>

    <?= hidden('id', 0) ?>
    <?= __footer() ?>


    <?= __header(__('edit'), url('vendor/settings/add_new_tax'), 'tax_list_1') ?>
    <div class="form-group">
        <label><?= __('tax_name') ?></label>
        <input type="text" name="tax_name" id="area_name" class="form-control" placeholder="<?= __('tax_name') ?>"
            value="">
    </div>

    <div class="form-group">
        <label><?= __('tax_percentage') ?></label>
        <div class="ci-input-group input-group-prepand ">
            <input type="text" name="tax_percentage" id="tax_percentage" class="form-control"
                placeholder="<?= __('tax_percentage') ?>" value="">
            <div class="input-group ci-color">
                <span> %</span>
            </div>
        </div>

    </div>

    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
