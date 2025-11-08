@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('category_list') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_category']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('images') ?></th>
                                        <th><?= __('category_name') ?></th>
                                        <th><?= __('status') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="hide_1">
                                        <td data-label="#">1</td>
                                        <td data-label="<?= __('images') ?>">
                                            <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                alt="category_image" class="avatar round">
                                        </td>
                                        <td data-label="<?= __('category_name') ?>">
                                            pizza
                                        </td>
                                        <td data-label="<?= __('status') ?>">
                                            <?= __status(1, 1, 'category_list') ?>
                                        </td>
                                        <td data-label="<?= __('action') ?>" class="">
                                            <div class="btnGroup">
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_category_1']) ?>
                                                <?= __deleteBtn(1, 'category_list', true) ?>
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


    <?= __header(__('add_new'), url('vendor/products/add_category'), 'add_category') ?>


    <div class="form-group">
        <label><?= __('category_name') ?></label>
        <input type="text" name="category_name[en]" class="form-control" value="">
    </div>


    <div class="form-group">
        <label><?= __('image') ?> </label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', '') ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <?= __header(__('edit'), url('vendor/products/add_category'), 'edit_category_1') ?>


    <div class="form-group">
        <label><?= __('category_name') ?></label>
        <input type="text" name="category_name[en]" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', __isset($erow, 'thumb')) ?> --}}
        </div>

    </div>
    <?= hidden('id', 1) ?>
    <?= __footer() ?>
@endsection
