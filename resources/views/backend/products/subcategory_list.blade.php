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

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('category_name') ?></th>
                                    <th><?= __('subcategories') ?></th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($category_list as $key => $row)
                                <tr>
                                    <td data-label="{{ __('#') }}">{{ $key+1 }}</td>
                                    <td data-label="{{ __('category_name') }}">
                                        <img src="<?= __image($row->thumb, 'thumb') ?>" alt="category_image"
                                            class="avatar round mr-10">

                                        <div class="mt-10">
                                            <div class="catName">
                                                <?= __names($row, 'category_name', true); ?>
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
                                                @foreach ($row->subcategories as $_key => $item)

                                                <tr id="hide_1">
                                                    <td data-label="{{ __('#') }}">{{ $_key+1 }}</td>
                                                    <td data-label="{{ __('images') }}">
                                                        <img src="<?= __image($item->thumb, 'thumb') ?>"
                                                            alt="category_image" class="avatar round">
                                                    </td>
                                                    <td data-label="{{ __('subcategory_name') }}">
                                                        <div class="catName">
                                                            <?= __names($item, 'subcategory_name', true); ?>
                                                        </div>
                                                    </td>

                                                    <td data-label="{{ __('status') }}">
                                                        <?= __status($item->id, $item->status, 'vendor_subcategory_list') ?>
                                                    </td>
                                                    <td data-label="{{ __('action') }}">
                                                        <div class="btnGroup">
                                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_subcategory_' . $item->id]) ?>
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

<?php
$languages = shop_language();
$subcategories = $category_list->pluck('subcategories')->flatten();
?>

<!-- Add Sidebar Area -->
<?= __header(__('add_new'), url('vendor/products/add_subcategory'), 'add_subcategory') ?>
<div class="form-group">
    <label><?= __('category_name') ?> <?= __required() ?></label>
    <select name="category_id" id="category_id" class="form-control">
        <option value=""><?= __('select') ?></option>
        @foreach ($category_list as $category)
        <?php if ($category->status == 1): ?>
            <option value="{{ $category->id }}">
                <?= __names($category, 'category_name'); ?>
            </option>
        <?php endif; ?>
        @endforeach
    </select>
</div>
@foreach ($languages as $lang)
<div class="form-group">
    <label><?= __('subcategory_name') ?> <span data-toggle="tooltip" data-title="{{$lang->language_name}}"><?= country($lang->country_id)->flag ?></span> <?= __required() ?></label>
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
<?= __header(__('edit'), url('vendor/products/add_subcategory'), 'edit_subcategory_' . $item->id) ?>

<div class="form-group">
    <label><?= __('category_name') ?> <?= __required() ?></label>
    <select name="category_id" id="category_id" class="form-control">
        <option value=""><?= __('select') ?></option>
        @foreach ($category_list as $category)
        <?php if ($category->status == 1): ?>
            <option <?= ($item->category_id == $category->id) ? 'selected' : '' ?> value="{{ $category->id }}">
                <?= __names($category, 'category_name'); ?>
            </option>
        <?php endif; ?>
        @endforeach
    </select>
</div>


@foreach ($languages as $lang)
<?php
$subcategory_names = $item->getTranslations()->pluck('subcategory_name', 'language');
?>

<div class="form-group">
    <label><?= __('subcategory_name') ?> <span data-toggle="tooltip" data-title="{{$lang->language_name}}"><?= country($lang->country_id)->flag ?></span> <?= __required() ?></label>
    <input type="text" name="subcategory_name[<?= $lang->slug ?>]" class="form-control" value="{{ $subcategory_names[$lang->slug] ?? '' }}">
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