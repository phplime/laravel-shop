<!-- /.dash-menu -->
<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_order_config_menu.php', ['col' => 'col-lg-9']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-9" : "col-lg-8 "; ?> col-xs-12">
        <?= __startForm(base_url('vendor/settings/order_type_config'), 'post'); ?>
        <?= csrf(); ?>
        <div class="card">
            <div class="card-header">
                <h4><?= lang('order_types-configuration'); ?></h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%"><?= __('name'); ?></th>
                            <th width="70%"><?= __('status'); ?></th>
                            <th width="10%"><?= __('action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_types as  $key => $row) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td width="40%">
                                    <label class="custom-checkbox"><input type="checkbox" name="order_types[<?= $row->order_type_id; ?>]" value="<?= $row->order_type_id; ?>" <?= $row->status == 1 ? "checked" : ""; ?>><?= !empty(__($row->slug)) ? __($row->slug) : _x($row->title); ?></label>
                                </td>
                                <td>
                                    <?php if ($row->slug != 'paycash') : ?>
                                        <div class="orderTypeDetails">
                                            <ul>
                                                <?php if (__isPackage('digital_payment')): ?>
                                                    <li><label class="custom-checkbox"><input type="checkbox" name="is_payment[<?= $row->order_type_id; ?>]" value="<?= $row->order_type_id; ?>" <?= $row->is_payment == 1 ? "checked" : ""; ?>><?= __('enable_payment'); ?></label></li>
                                                    <li><label class="custom-checkbox"><input type="checkbox" name="is_required[<?= $row->order_type_id; ?>]" value="<?= $row->order_type_id; ?>" <?= $row->is_required == 1 ? "checked" : ""; ?>><?= __('payment_required'); ?></label></li>
                                                <?php endif; ?>

                                                <li><label class="custom-checkbox"><input type="checkbox" name="is_service_charge[<?= $row->order_type_id; ?>]" value="<?= $row->order_type_id; ?>" <?= $row->is_service_charge == 1 ? "checked" : ""; ?>><?= __('enable-service_charge'); ?></label></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row->slug != 'paycash') : ?>
                                        <a href="<?= base_url('vendor/settings/order_type_settings/' . $row->slug); ?>" class="btn btn-secondary"><i class="fa fa-cogs"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <input type="hidden" name="ids[]" value="<?= $row->order_type_id; ?>">
                            <input type="hidden" name="activeIds[<?= $row->order_type_id; ?>]" value="<?= $row->active_id; ?>">
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <?= __submitBtn(); ?>
            </div>
        </div>
        <?= __endForm(); ?>
    </div>
</div>