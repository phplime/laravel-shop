<div id="mainContent">

    <div class="row">
        <?php $security_settings = __settingsJson('security_config'); ?>

        <div class="col-md-8">
            <?= __startForm(base_url('admin/settings/save_security_settings'), 'post'); ?>
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?= __('twofactor_authentication'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>
                                <legend><?= __('otp'); ?></legend>
                                <div class="form-group">
                                    <label class="custom-radio"><input type="radio" name="otp_type" value="email" <?= isset($security_settings['otp_type']) && $security_settings['otp_type'] == 'email' ? "checked" : ""; ?> checked> <?= __('email'); ?></label>
                                </div>
                                <div class="form-group">
                                    <label for=""><?= __('otp_expiration_time'); ?></label>
                                    <div class="ci-input-group input-group-prepand">
                                        <input type="text" name="otp_expire_time" class="form-control number" value="<?= isset($security_settings['otp_expire_time']) && !empty($security_settings['otp_expire_time']) ? $security_settings['otp_expire_time'] : 10; ?>">
                                        <div class="input-group ci-color px-5">
                                            <span> <?= __('minutes'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row mt-2rm">
                        <div class="col-md-6">
                            <fieldset>
                                <legend><?= __('admin_login'); ?> </legend>
                                <div class="form-group">
                                    <label class="custom-checkbox checkBtn btn-block btn-default btn"> <input type="checkbox" name="is_admin_twofa" value="1" <?= isset($security_settings['is_admin_twofa']) && $security_settings['is_admin_twofa'] == 1 ? "checked" : ""; ?>> <?= __('enable'); ?></label>
                                </div>
                                <div class="form-group">
                                    <label><?= __('max_attempts'); ?> <small>( <?= __('invalid_login'); ?> <?= __required(); ?>)</small></label>
                                    <input type="text" name="admin_max_attempts" class="form-control number" value="<?= isset($security_settings['admin_max_attempts']) && !empty($security_settings['admin_max_attempts']) ? $security_settings['admin_max_attempts'] : 5; ?>">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="">
                                <legend><?= __('vendor_login'); ?> </legend>
                                <div class="form-group">
                                    <label class="custom-checkbox checkBtn btn-block btn-default btn"> <input type="checkbox" name="is_vendor_twofa" <?= isset($security_settings['is_vendor_twofa']) && $security_settings['is_vendor_twofa'] == 1 ? "checked" : ""; ?>> <?= __('enable'); ?></label>
                                </div>
                                <div class="form-group">
                                    <label><?= __('max_attempts'); ?> <small>(<?= __('invalid_login'); ?> <?= __required(); ?>)</small></label>
                                    <input type="text" name="vendor_max_attempts" class="form-control number" value="<?= isset($security_settings['vendor_max_attempts']) && !empty($security_settings['vendor_max_attempts']) ? $security_settings['vendor_max_attempts'] : 5; ?>">
                                </div>
                            </fieldset>
                        </div>
                    </div><!-- row -->
                    <div class="row mt-3rm">
                        <div class="col-md-6">
                            <fieldset>
                                <legend><?= __('max_signup_attempts'); ?></legend>
                                <div class="form-group">
                                    <label class="custom-checkbox checkBtn btn-block btn-default btn"> <input type="checkbox" name="is_signup_attempts" <?= isset($security_settings['is_signup_attempts']) && $security_settings['is_signup_attempts'] == 1 ? "checked" : ""; ?>> <?= __('enable'); ?></label>
                                </div>
                                <div class="form-group">
                                    <div class="ci-input-group input-group-append">
                                        <div class="input-group ci-color px-5">
                                            <span> <?= __('signup'); ?></span>
                                        </div>
                                        <input type="text" name="signup_max_attempts" class="form-control number" value="<?= isset($security_settings['signup_max_attempts']) && !empty($security_settings['signup_max_attempts']) ? $security_settings['signup_max_attempts'] : 5; ?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>