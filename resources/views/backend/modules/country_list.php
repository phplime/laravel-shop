<?php $country_id = isset($country_id) && !empty($country_id) ? $country_id : (__vsettings('country_id') ?? 0); ?>
<?php
$countryList = __select('country_list');
if (empty($countryList)) {
    return '';
}
?>
<select name="country_id" id="country_id" class="form-control singeSelect" onchange="country(this);">
    <option value="" data-src=""><?= lang("select"); ?></option>

    <?php foreach ($country_list as $key => $country) : ?>
        <?php $timezone = json_decode($country->timezones); ?>
        <option data-src="<?= base_url("app/assets/flags/4x3/" . strtolower($country->iso2) . ".svg"); ?>" value="<?= $country->id; ?>" data-currency="<?= $country->currency_code; ?>" data-dial="<?= $country->dial_code; ?>" data-icon="<?= $country->currency_symbol; ?>" data-zone="<?= $timezone[0]->zoneName; ?>" data-code="<?= $country->iso2; ?>" <?= $country_id == $country->id ? "selected" : ""; ?>> <?= $country->name; ?></option>
    <?php endforeach; ?>
</select>

<script>


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
        $('.countryIcon').removeClass(function(index, className) {
            return (className.match(/\bfi-\S+/g) || []).join(' ');
        }).addClass('fi-' + code.toLowerCase());


        var selectedOption = wrapper.options[wrapper.selectedIndex];
        var flagUrl = selectedOption.dataset.src;
        wrapper.style.backgroundImage = "url('" + flagUrl + "')";
    }
</script>