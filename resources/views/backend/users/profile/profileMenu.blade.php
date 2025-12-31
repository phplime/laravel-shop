 <div class="col-md-3 col-xs-12">
     <div class="profileMenu">
         <ul>
             <?php if (Auth::user()->user_role == 'user'): ?>
                 <a href="<?= url("vendor/profile") ?>" class="<?= isset($page_title) && $page_title == "Profile" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('profile'); ?></a>
             <?php endif; ?>

             <a href="<?= Auth::user()->user_role == 'user' ? url("vendor/profile/account") : url("admin/profile"); ?>" class="<?= isset($page_title) && $page_title == "Account" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('account'); ?></a>

             <a href="<?= Auth::user()->user_role == 'user' ? url("vendor/profile/password") : url("admin/profile/password") ?>" class="<?= isset($page_title) && $page_title == "Password" ? "active" : ""; ?>"><i class="icofont-bubble-right"></i> <?= __('password'); ?></a>

         </ul>
     </div>
 </div>
