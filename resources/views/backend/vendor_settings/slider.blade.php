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
                            @foreach ($slider_list as $key => $row)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="<?= __image($row->thumb, 'thumb') ?>" alt="allergen_image"
                                        class="avatar round">
                                </td>
                                <td>
                                    {{ $row->title }}
                                </td>
                                <td> <?= __status($row->id, $row->status, 'vendor_slider_list') ?></td>
                                <td class="">
                                    <div class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_slider_'.$row->id]) ?>
                                        <?= __deleteBtn($row->id, 'vendor_slider_list', true) ?>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Slider Area -->
    <?= __header(__('add_new'), url('vendor/settings/add_slider'), 'add_slider') ?>
        <div class="form-group">
            <label><?= __('title') ?></label>
            <input type="text" name="title" class="form-control" value="">
        </div>
        <div class="form-group">
            <label><?= __('image') ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>
        </div>
        <?= hidden('id', 0) ?>
    <?= __footer() ?>


    <!-- Edit Slider Area -->
    @foreach ($slider_list as $row)
    <?= __header(__('edit'), url('vendor/settings/add_slider'), 'edit_slider_' . $row->id); ?>

        <div class="form-group">
            <label><?= __('title'); ?></label>
            <input type="text" name="title" class="form-control" value="<?= __isset($row, 'title') ?>">
        </div>

        <div class="form-group">
            <label><?= __('image'); ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', __isset($row, 'thumb')); ?>
            </div>
        </div>
        <?= hidden('id', __isset($row, 'id')); ?>
    <?= __footer(); ?>
    @endforeach

@endsection
