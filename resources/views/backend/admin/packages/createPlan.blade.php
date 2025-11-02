<x-admin-layout>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 mr-5"><?= __('create_plan') ?></h4>
                </div>
                <form method="POST" action="" onsubmit="formSubmit(event,this);">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="Name"><?= __('name') ?></label>
                                            <input id="Name" class="form-control" type="text"
                                                name="package_name" placeholder="<?= __('name') ?>"
                                                value="<?= isset($data->package_name) ? $data->package_name : '' ?>">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="Name"><?= __('slug') ?></label>
                                            <input id="slug" class="form-control" type="text" name="slug"
                                                placeholder="<?= __('slug') ?>"
                                                value="<?= isset($data->slug) ? $data->slug : '' ?>">

                                        </div>
                                    </div>

                                    <div class="row mb-1rm">
                                        <div class="form-group mb-15 col-md-6">
                                            <label for="Name"><?= __('package_type') ?></label>
                                            <div class="ci-input-group packageTypeInput">
                                                <input type="text" name="duration" id="package_type"
                                                    class="form-control only_number <?= isset($data->package_type) && $data->package_type == 'days' ? '' : 'hidden' ?>"
                                                    value="<?= isset($data->duration) ? $data->duration : 1 ?>">

                                                <div class="input-group max-w-10rm flex-auto btn-primary">
                                                    <select name="package_type" id="planType"
                                                        class="form-control wd-8rm ci-color">
                                                        <option value=""><?= __('select') ?></option>
                                                        <option value="trial">Trial</option>
                                                        <option value="trial">Trial</option>
                                                        <option value="trial">Trial</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Name"><?= __('price') ?></label>
                                            <input id="price" class="form-control only_number" type="text"
                                                name="price" placeholder="<?= __('price') ?>"
                                                value="<?= isset($data->price) ? $data->price : '' ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="Name"><?= __('previous_price') ?></label>
                                            <input id="price" class="form-control only_number" type="text"
                                                name="previous_price" placeholder="<?= __('previous_price') ?>"
                                                value="<?= isset($data->previous_price) ? $data->previous_price : '' ?>">
                                        </div>
                                    </div>

                                </div> <!-- card-content -->
                                <div class="card-content mt-10">
                                    <hr>
                                    <div class="row mb-1rm">
                                        <div class="col-md-6">
                                            <div class="form-group mb-1rm">
                                                <label><?= __('store_limit') ?> <span class='error'> * </span></label>
                                                <input type="number" name="store_limit" class="form-control"
                                                    min="1" step="1"
                                                    value="<?= isset($data->store_limit) ? $data->store_limit : 1 ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-10"><?= __('select_modules') ?></h4>
                                    <ul class="moduleList">
                                        <li>
                                            <label class="custom-checkbox">
                                                <input type="checkbox" name="module_ids[]" value="1"> &nbsp;
                                                Restaurant
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox">
                                                <input type="checkbox" name="module_ids[]" value="2"> &nbsp; Shop
                                                Ecommerce
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox">
                                                <input type="checkbox" name="module_ids[]" value="3"> &nbsp;
                                                Grocery
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-content mt-2rm">
                                    <label
                                        class="custom-checkbox badge badge-danger d-inline-flex alighn-items-center ">
                                        <input type="checkbox" name="is_private" value="1">
                                        <?= __('mark_as_private_package') ?>
                                    </label>
                                </div>

                            </div><!-- col-8 -->

                            <div class="col-md-4">
                                <div class="card-content">
                                    <ul class="featureList">
                                        <li>
                                            <label class="custom-checkbox">
                                                <span>1</span>
                                                <input type="checkbox" name="feature_id[]" value="1"> &nbsp; Home
                                                page
                                                / Landing page
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox">
                                                <span>2</span>
                                                <input type="checkbox" name="feature_id[]" value="2"> &nbsp;
                                                menu
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox">
                                                <span>3</span>
                                                <input type="checkbox" name="feature_id[]" value="3"> &nbsp;
                                                WhatsApp Order
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox">
                                                <span>4</span>
                                                <input type="checkbox" name="feature_id[]" value="4"> &nbsp;
                                                Online
                                                / Digital Paymet
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <?= hidden('id', 0) ?>
                        <a href="<?= url('admin/package') ?>"
                            class="btn btn-default float-left"><?= __('cancel') ?></a>
                        <?= submitBtn() ?>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Restaurant</h4>
                </div>
                <div class="card-body module-details d-flex flex-row flex-wrap space-between align-center">
                    <div class="module_features">
                        <fieldset>
                            <legend class="mb-0"><?= __('module_feature') ?></legend>
                            <ul class="d-flex flex-column gap-10">
                                <li><i class="icofont-long-arrow-right"></i> Allergens</li>
                                <li><i class="icofont-long-arrow-right"></i> Veg Types</li>
                                <li><i class="icofont-long-arrow-right"></i> Variants</li>
                                <li><i class="icofont-long-arrow-right"></i> Extras / Addons</li>
                            </ul>
                        </fieldset>
                    </div>

                    <div class="mt-10 module-order-types">
                        <fieldset>
                            <legend class="mb-0"><?= __('order_types') ?></legend>
                            <ul class="d-flex flex-column gap-10">
                                <li><i class="icofont-long-arrow-right"></i> Cash on delivery</li>
                                <li><i class="icofont-long-arrow-right"></i> Take away / Pickup</li>
                                <li><i class="icofont-long-arrow-right"></i> Dine-in</li>
                                <li><i class="icofont-long-arrow-right"></i> Pay Cash</li>
                            </ul>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on("change", '[name="package_type"]', function() {
            let val = $(this).val();
            if (val == 'days') {
                $('[ name="duration"]').removeClass('hidden');
                $('.packageTypeInput').addClass('input-group-prepand');
            } else {
                $('[ name="duration"]').addClass('hidden');
                $('.packageTypeInput').removeClass('input-group-prepand');
            }
        });
    </script>

</x-admin-layout>
