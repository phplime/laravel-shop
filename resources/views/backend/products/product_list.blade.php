@extends('backend.vendor.layouts.app')
@section('content')

<?php if ($categories->count() < 1): ?>
    <!-- Category Area -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="guideStep d-flex space-between align-center">
                        <div class="stepTopArea d-flex align-center gap-20">
                            <div class="step">
                                1
                            </div>
                            <div class="stepDetails">
                                <h4><?= __('add_categories') ?></h4>
                                <p> <?= __('you_have_to_add_category_before_create_a_new_product') ?></p>
                            </div>
                        </div>

                        <div class="stepBtn">
                            <a href="<?= url('vendor/products/categories') ?>" target="_blank"
                                class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= __('add_categories') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Area -->
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex gap-10 flex-1 align-center">
                    <h5 class="card-title flex-0"><?= __('product_list') ?></h5>
                </div>
                <div class="card-tools">
                    <a href="<?= url('vendor/products/create-product') ?>"
                        class="btn btn-secondary text-right btn-sm addBtn"><i class="fa fa-plus"></i>
                        <?= __('add_new') ?></a>
                </div>
            </div>

            <div class="card-body pt-10">
                <div class="productCategoryList">
                    <ul class="menuUl flex-nowrap">
                        <li class="<?= !isset($_GET['category']) && empty($_GET['category']) ? 'active' : '' ?>">
                            <a href="<?= url('vendor/products/') ?>" class="px-1rm py-13"> <i class="fa fa-list"></i>
                                <?= __('all') ?>
                            </a>
                        </li>

                        @foreach ($categories as $category)
                        <?php if ($category->total_items > 0): ?>
                            <li class="<?= isset($_GET['category']) && $_GET['category'] == str_slug($category->category_names) ? 'active' : ''  ?>">
                                <a href="<?= url('vendor/products/?category=' . str_slug($category->category_names)) ?>">
                                    <img src="<?= __image($category->thumb, 'thumb') ?>" alt="category_image"
                                        class="avatar round">
                                    <span class="badge badge-success">{{ $category->total_items }}</span>
                                    {{ $category->category_names }}
                                </a>
                            </li>
                        <?php endif; ?>
                        @endforeach

                    </ul>
                </div>
                <div class="card-content">
                    <div class="table-responsive responsiveTable">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('image') ?></th>
                                    <th><?= __('title') ?></th>
                                    <th width="30%"><?= __('price') ?></th>
                                    <th><?= __('extras') ?></th>
                                    <th width="15%"><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_list as $key => $row)
                                <tr id="hide_<?= $row->id ?>" data-label="#">
                                    <td data-label="#">{{ $key+1 }}</td>
                                    <td data-label="<?= __('image') ?>">
                                        <div class="productMixImg">
                                            <img src="<?= __image($row->thumb, 'thumb') ?>" alt="product_img" class="avatar round">
                                        </div>
                                    </td>
                                    <td data-label="<?= __('title') ?>">
                                        <?= __names($row, 'title', true) ?>
                                    </td>
                                    <td data-label="<?= __('price') ?>">
                                        <?= __variantPrice($row, true) ?>
                                    </td>
                                    <td data-label="<?= __('extras') ?>">
                                        <?= __vegType($row, true); ?>
                                        <div class="d-flex">
                                            <?= __('tax'); ?> : &nbsp;<?= __itemTax($row) ?>
                                        </div>
                                    </td>
                                    <td class="text-center" data-label="<?= __('action') ?>">
                                        <div class="btnGroup">
                                            <a class="btn btn-secondary btn-sm" href="<?= url('/vendor/products/show/' . $row->id) ?>" target="_blank">
                                                <i class="fa fa-eye"></i> <?= __('view') ?>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="<?= url('/vendor/products/addons/' . $row->id) ?>">
                                                <i class="icofont-library"></i> <?= __('addons') ?>
                                            </a>
                                            <a class="btn btn-primary btn-sm" href="<?= url('/vendor/products/edit-product/' . $row->id) ?>">
                                                <i class="fa fa-edit"></i> <?= __('edit') ?>
                                            </a>
                                            <?= __deleteBtn($row->id, 'vendor_item_list', true) ?>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex aligin-item-center justify-content-center">
                            {!! __pagination($product_list,'ci-pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection