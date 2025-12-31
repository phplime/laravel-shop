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

                                    @foreach ($subcategory_list as $key => $row)
                                        <tr>
                                            <td data-label="{{ __('#') }}">{{ $key+1 }}</td>
                                            <td data-label="{{ __('category_name') }}">
                                                <img src="<?= __image($row->category_img, 'thumb') ?>" alt="category_image"
                                                    class="avatar round mr-10">

                                                <?php $category_names = __langData($row->cat_id, 'category_id', 'vendor_category_list_ln'); ?>

                                                <div class="mt-10">
                                                    <div class="catName">
                                                        <?= __names($category_names, 'category_name', true); ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="{{ __('subcategories') }}">
                                                <!-- Sub Category Table -->
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
                                                        @foreach ($row->subcategory as $_key => $item)

                                                            <?php $subCat_names = __langData($item->id, 'subcategory_id', 'vendor_subcategory_list_ln'); ?>

                                                            <tr id="hide_1">
                                                                <td data-label="{{ __('#') }}">{{ $_key+1 }}</td>
                                                                <td data-label="{{ __('images') }}">
                                                                    <img src="<?= __image($item->images, 'thumb') ?>"
                                                                        alt="category_image" class="avatar round">
                                                                </td>
                                                                <td data-label="{{ __('subcategory_name') }}">
                                                                    <div class="catName">
                                                                        <?= __names($subCat_names, 'subcategory_name', true); ?>
                                                                    </div>
                                                                </td>

                                                                <td data-label="{{ __('status') }}">
                                                                    <?= __status($item->id, $item->status, 'vendor_subcategory_list') ?>
                                                                </td>
                                                                <td data-label="{{ __('action') }}">
                                                                    <div class="btnGroup">
                                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_subcategory_'.$item->id]) ?>
                                                                        <?= __deleteBtn($item->id, 'vendor_subcategory_list', true) ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <!-- Sub Category Table -->
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
    <?= __header(__('add_new'), url('vendor/products/add_subcategory'), 'add_subcategory') ?>
        <div class="form-group">
            <label><?= __('category_name') ?> <?= __required() ?></label>
            <select name="category_id" id="category_id" class="form-control">
                <option value=""><?= __('select') ?></option>
                @foreach ($category_list as $category)
                    <?php if($category->status == 1):?>
                    <option value="{{ $category->id }}">
                        {{ __names($category->category_names) }}
                    </option>
                    <?php endif; ?>
                @endforeach
            </select>
        </div>
        @foreach (shop_language() as $lang)
            <div class="form-group">
                <label><?= __('subcategory_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
                <input type="text" name="subcategory_name[<?= $lang->slug ?>]" class="form-control" value="">
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
    @foreach ($subcategories as $item)
    <?= __header(__('edit'), url('vendor/products/add_subcategory'), 'edit_subcategory_'.$item->id) ?>

        <div class="form-group">
            <label><?= __('category_name') ?> <?= __required() ?></label>
            <select name="category_id" id="category_id" class="form-control">
                <option value=""><?= __('select') ?></option>
                @foreach ($category_list as $category)
                    <?php if($category->status == 1):?>
                    <option <?= ($item->category_id == $category->id) ? 'selected':'' ?> value="{{ $category->id }}">
                        {{ __names($category->category_names) }}
                    </option>
                    <?php endif; ?>
                @endforeach
            </select>
        </div>

        <?php $subCat_data = __langData($item->id, 'subcategory_id', 'vendor_subcategory_list_ln'); ?>

        @foreach (shop_language() as $lang)
            <?php
                $subcategory_names = [];
                if(!empty($subCat_data)):
                    foreach ($subCat_data as $key => $value) {
                        $subcategory_names[$value->language] = $value->subcategory_name;
                    }
                endif;
            ?>

            <div class="form-group">
                <label><?= __('subcategory_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
                <input type="text" name="subcategory_name[<?= $lang->slug ?>]" class="form-control" value="{{ isset($subcategory_names[$lang->slug]) ? $subcategory_names[$lang->slug]:'' }}">
            </div>
        @endforeach

        <div class="form-group">
            <label><?= __('image') ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', __isset($item, 'thumb')) ?>
            </div>
        </div>

        <?= hidden('id', __isset($item, 'id')) ?>
    <?= __footer() ?>
    @endforeach

@endsection
