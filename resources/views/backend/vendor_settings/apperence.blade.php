@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-8 col-xs-12">
            <form action="{{ url('vendor/settings/add_settings') }}" method="post" class="ajaxSubmit">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= lang('apperence') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><?= lang('menu_style') ?></label>
                                <select name="menu_style" id="menu_style" class="form-control niceSelect">
                                    <?php $vmenu_style = __vsettings('menu_style', 'sidebar'); ?>
                                    <option value="sidebar" <?= $vmenu_style == 'sidebar' ? 'selected' : '' ?>>
                                        <?= lang('sidebar') ?></option>
                                    <option value="topmenu" <?= $vmenu_style == 'topmenu' ? 'selected' : '' ?>>
                                        <?= lang('top_menu') ?></option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label><?= __('color') ?></label>
                                <div class="color_picker">
                                    <?php $vcolor = __vsettings('color', '#e8088e'); ?>
                                    <label class="ci-input-group input-group-prepand">
                                        <input type="color" class="form-control" name="color"
                                            value="<?= $vcolor ?>"
                                            autocomplete="off">
                                        <div class="input-group ci-color">
                                            <span
                                                style="background: <?= $vcolor ?>">
                                                <i class="fas fa-eye-dropper"></i> </span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group col-md-12">
                                <label><?= __('theme') ?></label>
                                <div class="flex gap-2rm">
                                    <?php $vtheme = __vsettings('theme', 'light'); ?>
                                    <label class="custom-radio-2"> <input type="radio" name="theme" value="light"
                                            <?= $vtheme == 'light' ? 'checked' : '' ?>><span
                                            class="themeInput light"></span></label>
                                    <label class="custom-radio-2"> <input type="radio" name="theme" value="dark"
                                            <?= $vtheme == 'dark' ? 'checked' : '' ?>><span
                                            class="themeInput dark"></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2rm">
                            <div class="form-group col-md-3">
                                <?php $vlayout = __vsettings('layouts', '1'); ?>
                                <label class="custom-radio-2 layoutsImg">
                                    <input type="radio" name="layouts" value="1" <?= $vlayout == '1' ? 'checked' : '' ?>>
                                    <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                        alt="layout">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- row -->
@endsection
