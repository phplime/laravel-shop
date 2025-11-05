<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1ZrlIEJE8B1PXGt8wqIrJmGYoEU8m3s4&libraries=places&callback=initMap&loading=async" defer></script>
<style>
    #map {
        height: 300px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header ">
                <h5 class="card-title"><a href="<?= base_url("vendor/settings/order_types") ?>" class="backBtn"><i class="fas fa-chevron-left"></i></a> <?= lang('pickup_points'); ?></h5>
            </div>
            <div class="card-body p-0">
                <div class="areaBased table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('name'); ?></th>
                                <th><?= __('latitude'); ?></th>
                                <th><?= __('longitude'); ?></th>
                                <th><?= __('address'); ?></th>
                                <th><?= __('status'); ?></th>
                                <th><?= __('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pickup_point_list as  $key => $row) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= _x($row->name) ?></td>
                                    <td><?= _x($row->latitude) ?></td>
                                    <td><?= _x($row->longitude) ?></td>
                                    <td><?= _x($row->address) ?></td>
                                    <td> <?= __status($row->id, $row->status, 'vendor_pickup_point_list'); ?></td>
                                    <td class="btnGroup">
                                        <?= __editBtn(base_url('vendor/settings/order_type_settings/pickup/?isEdit=' . $row->id), true, []); ?>
                                        <?= __deleteBtn($row->id, 'vendor_pickup_point_list', true); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- card -->

        <div class="row">
            <?= __startForm(base_url('vendor/extras/add_pickup_slots'), 'post'); ?>
            <?= csrf(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?= lang('pickup_time'); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row p-15">
                            <div class="table-responsive">
                                <div class="pickup-slots">
                                    <?php $pickup_slots = _vextras('pickup_time_slots', _ID()) ?? ''; ?>
                                    <?php $get_time = getTimeSlot('30', '00:00', '23:00') ?>
                                    <?php foreach ($get_time as $key2 => $slots): ?>
                                        <?php $timeSlot =  $slots['slot_start_time'] . ' - ' . $slots['slot_end_time']; ?>
                                        <label class="time_slot custom-checkbox <?= isset($pickup_slots, $timeSlot) && !empty($pickup_slots) && !empty($timeSlot) && in_array($timeSlot, $pickup_slots) == 1 ? "active" : ""; ?>">

                                            <input type="checkbox" class="timeCheckeds" name="time_slots[<?= $key2; ?>]" value="<?= $timeSlot; ?>" <?= isset($pickup_slots, $timeSlot) && !empty($pickup_slots)  && in_array($timeSlot, $pickup_slots) == 1 ? "checked" : ""; ?>> <?= _vtime_format($slots['slot_start_time'], _ID()); ?> - <?= _vtime_format($slots['slot_end_time'], _ID()); ?>
                                        </label>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div><!-- row -->

                    </div><!-- card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="id" value="<?= _vextras('id', _ID()); ?>">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> &nbsp;<?= !empty(lang('save_change')) ? lang('save_change') : "Save Change"; ?></button>
                    </div>
                </div><!-- card -->
            </div><!-- col-9 -->
            </form>
        </div>

    </div><!-- col-6 -->
    <div class="col-md-5">
        <?= __startForm(base_url('vendor/settings/add_pickup_points'), 'post'); ?>
        <?= csrf(); ?>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label><?= __('name'); ?> <?= __required(); ?></label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= __isset($data, 'name'); ?>">
                </div>


                <div class="form-group">
                    <label><?= __('latitude'); ?> <?= __required(); ?></label>
                    <input type="text" name="latitude" id="latitude" class="form-control" value="<?= __isset($data, 'latitude'); ?>">
                </div>
                <div class="form-group">
                    <label><?= __('longitude'); ?> <?= __required(); ?></label>
                    <input type="text" name="longitude" id="longitude" class="form-control" value="<?= __isset($data, 'longitude'); ?>">
                </div>

                <div class="form-group">
                    <label><?= __('address'); ?></label>
                    <input type="text" name="address" id="address" class="form-control" value="<?= __isset($data, 'address'); ?>">
                </div>

                <div class="form-group">
                    <div id="map"></div>
                </div>
            </div>
            <div class="card-footer text-2">
                <?php if (isset($data) && !empty($data)) : ?>
                    <div class="text-left flex-1">
                        <a href="<?= base_url("vendor/settings/order_type_settings/pickup"); ?>" class="btn btn-default"><?= __("cancel"); ?></a>
                    </div <?php endif; ?> <?= __hidden('id', __isset($data, 'id')); ?> <?= __submitBtn(); ?> </div>
            </div>
            </form>
        </div>
    </div><!-- row -->


    <?php foreach ($pickup_point_list as  $key =>  $data) : ?>
        <?= __header(__('edit'), base_url('vendor/settings/add_shipping_area'), 'area_' . $data->id); ?>
        <div class="form-group">
            <label><?= __('area_name'); ?></label>
            <input type="text" name="area_name" id="area_name" class="form-control" value="<?= __isset($data->area_name); ?>">
        </div>

        <div class="form-group">
            <label><?= __('shipping_charge'); ?></label>
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="<?= __isset($data, 'shipping_charge'); ?>">
        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(true, 'vendor/settings/order_type_settings/pickup'); ?>


    <?php endforeach; ?>



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
                        content: '<?= lang('click_the_map_to_get_lan_ln'); ?>',
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