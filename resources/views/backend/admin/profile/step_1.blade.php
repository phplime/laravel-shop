<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="cardArea">
            <div class="card-header flex-column d-flex align-items-center flex-column">
                <h2><?= __('create_new_store'); ?></h2>
                <p><?= __('create_new_store_msg'); ?></p>
            </div>
            <?= __startForm(base_url('vendor/profile/create_vendor?step=1'), 'post'); ?>
            <?= csrf(); ?>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label><?= lang('logo'); ?></label>
                        <div class="mb-4 wd-200 mx-auto storeLogo">
                            <?= media_files('logo', 'single', __vsettings('logo') ?? ''); ?>
                        </div>
                    </div>
                    <?php if (empty(__vsettings('country_id'))): ?>
                        <div class="form-group">
                            <label><?= __('country'); ?> <?= __required() ?></label>
                            <select name="country_id" id="country_id" class="form-control select2">
                                <option value=""><?= lang("select"); ?></option>
                                <?php foreach (__select('country_list') as $key => $country) : ?>
                                    <option value="<?= $country->id; ?>" <?= __settings('country_id') == $country->id ? "selected" : ""; ?> data-code="<?= $country->dial_code; ?>"> <?= $country->name; ?> (<?= $country->currency_symbol; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label><?= __('store_name'); ?> <span class="error">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label><?= __('phone'); ?> <span class="error">*</span></label>
                        <div class="ci-input-group input-group-append">
                            <div class="input-group">
                                <input type="text" name="dial_code" class="form-control wd-90 only_number" placeholder="+1" value="<?= !empty(__vsettings('dial_code')) ? __vsettings('dial_code') : __settings('dial_code') ?>">
                            </div>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="<?= __('phone'); ?>">
                        </div>
                    </div>

                    <?php foreach ($module_list as $module) : ?>
                        <div class="form-group">
                            <label><?= __('module'); ?> <span class="error">*</span></label>
                            <select name="module_id" class="form-control" id="module_id" onchange="changeModule(this.value)">
                                <option value=""><?= __('select'); ?></option>
                                <?php foreach ($module->module_list as $module_type) : ?>
                                    <option value="<?= $module_type->slug; ?>"><?= $module_type->title; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <?php foreach ($module->module_list as $modules) : ?>
                            <div class="moduleDetails <?= $modules->slug; ?> dis_none mt-10 mb-1rm">
                                <div class="orderTypesArea">
                                    <h5><?= __('order_types'); ?></h5>
                                    <div class="mt-5">
                                        <?php foreach ($modules->order_types as $key => $order_type) : ?>
                                            <label class="label default-light-active "> <?= $order_type->title; ?> </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="orderTypesArea mt-5">
                                    <h5><?= __('attributes'); ?></h5>
                                    <?php foreach ($modules->module_features as $key => $module_feature) : ?>
                                        <label class="label badge-soft-primary"> <?= $module_feature->feature_name; ?> </label>
                                    <?php endforeach; ?>
                                </div>
                                <!-- /.orderTypesArea -->
                            </div>

                        <?php endforeach; ?>
                        <!-- /.moduleDetails -->
                    <?php endforeach; ?>



                    <div class="form-group">
                        <label><?= lang("store_link"); ?></label>
                        <div class="ci-input-group input-group-append">
                            <div class="input-group">
                                <span>
                                    <?= asset_url(); ?>
                                </span>
                            </div>
                            <input type="text" name="username" class="form-control" id="username" value="" placeholder="<?= lang("username"); ?>">
                        </div>

                        <!-- /# -->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= __hidden('vendor_id', 0); ?>
                <button type="submit" class="btn btn-success btn-block w-50 mx-auto"><?= __('continue'); ?> <i class="icofont-arrow-right"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('change', '[name="country_id"]', function() {
        var dial_code = $(this).find('option:selected').data('code');
        $('[name="dial_code"]').val(dial_code);
    });
</script>