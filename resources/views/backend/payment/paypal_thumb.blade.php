<div class="card paypal">
    <div class="card-header">
        <h4 class="card-title"><?= __('Paypal') ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group  col-md-6 col-sm-6 col-xs-6">
                <label for=""><?= !empty(lang('status')) ? lang('status') : 'Status' ?></label>
                <div class="">
                    <input type="checkbox" name="is_paypal" class="" value="1" checked data-toggle="toggle"
                        data-on="<i class='fa fa-check'></i> <?= lang('enabled') ?>"
                        data-off="<i class='fa fa-pause'></i> <?= lang('disabled') ?>">
                </div>
            </div>

            <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                <label for=""><?= !empty(lang('environment')) ? lang('environment') : 'Environment' ?></label>
                <div class="">
                    <select name="paypal_environment" class="form-control">
                        <option value="sandbox" checked> <?= lang('sandbox') ?></option>
                        <option value="production"> <?= lang('production') ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label
                        class=""><?= !empty(lang('paypal_email')) ? lang('paypal_email') : 'Paypal Email' ?></label>
                    <div class="">
                        <input type="text" name="paypal_email"
                            placeholder="<?= !empty(lang('paypal_business_email')) ? lang('paypal_business_email') : 'Paypal Business Email' ?>"
                            class="form-control" value="">
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- card-body -->
</div><!-- card -->
