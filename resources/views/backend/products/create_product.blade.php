@extends('backend.vendor.layouts.app')
@section('content')
    <?php if($tax_list->count() < 1):?>
    <!-- Tax Area -->
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
                                <h4><?= __('tax_configuration') ?></h4>
                                <p> <?= __('please_configure_tax_before_create_a_new_product') ?></p>
                            </div>
                        </div>

                        <div class="stepBtn">
                            <a href="<?= url('vendor/settings/tax-configuration') ?>" target="_blank"
                                class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= __('add_tax') ?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tax Area -->
    <?php endif; ?>

    <?php if($categories->count() < 1):?>
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

    <form action="<?= url('vendor/products/add_product') ?>" method="post" onsubmit="formSubmit(event,this);">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= __('create_product_item') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= __('category_name') ?></label>
                                <select name="category_id" id="category_id" class="form-control"
                                    onchange="get_subcat(this.value)">
                                    <option value=""><?= __('select') ?></option>
                                    @foreach ($categories as $row)
                                        <?php $cat_names = __langData($row->id, 'category_id', 'vendor_category_list_ln'); ?>
                                        <?php if($row->status == 1):?>
                                        <option <?= isset($item->category_id) && ($item->category_id == $row->id) ? 'selected':'' ?> value="{{ $row->id }}">{{ __names($cat_names, 'category_name') }}
                                        </option>
                                        <?php endif; ?>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?= __('subcategories') ?></label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value=""><?= __('select') ?></option>
                                    <?php if(isset($item->subcategory_id)):?>
                                        <?php $subcategory_list = get_subcategories_by_cat_id($item->category_id); ?>

                                        @foreach ($subcategory_list as $subCat)
                                            <?php $subcatData = __langData($subCat->id, 'subcategory_id', 'vendor_subcategory_list_ln') ?>

                                            <option <?= $subCat->id == $item->subcategory_id ? 'selected':'' ?> value="<?= $subCat->id ?>"><?= __names($subcatData, 'subcategory_name') ?></option>
                                        @endforeach
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex mb-10">
                                    <label class="pointer checkBtn c-white btn btn-purple custom-checkbox">
                                        <input type="checkbox" name="is_variants" class="is_size defaultToggle"
                                            value="1" <?= isset($item->is_variants) && $item->is_variants == 1 ? 'checked':'' ?>>&nbsp; {{ __('is_variants') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row itemPriceArea <?= isset($item->is_variants) && $item->is_variants == 1 ? 'hidden':'' ?>">
                            <div class="form-group col-md-6">
                                <label><?= __('current_price') ?></label>
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="price" class="form-control number"
                                        placeholder="<?= __('current_price') ?>" value="{{ isset($item->price) ? $item->price : '' }}">
                                    <div class="input-group">
                                        <span>$</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?= __('previous_price') ?></label>
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="previous_price" class="form-control number"
                                        placeholder="<?= __('previous_price') ?>" value="{{ isset($item->previous_price) ? $item->previous_price : '' }}">
                                    <div class="input-group">
                                        <span>$</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $tax_data = isset($item->tax) ? json_decode($item->tax) : []; ?>
                        <?php if($tax_list->count() > 0):?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label><?= __('tax') ?></label>
                                <select name="tax[]" id="tax" class="form-control">
                                    <option value="">{{ __('select') }}</option>
                                    @foreach ($tax_list as $tax)
                                        <?php if($tax->status == 1):?>
                                        <option value="{{ $tax->id }}" <?= isset($tax_data) && in_array($tax->id, $tax_data) ? 'selected':''  ?>>
                                            {{ $tax->tax_percentage . ' % ' . $tax->tax_status }}</option>
                                        <?php endif; ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                                <!----------------------------------------------
                                Multilanguagl area
                        ---------------------------------------------->
                        <div class="multLangArea">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach (shop_language() as $key => $lang)
                                    <a class="nav-item nav-link <?= ($key == 0) ? 'active':'' ?>" id="nav-<?= $lang->slug ?>-tab" data-toggle="tab" href="#<?= $lang->slug ?>"
                                        role="tab" aria-controls="nav-<?= $lang->slug ?>" aria-selected="true">
                                        <?= country($lang->country_id)->flag ?> &nbsp; <?= $lang->language_name ?>
                                    </a>
                                    @endforeach
                                </div>
                            </nav>

                            <div class="tab-content pt-10" id="nav-tabContent">

                                @foreach (shop_language() as $key => $lang)


                                    <?php
                                        $itemDetails = null;
                                        if(isset($item->item_details) && !empty($item->item_details)){
                                            foreach ($item->item_details as $key => $details) {
                                                if($details->language == $lang->slug){
                                                    $itemDetails = $details;
                                                    break;
                                                }
                                            }
                                        }
                                    ?>


                                    <div class="tab-pane fade  <?= ($key == 0) ? 'show active':'' ?>" id="<?= $lang->slug ?>" role="tabpanel"
                                        aria-labelledby="nav-<?= $lang->slug ?>-tab" dir="<?= $lang->slug ?>">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label><?= country($lang->country_id)->flag ?> {{ __('title') }}</label>
                                                <input type="text" name="title[<?= $lang->slug ?>]" class="form-control"
                                                    placeholder="<?= $lang->language_name .' '. __('title') ?>" value="<?= isset($itemDetails->title) ? $itemDetails->title:'' ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 show_variatns_price <?= isset($item->is_variants) && $item->is_variants == 1 ? '':'hidden' ?>" >
                                                <div class="card border-radius-0">
                                                    <div class="card-header">
                                                        <h4 class="card-title">{{ __('variants') }}</h4>
                                                        <?= __addbtn('', __('add_variants'), ['is_modal' => true, 'target' => 'variantModal_'.$lang->slug]) ?>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="variantsLoad_<?= $lang->slug ?>">
                                                            @include('backend.products.inc.ajax_update_variants')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>{{ __('description') }}</label>
                                                <textarea name="description[<?= $lang->slug ?>]" class="form-control textarea">
                                                    <?= isset($itemDetails->description) ? $itemDetails->description:'' ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="languages[]" value="<?= $lang->slug ?>">
                                @endforeach
                            </div><!-- tab-content -->

                        </div>
                                <!----------------------------------------------
                                Multilanguagl area
                        ---------------------------------------------->
                    </div><!-- card-body -->

                </div>
            </div><!-- col/8 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label><?= __('images') ?></label>
                            <div class="mb-4">
                                <?= media_files('image', 'single',  isset($item) ? __isset($item, 'thumb') :'') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?= __('food_preference') ?></label>
                            <select name="veg_type" id="veg_type" class="form-control niceSelect">
                                <option value=""><?= __('none') ?></option>
                                <option <?= isset($item->veg_type) && $item->veg_type == 'veg' ? 'selected':'' ?> value="veg"><?= __('vegetarian') ?></option>
                                <option <?= isset($item->veg_type) && $item->veg_type == 'nonveg' ? 'selected':'' ?> value="nonveg"><?= __('non_vegetarian') ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= __('allergens') ?></label>
                            <select name="allergen_names[]" id="veg_type" class="form-control">
                                <option value="">{{ __('select') }}</option>
                                @foreach ($allergen_list as $allergen)
                                    <?php $lang_names = __langData($allergen->id, 'allergen_id', 'vendor_allergen_list_ln'); ?>

                                    <?php if($allergen->status == 1):?>
                                    <option value="{{ $allergen->id }}">
                                        <?= __names($lang_names, 'allergen_name') ?>
                                    </option>
                                    <?php endif; ?>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="mt-2rm">
                                <label class="custom-checkbox btn btn-info pl-5">
                                    <input type="checkbox" name="is_feature" value="1" <?= isset($item->is_feature) && $item->is_feature == 1 ? 'checked':'' ?>>
                                    <?= __('mark_as_feature_item') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="hidden" name="id" value="<?= isset($item->id) ? $item->id : 0 ?>">
                        <button type='submit' class='btn btn-primary btn-block '><?= __('submit') ?> <i
                                class='icofont-hand-drag1'></i></button>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </form>



    <!-- Variant Modal -->
    @foreach (shop_language() as $key => $lang)
    <div id="variantModal_<?= $lang->slug ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/create_product_variants/'.$lang->slug) ?>" method="post"
                enctype="multipart/form-data" class="productVariants" data-lang="<?= $lang->slug ?>">
                <!-- csrf token -->
                @csrf
                <span class="errorMsg"></span>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('add_variants') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="variantModalBoday">
                            <div class="form-group">
                                <label>{{ __('variant_name') }} </label>
                                <input type="text" name="variant_name" class="form-control"
                                    placeholder="{{ __('variant_name') }}" value="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('variant_options') }}</label>
                                <input type="text" name="variant_options" class="form-control" placeholder="Ex. Small|Medium|Large"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary"><?= lang('submit') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <script>
        function get_subcat(cat_id) {
            var url = `${base_url}vendor/products/get_subcategory/${cat_id}`;
            console.log(url);
            $.get(url, {
                _csrf
            }, function(json) {
                console.log(json);
                $('[name="subcategory_id"]').html(json.data);
            }, 'json');
            return false;
        }
    </script>


    <script>
        $(document).on('change', '[name="is_variants"]', function() {
            if ($(this).is(':checked')) {
                $('.itemPriceArea').slideUp();
                $('.show_variatns_price').slideDown();
            } else {
                $('.itemPriceArea').slideDown();
                $('.show_variatns_price').slideUp();
            }
        });
    </script>
@endsection
