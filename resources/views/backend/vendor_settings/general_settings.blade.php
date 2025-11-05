@extends('backend.vendor.layouts.app')
@section('content')
    <!-- /.dash-menu -->
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-9 col-xs-12">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label><?= lang('username') ?></label>
                                        <input type="text" name="username" class="form-control"
                                            value="phplime" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?= lang('app_name') ?> <?= __required() ?></label>
                                        <input type="text" name="app_name" class="form-control"
                                            value="shop" <?= __required(true) ?>>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><?= lang('email') ?> <?= __required() ?></label>
                                        <input type="text" name="email" class="form-control"
                                            value="phplime@gmail.com" <?= __required(true) ?>>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label><?= lang('phone') ?> <?= __required() ?></label>
                                        <div class="ci-input-group input-group-append">
                                            <div class="input-group">
                                                <span>
                                                    <span
                                                        class="fi fi-bd"></span>
                                                    <span class="ml-5"> + 88</span>
                                                </span>
                                            </div>
                                            <input type="text" name="phone" class="form-control"
                                                value="017347234" <?= __required(true) ?>>
                                        </div>
                                        <!-- /# -->
                                    </div>
                                </div><!-- row -->

                                <div class="row divider">
                                    <div class="form-group col-md-6">
                                        <label><?= lang('latitude') ?></label>
                                        <input type="text" name="latitude" class="form-control"
                                            value="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><?= lang('longitude') ?></label>
                                        <div class="ci-input-group  input-group-prepand">
                                            <input type="text" name="longitude" class="form-control"
                                                value="">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    onclick=getLocation();><i class="fas fa-map-marker-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><?= lang('google_map_location_link') ?></label>
                                        <input type="text" name="location" class="form-control"
                                            value="">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="control-label"><?= lang('address') ?> <?= __required() ?></label>
                                        <div class="">
                                            <textarea class="form-control" placeholder="address" name="address" required>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, explicabo?
                                            </textarea>
                                        </div>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label class="control-label"><?= lang('about_short') ?> (<?= lang('max') ?> 120)
                                            <?= __required() ?></label>
                                        <div class="">
                                            <textarea class="form-control" placeholder="<?= lang('about_short') ?>" name="about_short" required>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, facilis?
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label
                                            class="control-label"><?= !empty(lang('description')) ? lang('description') : 'description' ?></label>
                                        <div class="">
                                            <textarea class="form-control data_textarea" placeholder="description" name="description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, adipisci?
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div><!-- col-7 -->
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for=""><?= lang('logo') ?> <?= __('light') ?></label>
                                        <div class="mb-4">
                                            {{--  media_files('logo_light', 'single', _vendor('logo_light') ?? '') ?> --}}
                                        </div>

                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for=""><?= lang('logo') ?> <?= __('dark') ?></label>
                                        <div class="mb-4">
                                            {{--  media_files('logo_dark', 'single', _vendor('logo_dark') ?? '') ?> --}}
                                        </div>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for=""><?= lang('favicon') ?></label>
                                        <div class="mb-4">
                                            {{--  media_files('favicon', 'single', _vendor('favicon') ?? '') ?> --}}
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group hidden">
                                    <label><?= __('theme') ?></label>
                                    <div class="flex gap-2rm">
                                        <label class="custom-radio-2">
                                            <input type="radio" name="theme" value="light" checked>
                                                <span class="themeInput light"></span>
                                            </label>
                                        <label class="custom-radio-2">
                                            <input type="radio" name="theme" value="dark">
                                            <span class="themeInput dark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <?= hidden('id', 0) ?>
                                <button class="btn btn-primary" type="submit"><?= lang('submit') ?></button>
                            </div>
                        </div><!-- card -->
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col-md-6 -->

    </div>
    <!-- /.row -->


    {{-- <script>
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
</script> --}}
@endsection
