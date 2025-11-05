<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_order_config_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-8 "; ?> col-xs-12">
        <?= __startForm(base_url('vendor/settings/add_order_config'), 'post'); ?>
        <?= csrf(); ?>
        <div class="card">
            <div class="card-header">
                <h4><?= lang('order-configuration'); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= __('prepared_time'); ?></label>
                        <div class="ci-input-group input-group-prepand">
                            <input type="text" name="prepared_time" class="form-control" value="<?= __orderConfig('prepared_time') ?? 10; ?>">
                            <div class="input-group">
                                <select name="time_type" id="time_type" class="btn-primary">
                                    <option value="minutes" <?= __checked(__orderConfig('', 'time_type'), 'minutes', 'selected'); ?>><?= __('minutes'); ?></option>
                                    <option value="hours" <?= __checked(__orderConfig('', 'time_type'), 'hours', 'selected'); ?>><?= __('hours'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!----------------------------------------------
    checkout configuratio
---------------------------------------------->

                <fieldset class="mt-1rm mb-2rm">
                    <legend><?= __('checkout') ?> </legend>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="custom-control custom-switch prefrence-item">
                                <div class="gap">
                                    <input type="checkbox" id="guest_login" name="is_guest_login" class="switch-input" data-type="guest_login" value="1" <?= __checked(__orderConfig('checkout_config', 'is_guest_login'), 1, 'checked'); ?>>

                                    <label for="guest_login" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                </div>
                                <div class="preText">
                                    <label class="custom-label"><?= __("guest_login") ?></label>
                                    <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="custom-control custom-switch prefrence-item">
                                <div class="gap">
                                    <input type="checkbox" id="is_customer_login" name="is_customer_login" class="switch-input" <?= __checked(__orderConfig('checkout_config', 'is_customer_login'), 1, 'checked'); ?>>
                                    <label for="is_customer_login" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                </div>
                                <div class="preText">
                                    <label class="custom-label"><?= __("customer_login") ?></label>
                                    <p class="text-muted"><small><?= __("enable_to_allow") ?></small></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-input col-md-12">
                            <fieldset>
                                <legend><?= __('customer_login'); ?></legend>
                                <div class="row mb-15">
                                    <div class="col-md-12 mb-1rm">
                                        <label class="custom-checkbox"><input type="checkbox" name="is_otp_login" id="is_otp_login" <?= __checked(__orderConfig('checkout_config', 'is_otp_login'), 1, 'checked'); ?>>
                                            <div class="flex direction-column">
                                                <p><?= __('otp_based_login'); ?></p>
                                                <small><?= __('enable_to_allow'); ?></small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="custom-radio-2"><input type="radio" name="otp_login_system" id="otp_login" <?= __checked(__orderConfig('checkout_config', 'otp_login_system'), 'email', 'checked'); ?> value="email" checked> <i class="far fa-envelope"></i> &nbsp; <?= __('email'); ?></label>
                                    </div>

                                    <div class="col-md-6 hidden">
                                        <label class="custom-radio-2"><input type="radio" name="otp_login_system" id="otp_login" <?= __checked(__orderConfig('checkout_config', 'otp_login_system'), 'phone', 'checked'); ?> value="phone"> <i class="fas fa-mobile-alt"></i> &nbsp; <?= __('phone'); ?></label>
                                    </div>
                                </div>


                                <div class="row hidden">
                                    <div class="col-md-6">
                                        <label class="custom-checkbox"><input type="checkbox" name="is_checkout_email" id="is_email" <?= __checked(__orderConfig('checkout_config', 'is_checkout_email'), 1, 'checked'); ?>> <?= __('enable_to_allow'); ?></label>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="custom-checkbox"><input type="checkbox" name="is_email_required" id="is_email_required" <?= __checked(__orderConfig('checkout_config', 'is_email_required'), 1, 'checked'); ?>> <?= __('is_required'); ?></label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>


                <fieldset class="mt-1rm hidden">
                    <legend><?= __('order_merge'); ?></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch prefrence-item">
                                <div class="gap">
                                    <input type="checkbox" id="is_order_merge" name="is_order_merge" class="switch-input" <?= __checked(__orderConfig('order_merge_config', 'is_order_merge'), 1, 'checked'); ?> onchange="statusDiv(this,'mergeDiv');">
                                    <label for="is_order_merge" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                </div>
                                <div class="preText">
                                    <label class="custom-label"><?= __("order_merge") ?></label>
                                    <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mergeDiv <?= __orderConfig('order_merge_config', 'is_order_merge') == 1 ? "" : "dis_none"; ?>">
                                <div class="row  mt-20">
                                    <div class="form-group col-md-6">
                                        <label class="custom-radio"><input type="radio" name="is_system" value="1" <?= __checked(__orderConfig('order_merge_config', 'is_system'), 1, 'checked'); ?> checked><?= lang('merge_automatically'); ?></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="custom-radio"><input type="radio" name="is_system" value="2" <?= __checked(__orderConfig('order_merge_config', 'is_system'), 2, 'checked'); ?>><?= lang('allow_customers_to_select'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mt-2rm">
                    <legend><?= __('offers') . ' / ' . __('others'); ?></legend>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="custom-checkbox mb-1rm"><input type="checkbox" name="is_discount" value="1" onchange="showDiv(this,'discountDiv')" <?= __checked(__orderConfig('offer_config', 'is_discount'), 1, 'checked'); ?>> <?= __("discount"); ?></label>

                            <div class="discountDiv <?= __orderConfig('offer_config', 'is_discount') == 1 ? "" : "dis_none"; ?> ">
                                <div class="ci-input-group input-group-prepand ">
                                    <input type="text" name="discount" class="form-control number" value="<?= __orderConfig('offer_config', 'discount'); ?>">
                                    <div class="input-group">
                                        <select name="discount_type" id="discount_type" class="max-w-100 ci-color">
                                            <option value="flat" <?= __checked(__orderConfig('offer_config', 'discount_type'), 'flat', 'selected'); ?>><?= __('flat'); ?></option>
                                            <option value="percentage" <?= __checked(__orderConfig('offer_config', 'discount_type'), 'percentage', 'selected'); ?>> % </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            <label class="custom-checkbox mb-1rm"><input type="checkbox" name="is_service_charge" value="1" onchange="showDiv(this,'serviceChargeDiv')" <?= __checked(__orderConfig('offer_config', 'is_service_charge'), 1, 'checked'); ?>> <?= __("service_charge"); ?></label>

                            <div class="serviceChargeDiv <?= __orderConfig('offer_config', 'is_service_charge') == 1 ? "" : "dis_none"; ?>">
                                <div class="ci-input-group input-group-prepand">
                                    <input type="text" name="service_charge" class="form-control number" value="<?= __orderConfig('offer_config', 'service_charge'); ?>">
                                    <div class="input-group">
                                        <select name="service_charge_type" id="service_charge_type" class="max-w-100 ci-color">
                                            <option value="flat" <?= __checked(__orderConfig('offer_config', 'service_charge_type'), 'flat', 'selected'); ?>><?= __('flat'); ?></option>
                                            <option value="percentage" <?= __checked(__orderConfig('offer_config', 'service_charge_type'), 'percentage', 'selected'); ?>> % </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </fieldset>


                <fieldset class="mt-2rm">
                    <legend><?= __('tips'); ?></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch prefrence-item">
                                <div class="gap">
                                    <input type="checkbox" id="is_tips" name="is_tips" class="switch-input" value="1" <?= __checked(__orderConfig('tips_config', 'is_tips'), 1, 'checked'); ?> onchange="statusDiv(this,'tipsDiv');">
                                    <label for="is_tips" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                                </div>
                                <div class="preText">
                                    <label class="custom-label"><?= __("tips") ?></label>
                                    <p class="text-muted"><small><?= __("enable_to_allow") ?></small> </p>

                                </div>
                            </div>
                        </div>
                        <?php $tips = __isJson(__orderConfig('tips_config', 'tips_data')); ?>
                        <div class="col-md-12">
                            <div class="tipsDiv <?= __orderConfig('tips_config', 'is_tips') == 1 ? "" : "dis_none"; ?>">
                                <div class="row  mt-20 ">
                                    <?php for ($i = 0; $i <= 2; $i++) { ?>
                                        <div class="form-group col-md-4">
                                            <label><?= __('set_tip_percent'); ?></label>
                                            <div class="ci-input-group input-group-prepand">
                                                <input type="text" name="tips[<?= $i; ?>]" class="form-control number" value="<?= !empty($tips[$i]->tips) ? $tips[$i]->tips : ''; ?>">
                                                <div class="input-group ci-color">
                                                    <span> %</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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

        <?= __endForm(); ?>
    </div>
</div><!-- row -->



<script>
    function showDiv($this, className) {
        if ($($this).is(':checked')) {
            $($this).closest('.form-group').find('.' + className).slideDown();
        } else {
            $($this).closest('.form-group').find('.' + className).slideUp();
        }
    }
</script>