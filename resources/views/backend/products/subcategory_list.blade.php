@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('subcategory_list') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_subcategory']) ?>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="card-content">
                        <div class="table-responsive">

                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('category_name') ?></th>
                                        <th><?= __('subcategories') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                alt="category_image" class="avatar round mr-10">

                                            <div class="mt-10">
                                                <div class="catName">
                                                    <div class="langItem">
                                                        <span data-title="English" data-toggle="tooltip"
                                                            data-original-title="" title="">
                                                            <i class="fi fi-us"></i>
                                                        </span>
                                                        <span class="title-text">Pasta</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?= __('images') ?></th>
                                                        <th><?= __('subcategory_name') ?></th>
                                                        <th><?= __('status') ?></th>
                                                        <th><?= __('action') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="hide_1">
                                                        <td>1</td>
                                                        <td>
                                                            <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                                alt="category_image" class="avatar round">
                                                        </td>
                                                        <td>
                                                            <div class="catName">
                                                                <div class="langItem">
                                                                    <span data-title="English" data-toggle="tooltip"
                                                                        data-original-title="" title="">
                                                                        <i class="fi fi-us"></i>
                                                                    </span>
                                                                    <span class="title-text">Pasta</span>
                                                                </div>
                                                            </div>

                                                        </td>

                                                        <td> <?= __status(1, 1, 'subcategories') ?></td>
                                                        <td class="">
                                                            <div class="btnGroup">
                                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_subcategory_1']) ?>
                                                                <?= __deleteBtn(1, 'subcategories', true) ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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


    <?= __header(__('add_new'), url('vendor/products/add_subcategory'), 'add_subcategory') ?>
    <div class="form-group">
        <label><?= __('category_name') ?> <?= __required() ?></label>
        <select name="category_id" id="category_id" class="form-control">
            <option value=""><?= __('select') ?></option>
            <option value="1">Pizza</option>
        </select>
    </div>

    <div class="form-group">
        <label><?= __('subcategory_name') ?></label>
        <input type="text" name="subcategory_name[en]" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', '') ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <?= __header(__('edit'), url('vendor/products/add_subcategory'), 'edit_subcategory_1') ?>

    <div class="form-group">
        <label><?= __('category_name') ?> <?= __required() ?></label>
        <select name="category_id" id="category_id" class="form-control">
            <option value=""><?= __('select') ?></option>
            <option value="1">pizza</option>
        </select>
    </div>
    <div class="form-group">
        <label><?= __('subcategory_name') ?></label>
        <input type="text" name="subcategory_name[en]" class="form-control" value="">
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
