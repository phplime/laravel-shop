<div class="vendorContent">
    <div class="profileLeftMenu">
        <?php include "profileMenu.php"; ?>
    </div>
    <div class="profilerightMenu">
        <div class="col-xs-12 col-lg-8">
            <?= __startForm(base_url("login/change_password")); ?>
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?= __('change_password'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><?= __('current_password'); ?></label>
                        <input type="password" name="current_password" class="form-control" placeholder="<?= __('current_password'); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= __('new_password'); ?></label>
                        <input type="password" name="new_password" class="form-control" placeholder="<?= __('new_password'); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= __('confirm_password'); ?></label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="<?= __('confirm_password'); ?>">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>
            </div>
            <?= __endForm(); ?>
        </div>
    </div>
</div>