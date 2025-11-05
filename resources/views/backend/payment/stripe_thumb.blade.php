<div class="card stripe">
    <div class="card-header mt-1">
        <div class="card-title">
            <h4><?= __('Stripe') ?></h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group  col-md-6 col-sm-6 col-xs-12">
                <label for=""><?= !empty(lang('status')) ? lang('status') : 'Status' ?></label>
                <div class="">
                    <div class="toggle btn btn-primary" data-toggle="toggle" style="width: 289.6px; height: 37.6px;">
                        <input type="checkbox" name="is_stripe" class="" value="1" checked=""
                            data-toggle="toggle" data-on="&lt;i class='fa fa-check'&gt;&lt;/i&gt; Enabled"
                            data-off="&lt;i class='fa fa-pause'&gt;&lt;/i&gt; Disabled">
                        <div class="toggle-group"><label class="btn btn-primary toggle-on"><i class="fa fa-check"></i>
                                Enabled</label><label class="btn btn-default active toggle-off"><i
                                    class="fa fa-pause"></i> Disabled</label><span
                                class="toggle-handle btn btn-default"></span></div>
                    </div>

                </div>
            </div>
        </div><!-- row -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class=""><?= !empty(lang('public_key')) ? lang('public_key') : ' Public key' ?></label>
                    <div class="">
                        <input type="text" name="stripe_public_key"
                            placeholder="<?= !empty(lang('public_key')) ? lang('public_key') : 'Stripe Public key' ?>"
                            class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class=""><?= !empty(lang('secret_key')) ? lang('secret_key') : ' Secret key' ?></label>
                    <div class="">
                        <input type="text" name="stripe_secret_key"
                            placeholder="<?= !empty(lang('secret_key')) ? lang('secret_key') : 'Stripe Secret key' ?>"
                            class="form-control" value="">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- card-body -->
</div><!-- card -->
