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
                                    @foreach ($category_list as $key => $category)
                                        <tr id="hide_{{ $key + 1 }}">
                                            <td data-label="#">{{ $key + 1 }}</td>
                                            <td data-label="<?= __('images') ?>">
                                                <img src="<?= __image($category->thumb, 'thumb') ?>" alt="category_image"
                                                    class="avatar round">
                                            </td>
                                            <td data-label="<?= __('category_name') ?>">

                                                @foreach ($category->category_names as $value)

                                                    <?php $language_details = __single_lang_by_slug($value->language); ?>

                                                    <div class="langItem">
                                                        <span data-title="{{ $language_details->language_name }}" data-toggle="tooltip">
                                                            <?= $language_details->flag ?>
                                                        </span>
                                                        <span class="title-text">{{ $value->category_name }}</span>
                                                        <div class="shareOptions">
                                                            <a href="" target="_blank" data-title="Share"
                                                                data-toggle="tooltip" data-original-title="" title="">
                                                                <i class="fa fa-share"></i>
                                                            </a>
                                                            <a href="javascript:;" class="copy-btn" data-url=""
                                                                onclick="copyToClipboard(this)" data-title="Copy"
                                                                data-toggle="tooltip" data-original-title="" title="">
                                                                <i class="fa fa-copy"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </td>
                                            <td data-label="<?= __('status') ?>">
                                                <?= __status($category->id, $category->status, 'vendor_category_list') ?>
                                            </td>
                                            <td data-label="<?= __('action') ?>" class="">
                                                <div class="btnGroup">
                                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_category_'.$category->id]) ?>
                                                    <?= __deleteBtn($category->id, 'vendor_category_list', true) ?>
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

    <?= __header(__('add_new'), url('vendor/products/add_category'), 'add_category') ?>

    @foreach (shop_language() as $lang)
        <div class="form-group">
            <label><?= __('category_name') ?> <?= country($lang->country_id)->flag ?></label>
            <input type="text" name="category_name[<?= $lang->slug ?>]" class="form-control">
        </div>
    @endforeach


    <div class="form-group">
        <label><?= __('image') ?> </label>
        <div class="mb-4">
            <?= media_files('image', 'single', '') ?>
        </div>

    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>


    <!----------------------
            Edit Area
            ---------------------->
    @foreach ($category_list as $items)
    <?= __header(__('edit'), url('vendor/products/add_category'), 'edit_category_'.$items->id) ?>


    @foreach (shop_language() as $lang)

        @php
            $category_names = [];
            foreach ($items->category_names as $value) {
                $category_names[$value->language] = $value->category_name;
            }
        @endphp

        <div class="form-group">
            <label><?= __('category_name') ?> <?= country($lang->country_id)->flag ?></label>
            <input type="text" name="category_name[<?= $lang->slug ?>]" class="form-control" value="{{ isset($category_names[$lang->slug]) ? $category_names[$lang->slug]:'' }}">
        </div>

    @endforeach

    <div class="form-group">
        <label><?= __('image') ?></label>
        <div class="mb-4">
            <?= media_files('image', 'single', __isset($items, 'thumb')) ?>
        </div>

    </div>
    <?= hidden('id', __isset($items, 'id')) ?>
    <?= __footer() ?>
    @endforeach


@endsection
