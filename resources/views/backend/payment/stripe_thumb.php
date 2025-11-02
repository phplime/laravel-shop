<?php $config = isset($payment_config->config) && isJson($payment_config->config) ? json_decode($payment_config->config) : ''; ?>
<div class="card stripe">
    <div class="card-header mt-1">
        <div class="card-title">
            <h4><?= __($row->slug); ?></h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <label for=""><?= !empty(lang('status')) ? lang('status') : "Status"; ?></label>
                <div class="">
                    <input type="checkbox" name="is_stripe" class="" value="1" <?= isset($config->is_stripe) && $config->is_stripe == 1 ? 'checked' : ''; ?> data-toggle="toggle" data-on="<i class='fa fa-check'></i> <?= lang('enabled'); ?>" data-off="<i class='fa fa-pause'></i> <?= lang('disabled'); ?>">

                </div>
            </div>
        </div><!-- row -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class=""><?= !empty(lang('public_key')) ? lang('public_key') : " Public key"; ?></label>
                    <div class="">
                        <input type="text" name="stripe_public_key" placeholder="<?= !empty(lang('public_key')) ? lang('public_key') : "Stripe Public key"; ?>" class="form-control" value="<?= !empty($config->stripe_public_key) ? html_escape($config->stripe_public_key) : '';  ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class=""><?= !empty(lang('secret_key')) ? lang('secret_key') : " Secret key"; ?></label>
                    <div class="">
                        <input type="text" name="stripe_secret_key" placeholder="<?= !empty(lang('secret_key')) ? lang('secret_key') : "Stripe Secret key"; ?>" class="form-control" value="<?= !empty($config->stripe_secret_key) ? html_escape($config->stripe_secret_key) : '';  ?>">
                    </div>
                </div>
            </div>
        </div>

    </div><!-- card-body -->
</div><!-- card -->