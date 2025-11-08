@extends('backend.vendor.layouts.app')
@section('content')
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
                            <a href="<?= url('vendor/settings/tax_configuration') ?>" target="_blank"
                                class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= __('add_tax') ?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tax Area -->

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
                                    <option value="1">Burger</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?= __('subcategories') ?></label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value=""><?= __('select') ?></option>
                                    <option value="1">pizza</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex mb-10">
                                    <label class="pointer checkBtn c-white btn btn-purple custom-checkbox">
                                        <input type="checkbox" name="is_variants" class="is_size defaultToggle"
                                            value="1">&nbsp; Is variants
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row itemPriceArea">

                            <div class="form-group col-md-6">
                                <label><?= __('current_price') ?></label>
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="price" class="form-control number"
                                        placeholder="<?= __('current_price') ?>" value="">
                                    <div class="input-group">
                                        <span>$</span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group col-md-6">
                                <label><?= __('previous_price') ?></label>
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="previous_price" class="form-control number"
                                        placeholder="<?= __('previous_price') ?>" value="">
                                    <div class="input-group">
                                        <span>
                                            $
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label><?= __('tax') ?></label>

                                <select name="tax[]" id="tax" class="form-control select2" multiple>
                                    <option value="">10% included</option>
                                </select>
                            </div>
                        </div>

                        <!----------------------------------------------
         Multilanguagl area
         ---------------------------------------------->
                        <div class="multLangArea">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link" id="nav-en-tab" data-toggle="tab" href="#en"
                                        role="tab" aria-controls="nav-en" aria-selected="true">
                                        English
                                    </a>
                                </div>
                            </nav>
                            <div class="tab-content pt-10" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="en" role="tabpanel"
                                    aria-labelledby="nav-en-tab" dir="en">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>English</label>
                                            <input type="text" name="title[en]" class="form-control"
                                                placeholder="english title" value="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 show_variatns_price ">
                                            <div class="card border-radius-0">
                                                <div class="card-header">
                                                    <h4 class="card-title">{{ __('variants') }}</h4>
                                                    <?= __addbtn('', 'add_variants', ['is_modal' => true, 'target' => 'variantModal_en']) ?>
                                                </div>
                                                <div class="card-body">
                                                    <div class="variantsLoad_en">
                                                        @include('backend.products.inc.ajax_update_variants')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{ __('description') }}</label>
                                            <textarea name="description[en]" class="form-control textarea">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat libero laudantium ea rem voluptates debitis.
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="languages[]" value="en">
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

                            </div>
                        </div>

                        <div class="form-group">
                            <label><?= __('food_preference') ?></label>
                            <select name="veg_type" id="veg_type" class="form-control niceSelect">
                                <option value=""><?= __('none') ?></option>
                                <option value="veg">
                                    <?= __('vegetarian') ?></option>
                                <option value="nonveg">
                                    <?= __('non_vegetarian') ?></option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label><?= __('allergens') ?></label>
                            <select name="allergen_names[]" id="veg_type" class="form-control select2" multiple>
                                <option value="1">Milk</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="mt-2rm">
                                <label class="custom-checkbox btn btn-info pl-5">
                                    <input type="checkbox" name="is_feature" value="1">
                                    <?= __('mark_as_feature_item') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="hidden" name="id" value="0">
                        <button type='submit' class='btn btn-primary btn-block '><?= __('submit') ?> <i
                                class='icofont-hand-drag1'></i></button>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </form>




    <div id="variantModal_en" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/create_product_variants/') ?>" method="post"
                enctype="multipart/form-data" class="productVariants" data-lang="en">
                <!-- csrf token -->
                @csrf
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
                                <input type="text" name="variant_options" class="form-control" placeholder=""
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


    {{-- <script>
    function get_subcat(cat_id) {
        var url = `${base_url}vendor/products/get_subcategory/${cat_id}`;
        console.log(url);
        $.get(url, {
            _csrf_token
        }, function(json) {
            console.log(json);
            $('[name="subcategory_id"]').html(json.data);
        }, 'json');
        return false;
    }
</script> --}}


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
