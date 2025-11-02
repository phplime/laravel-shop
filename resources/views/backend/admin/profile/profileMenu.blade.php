 <div class="col-md-3 col-xs-12">
     <div class="profileMenu">
         <ul>
             <?php if (_sauth('role') == 'user'): ?>
                 <a href="<?= base_url("vendor/profile") ?>" class="<?= isset($page_title) && $page_title == "Profile" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('profile'); ?></a>
             <?php endif; ?>

             <a href="<?= _sauth('role') == 'user' ? base_url("vendor/profile/account") : base_url("admin/profile"); ?>" class="<?= isset($page_title) && $page_title == "Account" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('account'); ?></a>

             <a href="<?= _sauth('role') == 'user' ? base_url("vendor/profile/password") : base_url("admin/profile/password") ?>" class="<?= isset($page_title) && $page_title == "Password" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('password'); ?></a>

         </ul>
     </div>
 </div>