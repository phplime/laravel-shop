<div class="vendorContent">
    <div class="profileLeftMenu">
        <?php include "profileMenu.php"; ?>
    </div>
    <div class="profilerightMenu">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <?= __startForm(base_url("login/update_account_info"), "post"); ?>
                        <?= csrf(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('account_information'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= __('name'); ?> <?= __required(); ?></label>
                                            <input type="text" name="name" class="form-control" value="<?= _x($u_info->name) ?: _x($u_info->username); ?>" <?= __required(true); ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= __('email'); ?> <?= __required(); ?></label>
                                            <input type="text" name="email" class="form-control" value="<?= _x($u_info->email) ?? ""; ?>" <?= __required(true); ?>>
                                        </div>
                                    </div>

                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group  mb-0">
                                            <label><?= lang("country"); ?> <?= __required(); ?></label>
                                            <?php country_list($u_info->country_id); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label><?= __('phone'); ?></label>
                                        <div class="ci-input-group input-group-append">
                                            <div class="input-group">
                                                <span> + </span> <input type="text" name="dial_code" class="form-control max-w-60" value="<?= $u_info->dial_code ?? "xxx"; ?>">
                                            </div>
                                            <input type="text" name="phone" class="form-control phone" value="<?= $u_info->phone ?? ""; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <?= __submitBtn() ?>
                            </div>
                        </div>
                        <?php __endForm(); ?>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('account_security'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="header">
                                    <h4>
                                        <?php if ($u_info->is_twofa_enabled == 1): ?>
                                            <i class="fas fa-check-circle text-success"></i>
                                        <?php else: ?>
                                            <i class="icofont-close-line-circled text-danger"></i>
                                        <?php endif; ?>

                                        <?= __('twofactor_authentication'); ?>
                                    </h4>
                                </div>

                                <div class="mt-2rm bb-solid-1 soft-border-color">
                                    <ul>
                                        <li class="flex bb-dashed-1 py-1rm soft-border-color">
                                            <b class="wd-10rm"><?= __('otp_preference'); ?></b> <span class="flex-1"><?= _x($u_info->otp_preference ?? __('email'))  ?></span> <a href="javascript:;" class="sidebar" onclick='sidebar(`otpSidebar`)'><?= __('edit'); ?></a>
                                        </li>

                                        <li class="flex py-1rm ">
                                            <b class="wd-10rm"><?= __('email'); ?></b> <span class="flex-1"><?= _x($u_info->email) ?? '' ?></span> </a>
                                        </li>

                                        <?php if (!empty($u_info->phone)): ?>
                                            <li class="flex py-1rm ">
                                                <b class="wd-10rm"><?= __('phone'); ?></b> <span class="flex-1"><?= !empty($u_info->dial_code) ? "+" . $u_info->dial_code : ""; ?> <?= _x($u_info->phone ?? '')  ?></span> </a>
                                            </li>
                                        <?php endif; ?>


                                        <li class="flex  justify-conten-end pb-1rm">
                                            <?php if ($u_info->is_twofa_enabled == 1): ?>
                                                <a href="<?= base_url("login/twofa_status/0"); ?>" class="action_btn" data-msg="<?= __("turn_off_towfactor_auth"); ?>"><?= __('turn_off_towfactor_auth'); ?></a>
                                            <?php else: ?>
                                                <a href="<?= base_url("login/twofa_status/1"); ?>" class="action_btn" data-msg="<?= __("turn_on_towfactor_auth"); ?>"><?= __('turn_on_towfactor_auth'); ?></a>
                                            <?php endif; ?>
                                        </li>


                                    </ul>
                                </div>

                                <?php if (sizeof($login_device_list) > 0): ?>

                                    <div class="pt-1rm">
                                        <div class="header">
                                            <h4><?= __('your_session'); ?></h4>
                                            <p><?= __('twofa_session_message'); ?></p>
                                        </div>
                                        <div class="sessionContent mt-2rm">
                                            <?php foreach ($login_device_list as  $key => $device): ?>
                                                <div class="singleDevice d-flex align-center gap-2rm">
                                                    <div class="max-w-80">
                                                        <?php if (in_array($device->device, ['Android', 'iOS', 'Mobile'])): ?>
                                                            <i class="icofont-ui-touch-phone fz-2rm"></i>
                                                        <?php else: ?>
                                                            <i class="icofont-laptop fz-2rm"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="deviceInfo">
                                                        <h4><?= $device->platform ?? ""; ?></h4>
                                                        <?php if ($key == 0): ?>
                                                            <small><i class="fas fa-check-circle"></i> <?= __('current_session'); ?></small>
                                                        <?php endif; ?>
                                                        <p><?= $device->address ?? ""; ?></p>
                                                        <?= __('last_login'); ?> : <?= full_time($device->created_at); ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- col-md-8 -->
        </div>
    </div>
</div>

<?= __header(__('otp_preference'), base_url(''), 'otps'); ?><?= __footer(); ?>

<?= __header(__('otp_preference'), base_url('login/change_otp_preference'), 'otp'); ?>
<div class="form-group">
    <label class="custom-radio"><input type="radio" name="otp_preference" value="email" <?= $u_info->otp_preference == "email" ? "checked" : ""; ?>><?= __('email'); ?></label>
</div>

<?= __footer(); ?>