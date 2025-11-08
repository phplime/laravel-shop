@extends('backend.vendor.layouts.app')
@section('content')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1ZrlIEJE8B1PXGt8wqIrJmGYoEU8m3s4&libraries=places&callback=initMap&loading=async"
        defer></script>
    <style>
        #map {
            height: 300px;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><a href="<?= url('vendor/settings/order_types') ?>" class="backBtn"><i
                                class="fas fa-chevron-left"></i></a> <?= lang('pickup_points') ?></h5>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('name') ?></th>
                                    <th><?= __('latitude') ?></th>
                                    <th><?= __('longitude') ?></th>
                                    <th><?= __('address') ?></th>
                                    <th><?= __('status') ?></th>
                                    <th><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Baliamari</td>
                                    <td>Baliamari</td>
                                    <td>Baliamari</td>
                                    <td>Baliamari</td>
                                    <td> <?= __status(1, 1, 'vendor_pickup_point_list') ?></td>
                                    <td class="btnGroup">
                                        <?= __editBtn(url('vendor/settings/order_type_settings/pickup/?isEdit=' . 1), true, []) ?>
                                        <?= __deleteBtn(1, 'vendor_pickup_point_list', true) ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->

            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4><?= lang('pickup_time') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row p-15">
                                    <div class="table-responsive">
                                        <div class="pickup-slots">
                                            <label class="time_slot custom-checkbox active">

                                                <input type="checkbox" class="timeCheckeds" name="time_slots[1]"
                                                    value="00:00 - 00:30" checked=""> 12:00 am - 12:30 am </label>
                                        </div>
                                    </div>
                                </div><!-- row -->

                            </div><!-- card-body -->
                            <div class="card-footer">
                                <input type="hidden" name="id" value="1">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i>
                                    &nbsp;<?= !empty(lang('save_change')) ? lang('save_change') : 'Save Change' ?></button>
                            </div>
                        </div><!-- card -->
                    </form>
                </div><!-- col-9 -->
            </div>

        </div><!-- col-6 -->
        <div class="col-md-5">

            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label><?= __('name') ?> <?= __required() ?></label>
                            <input type="text" name="name" id="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label><?= __('latitude') ?> <?= __required() ?></label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label><?= __('longitude') ?> <?= __required() ?></label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label><?= __('address') ?></label>
                            <input type="text" name="address" id="address" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <div id="map"></div>
                        </div>
                    </div>
                    <div class="card-footer text-2">
                        <div class="text-left flex-1">
                            <a href="<?= url('vendor/settings/order_type_settings/pickup') ?>"
                                class="btn btn-default"><?= __('cancel') ?></a>
                        </div>
                        <?= hidden('id', 1) ?>
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>

        </div>
    </div><!-- row -->


    <?= __header(__('edit'), url('vendor/settings/add_shipping_area'), 'area_1') ?>
    <div class="form-group">
        <label><?= __('area_name') ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" value="char ">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge') ?></label>
        <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="4">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer(true, 'vendor/settings/order_type_settings/pickup') ?>




    <script type="text/javascript">
        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(p, showError) {
                    var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
                    var mapOptions = {
                        center: LatLng,
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                    let infoWindow = new google.maps.InfoWindow({
                        content: '<?= lang('click_the_map_to_get_lan_ln') ?>',
                        position: LatLng,
                    });

                    infoWindow.open(map);

                    console.log(`${p.coords.latitude} + ${p.coords.longitude}`);
                    map.addListener("click", (mapsMouseEvent) => {
                        // Close the current InfoWindow.
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                        });
                        infoWindow.setContent(
                            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                        );
                        var latlan = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                        var obj = JSON.parse(latlan);
                        $('[name="latitude"]').val(obj.lat);
                        $('[name="longitude"]').val(obj.lng)
                        console.log(obj);
                        infoWindow.open(map);
                    });
                });
            } else {
                alert('Geo Location feature is not supported in this browser.');
            }



            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        x.innerHTML = "User denied the request for Geolocation."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        x.innerHTML = "Location information is unavailable."
                        break;
                    case error.TIMEOUT:
                        x.innerHTML = "The request to get user location timed out."
                        break;
                    case error.UNKNOWN_ERROR:
                        x.innerHTML = "An unknown error occurred."
                        break;
                }
            }
        }
    </script>
@endsection
