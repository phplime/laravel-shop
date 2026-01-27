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
                                    @foreach ($allergen_list as $key => $row)
                                        <tr id="hide_1">
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <img src="<?= __image($row->images, 'thumb') ?>"
                                                    alt="allergen_image" class="avatar round">
                                            </td>

                                            <td>
                                                <?= __names($row, 'allergen_name', true) ?>
                                            </td>

                                            <td> <?= __status($row->id, $row->status, 'vendor_allergen_list') ?></td>
                                            <td class="">
                                                <div class="btnGroup">
                                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_allergen_'.$row->id]) ?>
                                                    <?= __deleteBtn($row->id, 'vendor_allergen_list', true) ?>
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

    <!-- Add Sidebar Area  -->
    <?= __header(__('add_new'), url('vendor/products/add-allergen'), 'add_allergen') ?>

        @foreach (shop_language() as $lang)
            <div class="form-group">
                <label> <?= __('allergen_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
                <input type="text" name="allergen_name[<?= $lang->slug ?>]" class="form-control" value="">
            </div>
        @endforeach

        <div class="form-group">
            <label><?= __('image') ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', '') ?>
            </div>

        </div>
        <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <!-- Edit Sidebar Area -->
    @foreach ($allergen_list as $row)
        <?= __header(__('edit'), url('vendor/products/add-allergen'), 'edit_allergen_'.$row->id) ?>
        <?php $languages = shop_language(); ?>
        @foreach ($languages as $lang)

            <?php
                $allergen_names =[];
                foreach ($row->getTranslations() as $value) {
                    $allergen_names[$value->language] = $value->allergen_name;
                }
            ?>

            <div class="form-group">
                <label> <?= __('allergen_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
                <input type="text" name="allergen_name[<?= $lang->slug ?>]" class="form-control" value="{{ $allergen_names[$lang->slug] ?? '' }}">
            </div>
        @endforeach

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
