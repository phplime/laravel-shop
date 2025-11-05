@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-8 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('slider') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_slider']) ?>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('image') ?></th>
                                <th><?= __('title') ?></th>
                                <th><?= __('status') ?></th>
                                <th><?= __('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}" alt="allergen_image"
                                        class="avatar round">
                                </td>
                                <td>
                                    slider
                                </td>
                                <td> <?= __status(1, 1, 'vendor_slider_list') ?></td>
                                <td class="">
                                    <div class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_slider_1']) ?>
                                        <?= __deleteBtn(1, 'vendor_slider_list', true) ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <?= __header(__('add_new'), 'vendor/settings/add_slider', 'add_slider') ?>

    <div class="form-group">
        <label><?= __('title') ?></label>
        <input type="text" name="title" class="form-control" value="">
    </div>
    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            {{-- < media_files('image', 'single', ''); ?> --}}
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
