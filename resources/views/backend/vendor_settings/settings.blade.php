@extends('backend.vendor.layouts.app')
@section('content')
    <!-- /.dash-menu -->
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-8 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('vendor/settings/add_settings') }}" method="post" class="ajaxSubmit">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2rm">
                                        <label><?= lang('language') ?></label>
                                        <div class="mt-10 flex gap-20 flex-wrap">
                                            <?php $vlang = __vsettings('language', 'en'); ?>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="en" <?= $vlang == 'en' ? 'checked' : '' ?>> English</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="ar" <?= $vlang == 'ar' ? 'checked' : '' ?>> عربي</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="bn" <?= $vlang == 'bn' ? 'checked' : '' ?>> Bangla</label>
                                            <label class="custom-radio"> <input type="radio" name="language"
                                                    value="es" <?= $vlang == 'es' ? 'checked' : '' ?>> Español</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-0">
                                        <label><?= lang('country') ?></label>
                                        <select name="country_id" id="country_id" class="form-control singeSelect">
                                            <option value="" data-src=""><?= lang('select') ?></option>
                                            <?php $vcountry_id = __vsettings('country_id'); ?>
                                            @foreach (country_list() as $country)
                                                <?php $timezone = json_decode($country->timezones); ?>
                                                <option data-src="<?= asset('app/assets/flags/4x3/' . strtolower($country->iso2) . '.svg') ?>" 
                                                    value="{{ $country->id }}" 
                                                    data-currency="{{ $country->currency_code }}" 
                                                    data-dial="{{ $country->dial_code }}"
                                                    data-icon="{{ $country->currency_symbol }}" 
                                                    data-zone="{{ $timezone[0]->zoneName ?? '' }}" 
                                                    data-code="{{ $country->iso2 }}"
                                                    <?= $vcountry_id == $country->id ? 'selected' : '' ?>> 
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><?= lang('currency') ?></label>
                                        <select name="currency_id" id="currency" class="form-control select2">
                                            <option value=""><?= lang('select') ?></option>
                                            <?php $vcurrency_id = __vsettings('currency_id'); ?>
                                            @foreach (country_list() as $country)
                                                <option value="{{ $country->id }}" <?= $vcurrency_id == $country->id ? 'selected' : '' ?>> 
                                                    {{ $country->currency_code }} ({{ $country->currency_symbol }})
                                                </option>
                                            @endforeach
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
                                                value="<?= __vsettings('dial_code') ?>">
                                        </div>
                                        <!-- /# -->
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?= lang('timezone') ?></label>
                                        <select name="timezone" id="timezone" class="form-control select2">
                                            <option value="">select</option>
                                            <?php 
                                                $vtimezone = __vsettings('timezone');
                                                $timezones = [];
                                                foreach(country_list() as $c) {
                                                    $tzs = json_decode($c->timezones);
                                                    if($tzs) {
                                                        foreach($tzs as $t) {
                                                            $timezones[$t->zoneName] = $t->zoneName;
                                                        }
                                                    }
                                                }
                                                asort($timezones);
                                            ?>
                                            @foreach ($timezones as $tz)
                                                <option value="{{ $tz }}" <?= $vtimezone == $tz ? 'selected' : '' ?>>{{ $tz }}</option>
                                            @endforeach
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
                                            <?php $vcurr_pos = __vsettings('currency_position', 'left'); ?>
                                            <option value="left" <?= $vcurr_pos == 'left' ? 'selected' : '' ?>>$ 100 </option>
                                            <option value="right" <?= $vcurr_pos == 'right' ? 'selected' : '' ?>>100 $ </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><?= lang('number_format') ?></label>
                                        <select name="number_format" id="number_format" class="form-control niceSelect">
                                            <?php $vnum_format = __vsettings('number_format', '1'); ?>
                                            <option value="0" <?= $vnum_format == '0' ? 'selected' : '' ?>>100</option>
                                            <option value="1" <?= $vnum_format == '1' ? 'selected' : '' ?>>100.00</option>
                                            <option value="2" <?= $vnum_format == '2' ? 'selected' : '' ?>>1.00,00 </option>
                                            <option value="3" <?= $vnum_format == '3' ? 'selected' : '' ?>>1,00.00 </option>
                                        </select>
                                    </div>
                                </div><!-- row -->

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label"><?= lang('date_format') ?></label>

                                        <select name="date_format" class="form-control">
                                            <?php $vdate_format = __vsettings('date_format', '1'); ?>
                                            <option value="1" <?= $vdate_format == '1' ? 'selected' : '' ?>>d-m-Y</option>
                                            <option value="2" <?= $vdate_format == '2' ? 'selected' : '' ?>>Y-m-d</option>
                                            <option value="3" <?= $vdate_format == '3' ? 'selected' : '' ?>>d/m/Y</option>
                                            <option value="4" <?= $vdate_format == '4' ? 'selected' : '' ?>>Y/m/d</option>
                                            <option value="5" <?= $vdate_format == '5' ? 'selected' : '' ?>>d.m.Y</option>
                                            <option value="6" <?= $vdate_format == '6' ? 'selected' : '' ?>>Y.m.d</option>
                                            <option value="7" <?= $vdate_format == '7' ? 'selected' : '' ?>>d M, Y</option>
                                            <option value="8" <?= $vdate_format == '8' ? 'selected' : '' ?>>d M Y</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="control-label"><?= lang('time_format') ?></label>

                                        <select name="time_format" class="form-control">
                                            <?php $vtime_format = __vsettings('time_format', '1'); ?>
                                            <option value="1" <?= $vtime_format == '1' ? 'selected' : '' ?>>12 <?= lang('format') ?></option>
                                            <option value="2" <?= $vtime_format == '2' ? 'selected' : '' ?>>24 <?= lang('format') ?></option>
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
