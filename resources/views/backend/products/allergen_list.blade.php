@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('allergen_list') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_allergen']) ?>
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
                                        <th><?= __('allergen_name') ?></th>
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
                                                    title="">
                                                    <i class="fi fi-us"></i>
                                                </span>
                                                <span class="title-text">Oil</span>
                                            </div>
                                        </td>

                                        <td> <?= __status(1, 1, 'vendor_allergen_list') ?></td>
                                        <td class="">
                                            <div class="btnGroup">
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_allergen_1']) ?>
                                                <?= __deleteBtn(1, 'vendor_allergen_list', true) ?>
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


    <?= __header(__('add_new'), url('vendor/products/add_allergen'), 'add_allergen') ?>


    <div class="form-group">
        <label> <?= __('allergen_name') ?> </label>
        <input type="text" name="allergen_name[en]" class="form-control" value="">
    </div>


    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- <?= media_files('image', 'single', '') ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>




    <?= __header(__('edit'), url('vendor/products/add_allergen'), 'edit_allergen_1') ?>


    <div class="form-group">
        <label><?= __('allergen_name') ?></label>
        <input type="text" name="allergen_name[en]" class="form-control" value="">
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
