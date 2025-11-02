<div class="row justify-content-center">
    <div class="col-md-8">
        <?= __startForm(base_url('vendor/settings/add_settings/order_config'), 'post'); ?>
        <?= csrf(); ?>
        <div class="card">
            <div class="card-header">
                <h4><a href="<?= base_url("vendor/settings/order_types") ?>" class="backBtn"><i class="fas fa-chevron-left"></i></a> <?= lang($type); ?></h4>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="form-group col-md-12 ">
                        <ul class="shippingMenu flex gap-15 flex-wrap p-5 pt-10">
                            <li class="badge badge-secondary <?= __vsettings('shipping_type') == 'default' ? 'active' : ""; ?>"><label class="custom-radio-2"><input type="radio" name="shipping_type" value="default" <?= __checked(__vsettings('shipping_type'), 'default'); ?> checked onclick="location='<?= base_url('vendor/settings/shipping_types/default'); ?>'"><?= __('default'); ?></label></li>

                            <li class="badge badge-secondary <?= __vsettings('shipping_type') == 'area' ? 'active' : ""; ?>"><label class="custom-radio-2"><input type="radio" name="shipping_type" value="0" onclick="location='<?= base_url('vendor/settings/shipping_types/area'); ?>'" <?= __checked(__vsettings('shipping_type'), 'area'); ?>><?= __('area_based'); ?></label></li>

                            <li class="badge badge-secondary <?= __vsettings('shipping_type') == 'radius' ? 'active' : ""; ?>"><label class="custom-radio-2"><input type="radio" name="shipping_type" value="0" onclick="location='<?= base_url('vendor/settings/shipping_types/radius'); ?>'" <?= __checked(__vsettings('shipping_type'), 'radius'); ?>><?= __('radius_based'); ?></label></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?= __endForm(); ?>
    </div>
</div><!-- row -->

<?php $shipping_types =  !empty(__vsettings('shipping_type')) ? __vsettings('shipping_type') : 'default'; ?>
<?php if ($shipping_types == 'default') : ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= __startForm(base_url('vendor/settings/add_shipping_charge'), 'post'); ?>
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><?= lang($shipping_types); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row p-10">
                        <div class="col-md-6 form-group">
                            <label><?= __('shipping_charge'); ?></label>
                            <div class="ci-input-group input-group-prepand">
                                <input type="text" name="shipping_charge" id="shipping" class="form-control" value="<?= __vsettings('shipping_charge'); ?>">
                                <div class="input-group">
                                    <span><?= __vcountry()->currency_icon ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>
            </div>

            <?= __endForm(); ?>
        </div>
    </div><!-- row -->
<?php endif; ?>
<?php if ($shipping_types == 'area') : ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><?= lang($shipping_types . '_based'); ?></h5>
                    <?= __addbtn('', '', ['is_sidebar' => 1, 'class' => $shipping_types]); ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('area_name'); ?></th>
                                    <th><?= __('charge'); ?></th>
                                    <th><?= __('status'); ?></th>
                                    <th><?= __('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($shipping_area_list as  $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= _x($row->area_name) ?></td>
                                        <td><?= _x(_currency_position($row->shipping_charge, _ID())) ?></td>
                                        <td> <?= __status($row->id, $row->status, 'vendor_shipping_area_list'); ?></td>
                                        <td class="btnGroup">

                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'area_' . $row->id]); ?>
                                            <?= __deleteBtn($row->id, 'vendor_shipping_area_list', true); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->

    <?= __header(__('add_new'), base_url('vendor/settings/add_shipping_area'), 'area'); ?>
    <div class="form-group">
        <label><?= __('area_name'); ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge'); ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="">
            <div class="input-group">
                <span><?= __vcountry()->currency_icon; ?></span>
            </div>
        </div>
    </div>
    <?= __footer(); ?>


    <?php foreach ($shipping_area_list as  $key =>  $data) : ?>
        <?= __header(__('edit'), base_url('vendor/settings/add_shipping_area'), 'area_' . $data->id); ?>
        <div class="form-group">
            <label><?= __('area_name'); ?></label>
            <input type="text" name="area_name" id="area_name" class="form-control" value="<?= __isset($data->area_name); ?>">
        </div>

        <div class="form-group">
            <label><?= __('shipping_charge'); ?></label>
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="<?= __isset($data->shipping_charge); ?>">
        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>


    <?php endforeach; ?>

<?php endif; ?>



<?php if ($shipping_types == 'radius') : ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><?= lang($shipping_types . '_based'); ?></h5>
                    <?= __addbtn('', '', ['is_sidebar' => 1, 'class' => $shipping_types]); ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('min_distance'); ?></th>
                                    <th><?= __('max_distance'); ?></th>
                                    <th><?= __('charge'); ?></th>
                                    <th><?= __('status'); ?></th>
                                    <th><?= __('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($shipping_radius_list as  $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= _x($row->min_distance) ?></td>
                                        <td><?= _x($row->max_distance) ?></td>
                                        <td><?= _x(_currency_position($row->shipping_charge, _ID())) ?></td>
                                        <td> <?= __status($row->id, $row->status, 'vendor_radius_list'); ?></td>
                                        <td class="btnGroup">

                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'radius_' . $row->id]); ?>
                                            <?= __deleteBtn($row->id, 'vendor_radius_list', true); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->


    <?= __header(__('add_new'), base_url('vendor/settings/add_radius'), 'radius'); ?>
    <div class="form-group">
        <label><?= __('min_distance'); ?></label>
        <input type="text" name="min_distance" id="min_distance" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('max_distance'); ?></label>
        <input type="text" name="max_distance" id="max_distance" class="form-control" value="">
    </div>

    <div class="form-group">
        <label><?= __('shipping_charge'); ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="">
            <div class="input-group">
                <span><?= __vcountry()->currency_icon; ?></span>
            </div>
        </div>

    </div>
    <?= __footer(); ?>


    <?php foreach ($shipping_radius_list as  $key =>  $data) : ?>
        <?= __header(__('edit'), base_url('vendor/settings/add_radius'), 'radius_' . $data->id); ?>
        <div class="form-group">
            <label><?= __('min_distance'); ?></label>
            <input type="text" name="min_distance" id="min_distance" class="form-control" value="<?= __isset($data->min_distance); ?>">
        </div>

        <div class="form-group">
            <label><?= __('max_distance'); ?></label>
            <input type="text" name="max_distance" id="max_distance" class="form-control" value="<?= __isset($data->max_distance); ?>">
        </div>

        <div class="form-group">
            <label><?= __('shipping_charge'); ?></label>
            <div class="ci-input-group input-group-prepand">
                <input type="text" name="shipping_charge" id="shipping_charge" class="form-control number" value="<?= __isset($data->shipping_charge); ?>">
                <div class="input-group">
                    <span><?= __vcountry()->currency_icon; ?></span>
                </div>
            </div>
        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>


    <?php endforeach; ?>
<?php endif; ?>