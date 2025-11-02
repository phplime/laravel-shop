<div id="mainContent">
    <div class="row">
        <?php $this->load->view('backend/settings/inc/settings_menu.php', ['col' => 'col-lg-12']); ?>
        <div class="<?= __settings('menu_style') == 1 ? "col-lg-8" : "col-lg-5 "; ?> col-xs-12">

            <?= __startForm(base_url('admin/settings/email_configuration'), 'post'); ?>
            <?= csrf(); ?>
            <?php $smtp = !empty(__settings('smtp_config')) && isJson(__settings('smtp_config')) ? json_decode(__settings('smtp_config')) : ''; ?>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang("general_settings"); ?></h5>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class=""><?= __('mail_type'); ?></label>
                                    <div class="">
                                        <select name="mail_type" class="form-control email_option">
                                            <option value="smtp" <?= __settings('mail_type') == 1 ? 'selected' : '' ?>>
                                                <?= lang('smtp'); ?></option>
                                            <option value="sendgrid" <?= __settings('mail_type') == 2 ? 'selected' : '' ?>>
                                                <?= lang('sendgrid'); ?></option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        class=""><?= lang('email'); ?> / <?= __('username') ?></label>
                                    <div class="">
                                        <input type="text" name="smtp_mail"
                                            placeholder="<?= !empty(lang('email_or_username')) ? lang('email_or_username') : "Email / username"; ?>"
                                            class="form-control"
                                            value="<?= __settings('smtp_mail');  ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label><?= !empty(lang('send_mail_from')) ? lang('send_mail_from') : "Send Emails From (Email)"; ?></label>
                                <div class="">
                                    <input type="text" name="no_reply" placeholder="do-not-reply@xxx.com"
                                        class="form-control"
                                        value="<?= isset($smtp->no_reply) && !empty($smtp->no_reply) ? _x($smtp->no_reply) : '';  ?>"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>


                        <div class="smtp emailTypes" style="display: <?= __settings('mail_type') == 'smtp' || __settings('mail_type') == '' ? '' : 'd-none' ?>;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-primary">
                                        <h4><i class="fa fa-envelope-o"></i> Gmail Smtp</h4>

                                        <p>Gmail Host:&nbsp;&nbsp;smtp.gmail.com <br>
                                            Gmail Port:&nbsp;&nbsp;465</p>

                                        <ol>
                                            <li>Login to your gmail</li>
                                            <li>Go to Security setting and Enable 2 factor authentication</li>
                                            <li>After enabling this you can see app passwords option</li>
                                            <li>And then, from Your app passwords tab select Other option and put your
                                                app name and click GENERATE button to get new app password. </li>
                                            <li>Finally copy the 16 digit of password and click done. Now use this
                                                password instead of email password to send mail via your app.</li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class=""><?= lang('smtp_host'); ?></label>
                                    <div class="">
                                        <input type="text" name="smtp_host" placeholder="<?= lang('smtp_host'); ?>"
                                            class="form-control"
                                            value="<?= isset($smtp->smtp_host) && !empty($smtp->smtp_host) ? html_escape($smtp->smtp_host) : '';  ?>">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label class=""><?= lang('smtp_port'); ?></label>
                                    <div class="">
                                        <input type="text" name="smtp_port" placeholder="<?= lang('smtp_port'); ?>"
                                            class="form-control"
                                            value="<?= isset($smtp->smtp_port) && !empty($smtp->smtp_port) ? html_escape($smtp->smtp_port) : '';  ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label><?= lang('smtp_password'); ?></label>
                                    <div class="">
                                        <input type="password" name="smtp_password"
                                            placeholder="<?= lang('smtp_password'); ?>" class="form-control"
                                            value="<?= isset($smtp->smtp_password) && !empty($smtp->smtp_password) ? $smtp->smtp_password : '';  ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="emailTypes sendgrid <?= __settings('mail_type') == 'sendgrid' ? '' : 'd-none' ?>">
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <div class="form-group col-md-12">
                                        <label><?= lang('sendgrid_api_key'); ?></label>
                                        <input type="text" name="sendgrid_api_key" class="form-control"
                                            value="<?= isset($smtp->sendgrid_api_key) ? $smtp->sendgrid_api_key : ""; ?>"
                                            placeholder="<?= lang('sendgrid_api_key'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12 mt-20">

                                    <div class="">
                                        <a href="<?= base_url('admin/settings/test_mail'); ?>" target="_blank"
                                            class="btn btn-danger"><i class="fas fa-wrench"></i> <?= lang('test_mail'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- card-content -->
                </div><!-- card-body -->
                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>
            </div>
            </form>
        </div><!-- col -->

        <div class="<?= __settings('menu_style') == 1 ? "col-lg-4" : "col-lg-4"; ?>">
            <?php if (__settings('is_smtp') == 1 || __settings('is_sendgrid') == 1): ?>
                <form action="<?= base_url("admin/settings/add_email_template") ?>" onsubmit="formSubmit(event,this)" method="post">
                    <?= csrf(); ?>
                    <?php $emailType = mail_type(); ?>
                    <?php $getMsg = !empty(__settings('email_template_config')) && isJson(__settings('email_template_config')) ? json_decode(__settings('email_template_config'), true) : ''; ?>

                    <?php $lang = __site_language(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label> <?= lang('email_template') ?></label>
                                <select name="type" id="type" class="form-control">
                                    <option value=""><?= lang('select'); ?></option>
                                    <?php foreach ($emailType as $key => $value): ?>
                                        <option value="<?= $key; ?>"><?= !empty(lang($key)) ? lang($key) : $key; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php foreach ($emailType as $keys => $values): ?>
                                <div class="emailTemplate_content emailTemp <?= $keys; ?> dis_none">
                                    <div class="form-group">
                                        <label for=""><?= lang('subject'); ?></label>
                                        <input type="text" name="subject[<?= $keys; ?>][<?= __site_language() ?>]" class="form-control"
                                            value="<?= isset($getMsg[$keys]['subject'][$lang]) ? $getMsg[$keys]['subject'][$lang] : (isset($getMsg[$keys]['subject']['en']) ? $getMsg[$keys]['subject']['en'] : ''); ?>">
                                    </div>
                                    <div class="form-group ">
                                        <div class="codeContent">
                                            <code>
                                                <?php foreach ($values as $content): ?>
                                                    <span>{<?= $content; ?>}</span>,
                                                <?php endforeach; ?>
                                            </code>
                                        </div>
                                        <label for=""><?= $keys; ?></label>
                                        <textarea name="message[<?= $keys; ?>][<?= $lang; ?>]" id="email_content_<?= $keys; ?>" class="form-control data_textarea"
                                            cols="30"
                                            rows="10"><?= isset($getMsg[$keys]['message'][$lang]) ? $getMsg[$keys]['message'][$lang] : (isset($getMsg[$keys]['message']['en']) ? $getMsg[$keys]['message']['en'] : ''); ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer text-right">
                            <input type="hidden" name="language" value="<?= $lang; ?>">
                            <input type="hidden" name="id"
                                value="<?= isset($settings['id']) ? html_escape($settings['id']) : 0; ?>">
                            <button class="btn btn-secondary"><?= lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <div class="empty_msg d-flex justify-content-center align-items-center flex-column">
                    <i class="icofont-warning"></i> <br>
                    <strong><?= lang('configure_mail_to_get_email_template'); ?></strong>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.email_verification_mail').slideDown();
            $('[name="type"]').val('email_verification_mail').prop('checked', true);
        });
        $(document).on('change', '[name="type"]', function() {
            let val = $(this).val();
            $('.emailTemp').slideUp();
            $('.' + val).slideDown();
        });

        $(document).on('change', '[name="mail_type"]', function() {
            let val = $(this).val();
            $('.emailTypes').slideUp();
            $('.' + val).slideDown();
        });
    </script>
</div>