@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4><?= lang('whatsapp_config') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-20">
                                <div class="custom-control custom-switch prefrence-item ml-10">
                                    <div class="gap">
                                        <input type="checkbox" id="is_whatsapp_order" name="is_whatsapp_order"
                                            name="set-name" class="switch-input setting_option" value="1">
                                        <label for="is_whatsapp_order" class="switch-label">
                                            <span class="toggle--on"> <i class="fa fa-check c_green"></i>
                                                <?= __('activated') ?></span>
                                            <span class="toggle--off"><i class="fa fa-ban c_red"></i>
                                                <?= __('inactive') ?></span>
                                        </label>
                                    </div>
                                    <div class="preText">
                                        <label class="custom-label"><?= __('whatsapp_order') ?></label>
                                        <p class="text-muted">
                                            <small><?= __('enable_to_allow') ?></small>
                                            <span class="ab-position custom_badge danger-light-active">{{ __('new') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label><?= !empty(lang('whatsapp_number')) ? lang('whatsapp_number') : 'Whatsapp Number' ?>
                                    <span class="error">*</label>
                                <div class="ci-input-group input-group-append">
                                    <div class="input-group">
                                        <span class="d-flex">
                                            <span class="fi fi-us"></span>
                                            <span class="ml-5 phone_with_input">
                                                <input type="text" name="dial_code" class="form-control" value="+88">
                                            </span>
                                        </span>
                                    </div>
                                    <input type="text" name="whatsapp_number" class="form-control" value=""
                                        <?= __required(true) ?>>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label><?= !empty(lang('message')) ? lang('message') : 'message' ?> <span
                                        class="error">*</label>
                                <div class="mb-5">
                                    <code>{CUSTOMER_NAME}, {ORDER_ID}, {ITEM_LIST}, {SHOP_NAME}, {SHOP_ADDRESS},
                                        {TRACK_URL}</code>
                                </div>
                                <textarea name="msg" class="form-control" cols="5" rows="15" required>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, totam.
                                </textarea>
                            </div>

                            <div class="form-group col-md-12 mb-0">
                                <label><?= lang('enable_for') ?></label>
                                <div class="orderTypes flex-wrap d-flex gap-15 mt-10">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="whatsapp_for[cod]" value="1" checked> Cash
                                        on delivery
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="whatsapp_for[pickup]" value="1" checked> Pickup /
                                        takeaway
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="whatsapp_for[dinein]" value="1" checked> Dine-in
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="whatsapp_for[paycash]" value="1" checked> Pay cash
                                    </label>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- card-body -->
                    <div class="card-footer text-right">
                        <input type="hidden" name="id" value="0">
                        <?= __submitBtn() ?>
                    </div>
                </div><!-- card -->
            </form>
        </div><!-- col-9 -->
    </div>
@endsection
