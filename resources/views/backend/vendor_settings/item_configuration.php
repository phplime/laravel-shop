<!-- /.dash-menu -->
<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_order_config_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-8 "; ?> col-xs-12">
        <form action="<?= base_url('vendor/settings/add_item_configuration') ?>" method="post" onsubmit="formSubmit(event,this);">
            <?php csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?= __('item-configuration'); ?></h4>
                </div>
                <div class="card-body">
                    <fieldset>
                        <legend><?= __('image'); ?></legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-switch prefrence-item">
                                    <div class="gap">
                                        <input type="checkbox" id="hide_item_image" name="is_hide_item_image" class="switch-input" data-type="hide_item_image" value="1" <?= __checked(__itemConfg('is_hide_item_image'), 1, 'checked'); ?>>

                                        <label for="hide_item_image" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __("hide_item_image") ?></label>
                                        <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="custom-control custom-switch prefrence-item">
                                    <div class="gap">
                                        <input type="checkbox" id="hide_category_image" name="is_hide_category_image" class="switch-input" data-type="hide_category_image" value="1" <?= __checked(__itemConfg('is_hide_category_image'), 1, 'checked'); ?>>

                                        <label for="hide_category_image" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __("hide_category_image") ?></label>
                                        <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="custom-control custom-switch prefrence-item">
                                    <div class="gap">
                                        <input type="checkbox" id="hide_subcategory_image" name="is_hide_subcategory_image" class="switch-input" data-type="hide_subcategory_image" value="1" <?= __checked(__itemConfg('is_hide_subcategory_image'), 1, 'checked'); ?>>

                                        <label for="hide_subcategory_image" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __("hide_subcategory_image") ?></label>
                                        <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-2rm">
                        <legend><?= __('pagination'); ?></legend>
                        <div class="row">
                            <div class="form-gorup col-md-6">
                                <label><?= __('limit'); ?></label>
                                <input type="text" name="pagination_limit" id="pagination_limit" class="form-control only_number" placeholder="<?= __('pagination'); ?> <?= __('limit'); ?>" value="<?= __itemConfg('pagination_limit') ?? 12; ?>">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-2rm">
                        <legend><?= __('others'); ?></legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-switch prefrence-item">
                                    <div class="gap">
                                        <input type="checkbox" id="disable_cart" name="is_disable_cart" class="switch-input" data-type="disable_cart_image" value="1" <?= __checked(__itemConfg('is_disable_cart'), 1, 'checked'); ?>>

                                        <label for="disable_cart" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __("disable_cart") ?></label>
                                        <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="custom-control custom-switch prefrence-item">
                                    <div class="gap">
                                        <input type="checkbox" id="hide_subcategory" name="is_hide_subcategory" class="switch-input" data-type="hide_subcategory_image" value="1" <?= __checked(__itemConfg('is_hide_subcategory'), 1, 'checked'); ?>>

                                        <label for="hide_subcategory" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __("hide_subcategory_from_menu") ?></label>
                                        <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div><!-- card-body -->

                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>

            </div>
    </div>
    </form>
</div>
</div>