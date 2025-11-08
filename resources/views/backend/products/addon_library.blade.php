@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('addon_list') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('images') ?></th>
                                        <th><?= __('title') ?></th>
                                        <th><?= __('price') ?></th>
                                        <th><?= __('max_quantity') ?></th>
                                        <th><?= __('status') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="hide_1">
                                        <td>1</td>
                                        <td>
                                            <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                alt="allergen_image" class="avatar round">
                                        </td>
                                        <td>
                                            <div class="langItem">
                                                <span data-title="English" data-toggle="tooltip" data-original-title=""
                                                    title=""><i class="fi fi-us"></i></span>
                                                <span class="title-text">Butter</span>
                                            </div>
                                        </td>
                                        <td>
                                            $23
                                        </td>
                                        <td>4</td>
                                        <td> <?= __status(1, 1, 'vendor_addon_library') ?></td>
                                        <td class="">
                                            <div class="btnGroup">
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_1']) ?>
                                                <?= __deleteBtn(1, 'vendor_addon_library', true) ?>
                                            </div>
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


    <?= __header(__('add_new'), url('vendor/products/add_addons'), 'add') ?>


    <div class="form-group">
        <label><?= __('addon_name') ?> <i class="fi fi-us"></i></label>
        <input type="text" name="addon_name[en]" class="form-control" value="">
    </div>

    <div class="form-group ">
        <label><?= __('price') ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price') ?>"
                value="">
            <div class="input-group">
                <span>
                    $
                </span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label><?= __('max_quantity') ?></label>
        <input type="number" name="max_select_qty" class="form-control only_number" value="0">
    </div>

    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', '') ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>




    <?= __header(__('edit'), url('vendor/products/add_addons'), 'edit_1') ?>

    <div class="form-group">
        <label><?= __('addon_name') ?> <i class="fi fi-us"></i></label>
        <input type="text" name="addon_name[en]" class="form-control" value="">
    </div>

    <div class="form-group ">
        <label><?= __('price') ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price') ?>"
                value="5">
            <div class="input-group">
                <span>
                    $
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label><?= __('max_quantity') ?></label>
        <input type="number" name="max_select_qty" class="form-control only_number" value="4">
    </div>

    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', __isset($erow, 'thumb')) ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
