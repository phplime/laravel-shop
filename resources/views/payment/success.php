<?php $get = $this->input->get(); ?>
<div class="row justify-content-center">
    <div class="col-md-3">
        <div class="successPage d-flex align-items-center justify-content-center flex-column gap-20">
            <div class="card p-1rm max-w-360">
                <div class="success-card d-flex flex-column gap-20 space-between">
                    <div class="successDetails text-center">
                        <img class="avatar-medium" src="<?= base_url("app/assets/images/success.gif"); ?>" alt="img-thumbnail">
                        <div class="mt-10">
                            <h4 class="mb-5"><?= lang('payment_success'); ?></h4>

                            <?php if (isset($get['txn_id'])): ?>
                                <p><?= lang('txn_id'); ?> : <b><?= _x($get['txn_id']); ?></b></p>
                            <?php endif; ?>

                            <?php if (isset($get['method'])): ?>
                                <p><?= lang('payment_method'); ?> : <b> <?= __($get['method']); ?></b></p>
                            <?php endif; ?>

                            <?php if (isset($get['amount'])): ?>
                                <p><?= lang('amount'); ?> : <b><?= admin_currency_position($get['amount']); ?></b> </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?= base_url("vendor/dashboard/subscriptions") ?>" class="btn btn-success btn-block"><i class="fa fa-check"></i> <?= __('ok'); ?></a>

                </div>
            </div>
        </div>
    </div>
</div>