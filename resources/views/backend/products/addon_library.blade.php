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
                                    @foreach ($addon_list as $key => $row)

                                        <?php $langData = __langData($row->id, 'addon_id', 'vendor_addon_library_ln') ?>

                                        <tr id="hide_1">
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <img src="<?= __image($row->images, 'thumb') ?>"
                                                    alt="allergen_image" class="avatar round">
                                            </td>
                                            <td>
                                                <?= __names($langData, 'addon_name', true) ?>
                                            </td>
                                            <td>
                                                $ {{ $row->price }}
                                            </td>
                                            <td>{{ $row->max_select_qty }}</td>
                                            <td> <?= __status($row->id, $row->status, 'vendor_addon_library') ?></td>
                                            <td class="">
                                                <div class="btnGroup">
                                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_'.$row->id]) ?>
                                                    <?= __deleteBtn($row->id, 'vendor_addon_library', true) ?>
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
        </div>
    </div>

    <!-- Add Sidebar Area -->
    <?= __header(__('add_new'), url('vendor/products/add-addons'), 'add') ?>

        @foreach (shop_language() as $lang)
        <div class="form-group">
            <label><?= __('addon_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
            <input type="text" name="addon_name[<?= $lang->slug ?>]" class="form-control" value="">
        </div>
        @endforeach

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
                <?= media_files('image', 'single', '') ?>
            </div>

        </div>
        <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <!-- Edit Sidebar Area -->
    @foreach ($addon_list as $row)

        <?php $lang_names = __langData($row->id, 'addon_id', 'vendor_addon_library_ln') ?>

        <?= __header(__('edit'), url('vendor/products/add-addons'), 'edit_'.$row->id) ?>

            @foreach (shop_language() as $lang)

            <?php
                $addon_names = [];
                if(!empty($lang_names)){
                    foreach ($lang_names as $value) {
                        $addon_names[$value->language] = $value->addon_name;
                    }
                }
            ?>

            <div class="form-group">
                <label><?= __('addon_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
                <input type="text" name="addon_name[<?= $lang->slug ?>]" class="form-control" value="{{ $addon_names[$lang->slug] }}">
            </div>
            @endforeach

            <div class="form-group ">
                <label><?= __('price') ?></label>
                <div class="ci-input-group input-group-prepand">
                    <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price') ?>"
                        value="{{ $row->price }}">
                    <div class="input-group">
                        <span>
                            $
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><?= __('max_quantity') ?></label>
                <input type="number" name="max_select_qty" class="form-control only_number" value="{{ $row->max_select_qty }}">
            </div>

            <div class="form-group">
                <label><?= __('image') ?></label>
                <div class="mb-4">
                    <?= media_files('image', 'single', __isset($row, 'thumb')) ?>
                </div>

            </div>
            <?= hidden('id', __isset($row, 'id')) ?>
        <?= __footer() ?>
    @endforeach

@endsection
