   <div class="row">
       <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-12']); ?>
       <div class="<?= __settings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-7 "; ?>">
           <form action="<?= base_url("vendor/settings/email_configuration") ?>" method="post" class="formSubmit" onsubmit="formSubmit(event,this);">
               <?= csrf(); ?>
               <?php $smtp = isJson(__vsettings('smtp_config')) ? json_decode(__vsettings('smtp_config')) : ''; ?>
               <div class="card">
                   <div class="card-header">
                       <h5 class="card-title"><?= __('email_settings'); ?></h5>
                   </div>
                   <div class="card-body">
                       <div class="row">
                           <div class="form-group col-md-12">
                               <label class=""><?= __('type'); ?><?= __required(); ?></label>
                               <select name="mail_type" class="form-control email_option">
                                   <option value="smtp" <?= __checked(__vsettings('mail_type'), 'smtp', 'selected') ?>> <?= __('smtp'); ?></option>
                                   <option value="sendgrid" <?= __checked(__vsettings('mail_type'), 'sendgrid', 'selected') ?>> <?= __('sendgrid'); ?></option>

                               </select>
                           </div>
                           <div class="form-group col-md-12">
                               <label class=""><?= lang('email'); ?> / <?= __('username') ?> <?= __required(); ?></label>
                               <div class="">
                                   <input type="text" name="smtp_mail" placeholder="<?= !empty(lang('email_or_username')) ? lang('email_or_username') : "Email / username"; ?>" class="form-control" value="<?= __vsettings('smtp_mail');  ?>">
                               </div>
                           </div>


                           <div class="form-group col-md-12">
                               <label><?= !empty(lang('send_mail_from')) ? lang('send_mail_from') : "Send Emails From (Email)"; ?></label>
                               <div class="">
                                   <input type="text" name="no_reply" placeholder="do-not-reply@xxx.com" class="form-control" value="<?= !empty($smtp->no_reply) ? ($smtp->no_reply) : '';  ?>" autocomplete="off">
                               </div>
                           </div>
                       </div><!-- row -->

                       <div class="mailType smtpArea  <?= __vsettings('mail_type') == 'smtp' || empty(__vsettings('mail_type')) ? '' : 'hidden' ?>">
                           <div class="row">
                               <div class="form-group col-md-12">
                                   <div class="callout-primary">
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
                                   <label class=""><?= lang('smtp_host'); ?> <?= __required(); ?></label>
                                   <div class="">
                                       <input type="text" name="smtp_host" placeholder="<?= lang('smtp_host'); ?>" class="form-control" value="<?= !empty($smtp->smtp_host) ? html_escape($smtp->smtp_host) : '';  ?>">
                                   </div>
                               </div>

                               <div class="form-group col-md-6">
                                   <label class=""><?= lang('smtp_port'); ?> <?= __required(); ?></label>
                                   <div class="">
                                       <input type="text" name="smtp_port" placeholder="<?= lang('smtp_port'); ?>" class="form-control" value="<?= !empty($smtp->smtp_port) ? html_escape($smtp->smtp_port) : '';  ?>" autocomplete="off">
                                   </div>
                               </div>
                               <div class="form-group col-md-12">
                                   <label><?= lang('password'); ?> <?= __required(); ?></label>
                                   <div class="">
                                       <input type="password" name="smtp_password" placeholder="<?= lang('password'); ?>" class="form-control" value="<?= !empty($smtp->smtp_password) ? $smtp->smtp_password : '';  ?>" autocomplete="off">
                                   </div>
                               </div>
                           </div>
                       </div><!-- smtpArea -->
                       <div class="mailType sendgridArea <?= __vsettings('mail_type') == 'sendgrid' ? '' : 'hidden' ?>">
                           <div class="row">

                               <div class="form-group col-md-12">
                                   <label><?= lang('sendgrid_api_key'); ?> <?= __required(); ?></label>
                                   <input type="text" name="sendgrid_api_key" class="form-control" value="<?= !empty($smtp->sendgrid_api_key) ? ($smtp->sendgrid_api_key) : '';  ?>" placeholder="<?= lang('sendgrid_api_key'); ?>">
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12  mt-20">
                               <div class="form-group">
                                   <div class="">
                                       <a href="<?= base_url('vendor/settings/test_mail'); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-wrench"></i> <?= lang('test_mail'); ?></a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div><!-- card-body -->
                   <div class="card-footer text-right">
                       <?= submitBtn(); ?>
                   </div>
               </div>
           </form>
       </div>
   </div>

   <script>
       $(document).ready(function() {
           $('.email_verification_mail').slideDown();
           $('[name="type"]').val('email_verification_mail').prop('checked', true);
       });
       $(document).on('change', '[name="mail_type"]', function() {
           let val = $(this).val();
           $('.mailType').slideUp();
           $(`.${val}Area`).slideDown();
       });
   </script>