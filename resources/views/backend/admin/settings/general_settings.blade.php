@extends('backend.admin.layouts.app')
@section('content')
<form action="{{ url('admin/settings/add_settings') }}" onsubmit="formSubmit(event,this)" method="post">
    <div class="row">
        @include('backend.admin.partials.adminmenu')


        <div class="{{ __settings('menu_style') == 1 ? 'col-lg-8' : 'col-lg-5' }} col-xs-12">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang('general_settings') ?></h5>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">

                        <div class="row">
                            <div class="form-group col-md-12 mb-2rm">
                                <label><?= lang('language') ?></label>
                                <div class="mt-10 flex gap-20 flex-wrap">
                                    <?php foreach ($language_list as  $key => $lang) : ?>
                                        <label class="custom-radio"> <input type="radio" name="language"
                                                value="<?= $lang->slug ?>"
                                                <?= __settings('language') == $lang->slug ? 'checked' : '' ?>>
                                            <?= $lang->language_name ?></label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 mb-0">
                                <label><?= lang('country') ?></label>
                                <select name="country_id" id="country_id" class="form-control singeSelect">
                                    <option value="" data-src=""><?= lang('select') ?></option>

                                    <?php foreach ($country_list as $key => $country) : ?>
                                        <?php $timezone = json_decode($country->timezones); ?>
                                        <option
                                            data-src="<?= asset('assets/flags/4x3/' . strtolower($country->iso2) . '.svg') ?>"
                                            value="<?= $country->id ?>" data-currency="<?= $country->currency_code ?>"
                                            data-dial="<?= $country->dial_code ?>"
                                            data-icon="<?= $country->currency_symbol ?>"
                                            data-zone="<?= $timezone[0]->zoneName ?>" data-code="<?= $country->iso2 ?>"
                                            <?= __settings('country_id') == $country->id ? 'selected' : '' ?>>
                                            <?= $country->name ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang('currency') ?></label>
                                <select name="currency" id="currency" class="form-control select2">

                                    <option value=""><?= lang('select') ?></option>
                                    <?php foreach ($country_list as $key => $country) : ?>
                                        <option value="<?= $country->currency_code ?>"
                                            <?= __settings('currency') == $country->currency_code ? 'selected' : '' ?>>
                                            <?= $country->currency_code ?> (<?= $country->currency_symbol ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- /# -->
                            </div>

                            <div class="form-group col-md-6">
                                <label><?= lang('dial_code') ?></label>
                                <div class="ci-input-group input-group-append">
                                    <div class="input-group">
                                        <span>
                                            <span
                                                class="fi fi-<?= country(__settings('country_id'))->code ?? 'us' ?>"></span>
                                        </span>
                                    </div>
                                    <input type="text" name="dial_code" class="form-control"
                                        value="<?= __settings('dial_code') ?? '' ?>">
                                </div>

                                <!-- /# -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang('timezone') ?></label>
                                <select name="timezone" id="timezone" class="form-control select2">
                                    <option value="">select</option>
                                    <?php foreach (timezone_identifiers_list() as $timezone) : ?>
                                        <option value="<?= $timezone ?>"><?= $timezone ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- /# -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang('app_name') ?></label>
                                <input type="text" name="app_name" class="form-control"
                                    value="<?= __settings('app_name') ?? '' ?>">
                                <!-- /# -->
                            </div>

                            <div class="form-group col-md-6">
                                <label><?= lang('menu_style') ?></label>
                                <select name="menu_style" id="menu_style" class="form-control">
                                    <option value="0" <?= __settings('menu_style') == 0 ? 'selected' : '' ?>>
                                        <?= lang('sidebar') ?></option>
                                    <option value="1" <?= __settings('menu_style') == 1 ? 'selected' : '' ?>>
                                        <?= lang('top_menu') ?></option>
                                </select>
                                <!-- /# -->
                            </div>
                        </div>


                        <div class="row mb-2rm">
                            <div class="col-md-6">
                                <label for=""><?= lang('logo') ?></label>
                                <div class="mb-4">
                                    <?= media_files('logo', 'single', __settings('logo') ?? '') ?>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label for=""><?= lang('favicon') ?></label>
                                <div class="mb-4">
                                    <?= media_files('favicon', 'single', __settings('favicon') ?? '') ?>
                                </div>

                            </div>
                            <!-- /.col-md-12 -->
                        </div>

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?= lang('description') ?></label>
                                    <textarea name="description" id="description" class="form-control data_textarea" cols="30" rows="10"><?= __settings('description') ?></textarea>
                                    <!-- /# -->
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->

                        <!-- /.row -->
                    </div>
                </div>

            </div>

        </div>
        <div class="<?= __settings('menu_style') == 1 ? 'col-lg-4' : 'col-lg-4' ?>">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label><?= lang('currency_position') ?></label>
                            <select name="currency_position" id="currency_position" class="form-control niceSelect">
                                <option value="left"
                                    <?= __settings('currency_position') == 'left' ? 'checked' : '' ?>>$100</option>
                                <option value="right"
                                    <?= __settings('currency_position') == 'right' ? 'checked' : '' ?>>100$</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><?= lang('number_format') ?></label>
                            <select name="number_format" id="number_format" class="form-control niceSelect">
                                <option value="0" <?= __settings('number_format') == '0' ? 'checked' : '' ?>>100
                                </option>
                                <option value="1" <?= __settings('number_format') == '1' ? 'checked' : '' ?>>100.00
                                </option>
                                <option value="2" <?= __settings('number_format') == '1' ? 'checked' : '' ?>>
                                    1.00,00</option>
                                <option value="3" <?= __settings('number_format') == '1' ? 'checked' : '' ?>>
                                    1,00.00</option>
                            </select>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section">
                                <div class="section-header">
                                    <h4><?= __('subscription_invoice') ?></h4>
                                </div>
                                <div class="section-body">
                                    <div class="form-group">
                                        <label><?= __('tax') ?>
                                            <small><?= __('tax_percent_for_invoice') ?></small></label>

                                        <div class="ci-input-group input-group-prepand">

                                            <input type="text" name="tax_percent" class="form-control only_number"
                                                value="<?= __settings('tax_percent') ?? '' ?>">
                                            <div class="input-group">
                                                <span>
                                                    %
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label><?= __('tax_number') ?></label>
                                        <input type="text" name="tax_number" class="form-control"
                                            value="<?= __settings('tax_number') ?? '' ?>">
                                    </div>

                                    <div class="form-group">
                                        <label><?= __('company_organization_details') ?></label>

                                        <textarea name="company_details" class="form-control" id="company_details" cols="5" rows="5"><?= __settings('company_details') ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label><?= __('theme') ?></label>
                                            <div class="flex gap-2rm">
                                                <label class="custom-radio-2"> <input type="radio" name="theme"
                                                        value="light"
                                                        <?= __settings('theme') == 'light' ? 'checked' : '' ?>><span
                                                        class="themeInput light"></span></label>
                                                <label class="custom-radio-2"> <input type="radio" name="theme"
                                                        value="dark"
                                                        <?= __settings('theme') == 'dark' ? 'checked' : '' ?>><span
                                                        class="themeInput dark"></span></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?= __('color') ?></label>
                                            <div class="color_picker">
                                                <label class="ci-input-group input-group-prepand">
                                                    <input type="color" class="form-control" name="color"
                                                        value="<?= '#' . __settings('color') ?? '#06bc76' ?>"
                                                        autocomplete="off">
                                                    <div class="input-group ci-color">
                                                        <span
                                                            style="background: <?= '#' . __settings('color') ?? '#06bc76' ?>">
                                                            <i class="fas fa-eye-dropper"></i> </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- section body -->
                            </div>
                        </div>
                    </div><!-- row -->
                </div>
                <div class="card-footer text-right btn-block ">
                    <?= __submitBtn() ?>
                </div>
            </div>
        </div>
    </div>

</form>

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
            var ddial_code = `<?= __settings('dial_code') ?>`;
            var dcurrency = `<?= __settings('currency') ?>`;
            var dtimezone = `<?= __settings('timezone') ?>`;
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

    })
</script>
@endsection