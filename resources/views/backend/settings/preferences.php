<div class="row">
    <?php $this->load->view('backend/settings/inc/settings_menu.php',['col' => 'col-lg-8']);?>
    <div class="col-lg-8">
        <div class="custom-control custom-switch prefrence-item ml-10 mt-0">
            <div class="gap">
                <input type="checkbox" id="is_registration" name="set-name" class="switch-input setting_option" data-type="is_registration" data-value="<?= !empty(__config('is_registration'))?__config('is_registration'):0;?>" <?= __config('is_registration')==1?"checked":"";?>>
                <label for="is_registration" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

            </div>
            <div class="preText">
                <label class="custom-label"><?= __("registration_system")?></label>
                <p class="text-muted"><small><?= __("enable_to_allow")?></small> <?= __isNew('1.0.1')?></p>

            </div>
        </div>
        
        <div class="custom-control custom-switch prefrence-item ml-10">
            <div class="gap">
                <input type="checkbox" id="is_email_verification" name="set-name" class="switch-input setting_option" data-type="is_email_verification" data-value="<?= !empty(__config('is_email_verification'))?__config('is_email_verification'):0;?>" <?= __config('is_email_verification')==1?"checked":"";?>>
                <label for="is_email_verification" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

            </div>
            <div class="preText">
                <label class="custom-label"><?= __("email_verification")?></label>
                <p class="text-muted"><small><?= __("enable_to_allow")?></small> <?= __isNew('1.0.1')?></p>

            </div>
        </div>
        
        <div class="custom-control custom-switch prefrence-item ml-10">
            <div class="gap">
                <input type="checkbox" id="is_auto_approve" name="set-name" class="switch-input setting_option" data-type="is_auto_approve" data-value="<?= !empty(__config('is_auto_approve'))?__config('is_auto_approve'):0;?>" <?= __config('is_auto_approve')==1?"checked":"";?>>
                <label for="is_auto_approve" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

            </div>
            <div class="preText">
                <label class="custom-label"><?= __("auto_approve")?></label>
                <p class="text-muted"><small><?= __("enable_to_allow")?></small> <?= __isNew('1.0.1')?></p>

            </div>
        </div>
        
        <div class="custom-control custom-switch prefrence-item ml-10">
            <div class="gap">
                <input type="checkbox" id="is_show_signup_btn" name="set-name" class="switch-input setting_option" data-type="is_show_signup_btn" data-value="<?= !empty(__config('is_show_signup_btn'))?__config('is_show_signup_btn'):0;?>" <?= __config('is_show_signup_btn')==1?"checked":"";?>>
                <label for="is_show_signup_btn" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

            </div>
            <div class="preText">
                <label class="custom-label"><?= __("show_signup_button")?></label>
                <p class="text-muted"><small><?= __("enable_to_allow")?></small> <?= __isNew('1.0.1')?></p>

            </div>
        </div>
        <div class="custom-control custom-switch prefrence-item ml-10">
            <div class="gap">
                <input type="checkbox" id="is_language_list" name="set-name" class="switch-input setting_option" data-type="is_language_list" data-value="<?= !empty(__config('is_language_list'))?__config('is_language_list'):0;?>" <?= __config('is_language_list')==1?"checked":"";?>>
                <label for="is_language_list" class="switch-label"> <span class="toggle--on"> <i class="fa fa-check c_green"></i> <?= __('activated'); ?></span><span class="toggle--off"><i class="fa fa-ban c_red"></i> <?= __('inactive'); ?></span> </label>

            </div>
            <div class="preText">
                <label class="custom-label"><?= __("is_language_list")?></label>
                <p class="text-muted"><small><?= __("enable_to_allow")?></small> <?= __isNew('1.0.1')?></p>

            </div>
        </div>
    </div>
</div>