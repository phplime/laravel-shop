@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="cardArea">
                <div class="card-header flex-column d-flex align-items-center flex-column">
                    <h2><?= __('create_new_store') ?></h2>
                    <p><?= __('create_new_store_msg') ?></p>
                </div>
                <form action="{{ url('vendor/profile/create_vendor?step=2') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label><?= __('currency') ?> <?= __required() ?></label>
                                <select name="currency" id="currency" class="form-control select2">
                                    <option value=""><?= lang('select') ?></option>
                                    <option value="">tk ($)</option>
                                </select>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label><?= lang('latitude') ?></label>
                                    <input type="text" name="latitude" class="form-control" value=""
                                        placeholder="<?= lang('latitude') ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?= lang('longitude') ?></label>
                                    <div class="ci-input-group  input-group-prepand">
                                        <input type="text" name="longitude" class="form-control" value=""
                                            placeholder="<?= lang('longitude') ?>">
                                        <div class="input-group">
                                            <button class="btn btn-primary btn-sm" type="button" onclick=getLocation();><i
                                                    class="fas fa-map-marker-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row divider">
                                <div class="col-md-12 from-group">
                                    <label><?= __('email') ?></label>
                                    <input type="text" name="email" class="form-control" value=""
                                        placeholder="<?= __('email') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= hidden('vendor_id', 0) ?>
                        <button type="submit" class="btn btn-primary btn-block w-50 mx-auto"><?= __('continue') ?> <i
                                class="icofont-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function changeModule(slug) {
            $('.moduleDetails').slideUp();
            $(`.moduleDetails.${slug}`).slideDown();
        }
    </script>
@endsection
