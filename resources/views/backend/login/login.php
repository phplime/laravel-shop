<?php $settings = settings(); ?>
<div class="loginArea">
    <div class="loginWrapper" style="background-image: url('<?= base_url('app/assets/images/login_banner.jpg') ?>')">
        <div class="container">
            <div class=" row justify-content-center">
                <div class="col-md-6">
                    <form method="POST" action="<?= base_url('auth-login/'); ?>" onsubmit="formSubmit(event,this)">
                        <?= csrf(); ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="login_form">
                                    <div class="form-group">
                                        <label>
                                            <?= !empty(lang('username')) ? lang('username') : "username"; ?>/
                                            <?= !empty(lang('email')) ? lang('email') : "email"; ?>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon fa_icon"><i class="fa fa-user-secret"></i></span>
                                            <input type="text" name="email" class="form-control usermail"
                                                placeholder="<?= !empty(lang('username')) ? lang('username') : "username"; ?> / <?= !empty(lang('email')) ? lang('email') : "email"; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <?= !empty(lang('password')) ? lang('password') : "password"; ?>
                                            <?php if ((isset($type) && $type == 'customer') || !isset($type)): ?> <a
                                                    href="<?= base_url('login/forgot'); ?>"
                                                    class="ml-7"><?= !empty(lang('forgot')) ? lang('forgot') : "Forgot?"; ?></a>
                                            <?php endif ?>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon fa_icon"><i class="fa fa-key"></i></span>
                                            <input type="password" name="password" class="form-control pass" placeholder="<?= !empty(lang('password')) ? lang('password') : "password"; ?>">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info _signIn_btn"><i class="fa fa-sign-in"></i>
                                            &nbsp; <?= !empty(lang('sign_in')) ? lang('sign_in') : "Sign In"; ?></button>
                                    </div>

                                    <div class="form-group">
                                        <p><?= !empty(lang('dont_have_account')) ? lang('dont_have_account') : "Don't have account"; ?>
                                            <a href="<?= base_url('sign-up'); ?>"><?= !empty(lang('sign-up')) ? lang('sign-up') : "Sign Up"; ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- col-6 -->
            </div><!-- row   -->
        </div>
    </div>
</div>