<!-- /.dash-menu -->
<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-8 "; ?> col-xs-12">
        <?= __startForm(base_url('vendor/settings/add_settings/apperence'), 'post'); ?>
        <?= csrf(); ?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= lang('apperence'); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang("menu_style"); ?></label>
                        <select name="menu_style" id="menu_style" class="form-control niceSelect">
                            <option value="sidebar" <?= __vsettings('menu_style') == 'sidebar' ? "selected" : ""; ?>><?= lang('sidebar'); ?></option>
                            <option value="topmenu" <?= __vsettings('menu_style') == 'topmenu' ? "selected" : ""; ?>><?= lang('top_menu'); ?></option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?= __('color'); ?></label>
                        <div class="color_picker">
                            <label class="ci-input-group input-group-prepand">
                                <input type="color" class="form-control" name="color" value="#<?= !empty(__vsettings('color')) ? __vsettings('color') : "e8088e" ?>" autocomplete="off">
                                <div class="input-group ci-color">
                                    <span style="background: #<?= !empty(__vsettings('color')) ? __vsettings('color') : "e8088e" ?>"> <i class="fas fa-eye-dropper"></i> </span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group col-md-12">
                        <label><?= __('theme'); ?></label>
                        <div class="flex gap-2rm">
                            <label class="custom-radio-2"> <input type="radio" name="theme" value="light" <?= __vsettings('theme') == "light" ? "checked" : ""; ?>><span class="themeInput light"></span></label>
                            <label class="custom-radio-2"> <input type="radio" name="theme" value="dark" <?= __vsettings('theme') == "dark" ? "checked" : ""; ?>><span class="themeInput dark"></span></label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2rm">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="form-group col-md-3">
                            <label class="custom-radio-2 layoutsImg"> <input type="radio" name="layouts" value="<?= $i; ?>" <?= __vsettings('layouts') == $i ? "checked" : ""; ?>>
                                <img src="<?= asset_url('app/assets/images/layouts/layouts-' . $i . '.png'); ?>" alt="layout">
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= __submitBtn(); ?>
            </div>
        </div>

        <?= __endForm(); ?>
    </div>
</div><!-- row -->