<!-- /.dash-menu -->
<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-8 "; ?> col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <?= __startForm(base_url('vendor/settings/add_settings'), ''); ?>
                <?= csrf(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12 mb-2rm">
                                <label><?= lang("language"); ?></label>
                                <div class="mt-10 flex gap-20 flex-wrap">
                                    <?php foreach ($language_list as  $key => $lang) : ?>
                                        <label class="custom-radio"> <input type="radio" name="language" value="<?= $lang->slug; ?>" <?= __vsettings('language') == $lang->slug ? "checked" : ($lang->slug == 'english' ? "checked" : "") ?>> <?= $lang->language_name; ?></label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-0">
                                <label><?= lang("country"); ?></label>
                                <select name="country_id" id="country_id" class="form-control singeSelect">
                                    <option value="" data-src=""><?= lang("select"); ?></option>

                                    <?php foreach ($country_list as $key => $country) : ?>
                                        <?php $timezone = json_decode($country->timezones); ?>
                                        <option data-src="<?= base_url("app/assets/flags/4x3/" . strtolower($country->iso2) . ".svg"); ?>" value="<?= $country->id; ?>" data-currency="<?= $country->currency_code; ?>" data-dial="<?= $country->dial_code; ?>" data-icon="<?= $country->currency_symbol; ?>" data-zone="<?= $timezone[0]->zoneName; ?>" data-code="<?= $country->iso2; ?>" <?= __vsettings('country_id') == $country->id ? "selected" : ""; ?>> <?= $country->name; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang("currency"); ?></label>
                                <select name="currency_id" id="currency" class="form-control select2">

                                    <option value=""><?= lang("select"); ?></option>
                                    <?php foreach ($country_list as $key => $country) : ?>
                                        <option value="<?= $country->id; ?>" <?= __vsettings('currency_id') == $country->id ? "selected" : ""; ?>> <?= $country->currency_code; ?> (<?= $country->currency_symbol; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- /# -->
                            </div>


                            <div class="form-group col-md-6">
                                <label><?= lang("dial_code"); ?></label>
                                <div class="ci-input-group input-group-append">
                                    <div class="input-group">
                                        <span>
                                            <span class="fi fi-<?= country(__vsettings('country_id'))->code ?> countryIcon"></span>
                                        </span>
                                    </div>
                                    <input type="text" name="dial_code" class="form-control only_number" value="<?= __vsettings('dial_code') ?? ''; ?>">
                                </div>

                                <!-- /# -->
                            </div>
                            <div class="form-group col-md-6">
                                <label><?= lang("timezone"); ?></label>
                                <select name="timezone" id="timezone" class="form-control select2">
                                    <option value="">select</option>
                                    <?php foreach (timezone_identifiers_list() as $timezone) : ?>
                                        <option value="<?= $timezone; ?>"><?= $timezone; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- /# -->
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang("currency_position"); ?></label>
                                <select name="currency_position" id="currency_position" class="form-control niceSelect">
                                    <option value="left" <?= __vsettings('currency_position') == "left" ? "selected" : ''; ?>>$ 100</option>
                                    <option value="right" <?= __vsettings('currency_position') == "right" ? "selected" : ''; ?>>100 $</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label><?= lang("number_format"); ?></label>
                                <select name="number_format" id="number_format" class="form-control niceSelect">
                                    <option value="0" <?= __vsettings('number_format') == "0" ? "selected" : ''; ?>>100</option>
                                    <option value="1" <?= __vsettings('number_format') == "1" ? "selected" : ''; ?>>100.00</option>
                                    <option value="2" <?= __vsettings('number_format') == "2" ? "selected" : ''; ?>>1.00,00</option>
                                    <option value="3" <?= __vsettings('number_format') == "3" ? "selected" : ''; ?>>1,00.00</option>
                                </select>
                            </div>
                        </div><!-- row -->

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="control-label"><?= lang('date_format'); ?></label>

                                <select name="date_format" class="form-control">
                                    <option value="1" <?= __vsettings('date_format') == 1 ? "selected" : "";; ?>> d-m-Y</option>
                                    <option value="2" <?= __vsettings('date_format') == 2 ? "selected" : "";; ?>>Y-m-d</option>
                                    <option value="3" <?= __vsettings('date_format') == 3 ? "selected" : "";; ?>>d/m/Y</option>
                                    <option value="4" <?= __vsettings('date_format') == 4 ? "selected" : "";; ?>>Y/m/d</option>
                                    <option value="5" <?= __vsettings('date_format') == 5 ? "selected" : "";; ?>>d.m.Y</option>
                                    <option value="6" <?= __vsettings('date_format') == 6 ? "selected" : "";; ?>>Y.m.d</option>
                                    <option value="7" <?= __vsettings('date_format') == 7 ? "selected" : "";; ?>>d M, Y</option>
                                    <option value="7" <?= __vsettings('date_format') == 7 ? "selected" : "";; ?>>d M, Y</option>
                                    <option value="8" <?= __vsettings('date_format') == 8 ? "selected" : "";; ?>>d M Y</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label class="control-label"><?= lang('time_format'); ?></label>

                                <select name="time_format" class="form-control">
                                    <option value="1" <?= __vsettings('time_format') == 1 ? "selected" : "";; ?>> 12 <?= lang('format'); ?></option>
                                    <option value="2" <?= __vsettings('time_format') == 2 ? "selected" : "";; ?>>24 <?= lang('format'); ?></option>

                                </select>
                            </div>

                        </div>



                        <!-- /.form-group -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <?= __submitBtn(); ?>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                <?= __endForm(); ?>
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->

<script>
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
</script>