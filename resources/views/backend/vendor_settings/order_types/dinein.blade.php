@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><a href="{{ url('vendor/settings/order_types') }}" class="backBtn"><i
                                class="fas fa-chevron-left"></i></a> <?= lang('Dine-in') ?></h4>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><?= lang('table_list') ?></h5>
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'table_list']) ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('name') ?></th>
                                    <th><?= __('size') ?></th>
                                    <th><?= __('area_name') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>table1</td>
                                    <td>5</td>
                                    <td>Insides</td>
                                    <td> <?= __status(1, 1, 'vendor_table_list') ?></td>
                                    <td class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'table_list_1']) ?>
                                        <?= __deleteBtn(1, 'vendor_table_list', true) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->

        </div><!-- col-6 -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('table_area') ?></h5>
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'table_area_list']) ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('area_name') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Insides</td>
                                    <td> <?= __status(1, 1, 'vendor_table_area_list') ?></td>
                                    <td class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'area_1']) ?>
                                        <?= __deleteBtn(1, 'vendor_table_area_list', true) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- col-5 -->
    </div><!-- row -->


    <!----------------------------------------------
                    TABLE AREA
    ---------------------------------------------->

    <?= __header(__('add_new'), url('vendor/settings/add_table_area'), 'table_area_list') ?>
    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" placeholder="<?= __('area_name') ?>">
    </div>

    <?= hidden('id', 0) ?>
    <?= __footer() ?>


    <?= __header(__('edit'), url('vendor/settings/add_table_area'), 'area_1') ?>
    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" value="table1">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>

    <!----------------------------------------------
                Table List
    ---------------------------------------------->

    <?= __header(__('add_new'), url('vendor/settings/add_table'), 'table_list') ?>
    <div class="form-group">
        <label><?= __('name') ?></label>
        <input type="text" name="table_name" id="table_name" class="form-control">
    </div>
    <div class="form-group">
        <label><?= __('size') ?></label>
        <input type="number" name="size" id="size" class="form-control only_number"
            value="5">
    </div>

    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <select name="area_id" class="form-control" id="area_id">
            <option value=""><?= __('select') ?></option>
            <option value="1">Insides</option>
        </select>
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>




    <?= __header(__('edit'), url('vendor/settings/add_table'), 'table_list_1') ?>
    <div class="form-group">
        <label><?= __('name') ?></label>
        <input type="text" name="table_name" id="table_name" class="form-control" value="Insides">
    </div>
    <div class="form-group">
        <label><?= __('size') ?></label>
        <input type="number" name="size" id="size" class="form-control only_number" value="4">
    </div>

    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <select name="area_id" class="form-control" id="area_id">
            <option value=""><?= __('select') ?></option>
            <option value="1">Insides</option>
        </select>
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
