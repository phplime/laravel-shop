<div class="row">
    <?php $this->load->view('backend/settings/inc/settings_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="col-lg-8">
        <?= __startForm(base_url('admin/settings/save_landingpage', 'post')); ?>
        <?= csrf() ?>
        <?php $landing = __settingsJson('landingpage_config'); ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="custom-control custom-switch prefrence-item">
                            <div class="gap">
                                <input type="checkbox" id="is_custom_landing_page" name="is_custom_landing_page" class="switch-input" <?= isset($landing['is_custom_landing_page']) && $landing['is_custom_landing_page'] == 1 ? "checked" : ''; ?> value="1">
                                <label for="is_custom_landing_page" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

                            </div>
                            <div class="preText">
                                <label class="custom-label"><?= __("enable_custom_landing_page") ?></label>
                                <p class="text-muted"><small><?= __("custom_landing_page_msg") ?></small> <?= __isNew('1.0.1') ?></p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group mt-5">
                            <label><?= !empty(lang('landing_page_url')) ? lang('landing_page_url') : "Landing page url"; ?></label>
                            <input type="text" name="landing_page_url" id="url" class="form-control"
                                placeholder="example.com"
                                value="<?= isset($landing['landing_page_url']) ? html_escape($landing['landing_page_url']) : ""; ?>">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="mt-1rm">
                            <legend> <?= __('demo_shop'); ?> </legend>
                            <div class="form-group">
                                <div class="ci-input-group input-group-append">
                                    <div class="input-group">
                                        <span>
                                            <?= asset_url(); ?>
                                        </span>
                                    </div>
                                    <input type="text" name="demo_shop" class="form-control" value="<?= isset($landing['demo_shop']) ? html_escape($landing['demo_shop']) : ""; ?>">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div><!-- card-body -->
            <div class="card-footer text-right">
                <?= __submitBtn(); ?>
            </div>
        </div><!-- card -->
        <?= __endForm(); ?>
    </div>