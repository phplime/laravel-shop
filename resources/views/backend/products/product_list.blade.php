@extends('backend.vendor.layouts.app')
@section('content')
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
                            <li class="active">
                                <a href="<?= url('vendor/products/') ?>" class="px-1rm py-13"> <i class="fa fa-list"></i>
                                    <?= __('all') ?>
                                </a>
                            </li>

                            <li class="">
                                <a href="<?= url('vendor/products/?category=pizza') ?>">
                                    <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}" alt="category_image"
                                        class="avatar round">
                                    <span class="badge badge-success">5</span>
                                    pizza
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered table-striped  data-table">
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

                                    <tr id="hide_1" data-label="#">
                                        <td data-label="#">1</td>
                                        <td data-label="<?= __('image') ?>">
                                            <div class="productMixImg">
                                                <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                    alt="product_img" class="avatar round">
                                            </div>
                                        </td>
                                        <td data-label="<?= __('title') ?>">
                                            pizza
                                        </td>
                                        <td data-label="<?= __('price') ?>">
                                            $34.00

                                            <!-- Variant Price -->
                                            <div class="priceGroup variantGroup">
                                                <div class="variantArea">
                                                    <div class="langItem">
                                                        <span data-title="English" data-toggle="tooltip"
                                                            data-original-title="" title=""><i class="fi fi-us"></i>
                                                        </span>
                                                        <span> size</span>
                                                    </div>
                                                    <ul>
                                                        <li><a href="javascript:;">x : 120.00 $</a></li>
                                                        <li><a href="javascript:;">l : 180.00 $</a></li>
                                                    </ul>
                                                </div>
                                                <div class="variantArea">
                                                    <div class="langItem">
                                                        <span data-title="عربي" data-toggle="tooltip" data-original-title=""
                                                            title="">
                                                            <i class="fi fi-sa"></i>
                                                        </span>
                                                        <span> مقاس</span>
                                                    </div>
                                                    <ul>
                                                        <li><a href="javascript:;">م : 120.00 $</a></li>
                                                        <li><a href="javascript:;">س : 180.00 $</a></li>
                                                    </ul>
                                                </div>
                                                <div class="variantArea">
                                                    <div class="langItem">
                                                        <span data-title="Español" data-toggle="tooltip"
                                                            data-original-title="" title="">
                                                            <i class="fi fi-es"></i>
                                                        </span>
                                                        <span> tamaño</span>
                                                    </div>
                                                    <ul>
                                                        <li><a href="javascript:;">x : 120.00 $</a></li>
                                                        <li><a href="javascript:;">l : 180.00 $</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Variant Price -->
                                        </td>
                                        <td data-label="<?= __('extras') ?>">
                                            <span class="vegType round veg">
                                                <span></span>
                                                Vegetarian
                                            </span>
                                            <div class="d-flex">
											    {{ __('tax') }} : &nbsp;<div class="taxArea"><p class="taxName"><small>SGST 8% Included</small></p></div>
                                            </div>
                                        </td>
                                        <td class="text-center" data-label="<?= __('action') ?>">
                                            <div class="btnGroup">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="" target="_blank"><i
                                                        class="fa fa-eye"></i> <?= __('view') ?></a>
                                                <a class="btn btn-info btn-sm"
                                                    href="<?= url("/vendor/products/addons/1") ?>"><i
                                                        class="icofont-library"></i> <?= __('addons') ?></a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="<?= url("/vendor/products/edit_product/1") ?>"><i
                                                        class="fa fa-edit"></i> <?= __('edit') ?></a>
                                                <a href="<?= url("delete-item/1/vendor_item_list") ?>"
                                                    data-id="1" data-msg="<?= __('want_to_delete') ?>"
                                                    class="action_btn btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    <?= __('delete') ?></a>
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
@endsection
