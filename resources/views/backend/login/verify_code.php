<div class="h90dvh d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="twofaverify">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="<?= base_url('login/doverify') ?>" method="post" onsubmit="formSubmit(event,this)">
                        <?= csrf(); ?>
                        <div class="card">
                            <div class="card-header space-between gap-10 align-center">
                                <a href=""><i class="fa fa-arrow-left"></i></a>
                                <h4 class="card-title">
                                    <?= __('back'); ?>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label"><?= __('verification_code'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control verifyCode" placeholder="xxxxx">
                                </div>
                                <?php if (isset($is_resend) && $is_resend == 1): ?>
                                    <div class="resendArea text-right">
                                        <a href="<?= base_url('login/doverify'); ?>"><i class="icofont-ui-reply"></i> <?= __('resend'); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block"> <?= __('verify'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>