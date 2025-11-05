@extends('backend.vendor.layouts.app')
@section('content')
    <!-- /.dash-menu -->
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-8 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2rm">
                                        <label><?= lang('language') ?></label>
                                        <div class="mt-10 flex gap-20 flex-wrap">
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="en" checked> English</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="ar"> عربي</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="bn"> Bangla</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="es"> Español</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-0">
                                        <label><?= lang('country') ?></label>
                                        <select name="country_id" id="country_id" class="form-control singeSelect">
                                            <option value="" data-src=""><?= lang('select') ?></option>
                                            <option data-src="" value="1" data-currency="AFN" data-dial="93"
                                                data-icon="؋" data-zone="Asia/Kabul" data-code="AF"> Afghanistan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><?= lang('currency') ?></label>
                                        <select name="currency_id" id="currency" class="form-control select2">
                                            <option value=""><?= lang('select') ?></option>
                                            <option value="3"> ALL (Lek)</option>
                                        </select>
                                        <!-- /# -->
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?= lang('dial_code') ?></label>
                                        <div class="ci-input-group input-group-append">
                                            <div class="input-group">
                                                <span>
                                                    <span class="fi fi-bd countryIcon"></span>
                                                </span>
                                            </div>
                                            <input type="text" name="dial_code" class="form-control only_number"
                                                value="+88">
                                        </div>
                                        <!-- /# -->
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?= lang('timezone') ?></label>
                                        <select name="timezone" id="timezone" class="form-control select2">
                                            <option value="">select</option>
                                            <option value="Africa/Abidjan">Africa/Abidjan</option>
                                        </select>
                                        <!-- /# -->
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><?= lang('currency_position') ?></label>
                                        <select name="currency_position" id="currency_position"
                                            class="form-control niceSelect">
                                            <option value="left" selected>$ 100 </option>
                                            <option value="right">100 $ </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><?= lang('number_format') ?></label>
                                        <select name="number_format" id="number_format" class="form-control niceSelect">
                                            <option value="0">100</option>
                                            <option value="1" selected>100.00</option>
                                            <option value="2">1.00,00 </option>
                                            <option value="3">1,00.00 </option>
                                        </select>
                                    </div>
                                </div><!-- row -->

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label"><?= lang('date_format') ?></label>

                                        <select name="date_format" class="form-control">
                                            <option value="1" >
                                                d-m-Y</option>
                                            <option value="2" >
                                                Y-m-d</option>
                                            <option value="3">
                                                d/m/Y</option>
                                            <option value="4">
                                                Y/m/d</option>
                                            <option value="5">
                                                d.m.Y</option>
                                            <option value="6">
                                                Y.m.d</option>
                                            <option value="7">
                                                d M, Y</option>
                                            <option value="7" >
                                                d M, Y</option>
                                            <option value="8">
                                                d M Y</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="control-label"><?= lang('time_format') ?></label>

                                        <select name="time_format" class="form-control">
                                            <option value="1" selected>
                                                12 <?= lang('format') ?></option>
                                            <option value="2">
                                                24 <?= lang('format') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-right">
                                <?= __submitBtn() ?>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

    {{-- <script>
    $(document).ready(function() {
        $(document).on('change', '#country_id', function() {
            country(this);
        })

        function country(wrapper) {
            let select = $(wrapper).find(':selected');
            let currency = select.data('currency');
            let dial_code = select.data('dial');
            let icon = select.data('icon');
            let timezone = select.data('zone');
            let code = select.data('code');

            $('[name="currency"]').val(currency).change();
            $('[name="timezone"]').val(timezone).change();
            $('[name="dial_code"]').val(dial_code);
            if (code != undefined) {
                $('.countryIcon').removeClass(function(index, className) {
                    return (className.match(/\bfi-\S+/g) || []).join(' ');
                }).addClass('fi-' + code.toLowerCase());
            }

            console.log(code, currency, dial_code, timezone);
            var selectedOption = wrapper.options[wrapper.selectedIndex];
            var flagUrl = selectedOption.dataset.src;
            wrapper.style.backgroundImage = "url('" + flagUrl + "')";
        }
    });

    $(function() {
        setTimeout(() => {
            var ddial_code = `<?= __vsettings('dial_code') ?>`;
            var dcurrency = `<?= __vsettings('currency') ?>`;
            var dtimezone = `<?= __vsettings('timezone') ?>`;
            if (dcurrency != '') {
                $('[name="currency"]').val(dcurrency).change();
            }

            if (ddial_code != '') {
                $('[name="dial_code"]').val(ddial_code).change();
            }

            if (dtimezone != '') {
                $('[name="timezone"]').val(dtimezone).change();
            }
        }, 100);

    });
</script> --}}
@endsection
