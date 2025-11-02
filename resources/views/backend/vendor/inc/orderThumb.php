<div class="card-content">
    <div class="table-responsive responsiveTable">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= __('order_id') ?></th>
                    <th><?= __('customer') ?></th>
                    <th><?= __('overview') ?></th>
                    <th><?= __('status') ?></th>
                    <th><?= __('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_list as $key => $row): ?>
                    <tr>
                        <td data-label="#"><?= $key + 1; ?></td>
                        <td data-label="<?= __('order_id'); ?>">
                            <a href="<?= base_url("vendor/order-details/{$row->uid}") ?>">#<?= $row->uid; ?></a>
                            <div>
                                <?php if ($row->status == 'pending') : ?>
                                    <?php if (isToday($row->created_at, _ID())): ?>
                                        <small class="bg-red badge"><?= get_time_ago($row->created_at, _ID()); ?></small>
                                    <?php else: ?>
                                        <small class="text-warning">
                                            <?= get_time_ago($row->created_at, _ID()); ?>
                                        </small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <small class="text-muted">
                                        <?= get_time_ago($row->created_at, _ID()); ?>
                                    </small>

                                <?php endif; ?>
                            </div>
                        </td>

                        <td data-label="<?= __('customer'); ?>">
                            <div class="customerInfo">
                                <?= __get_customer_details($row); ?>

                                <?php if ($row->order_type == 'cod' && !empty($row->address)): ?>
                                    <?php $customerAddress = __customerAddress($row->customer_id, $row->address); ?>
                                    <div class=" mt-4">
                                        <?php if (is_numeric($row->address)): ?>
                                            <div class="space-between align-center ml-35">
                                                <div class="flex-1">
                                                    <?php if (isset($customerAddress->latitude) && !empty($customerAddress->latitude)): ?>
                                                        <a href="<?= gmap_link($customerAddress->latitude, $customerAddress->longitude) ?>" target="_blank" class=""><i class="fas fa-map-marker"></i> <?= $customerAddress->address ?? ''; ?></a>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        <?php else: ?>
                                            <div class="lefts">
                                                <p class="mt-5"><i class="fas fa-map-marker"></i> <?= $row->address; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </td>
                        <td data-label="<?= __('overview'); ?>">
                            <div class="Orderoverview">
                                <div class="orderTypeInfo d-flex align-center mb-5">
                                    <span class="f-bold badge badge-success"><?= __($row->order_type); ?></span>
                                </div>
                                <div class="d-flex flex-wrap gap-5 fz-14 gap-5">
                                    <p><span><?= __('qty'); ?></span> : <b class="dColor"><?= _x($row->qty) ?></b></p> •
                                    <p><span><?= __('price'); ?></span> : <b class="dColor"><?= _currency_position(_x($row->total), $row->vendor_id); ?></b></p>
                                </div>
                                <div class="mt-1">
                                    <small class="mute-text fz-12"><?= _vfull_time(_x($row->created_at), $row->vendor_id); ?></small>
                                </div>
                            </div>
                        </td>
                        <td data-label="<?= __('status'); ?>">
                            <div class="d-flex gap-10 flex-column">
                                <div><?= getStatus($row->status); ?></div>
                                <div>
                                    <p class="<?= $row->payment_status == "unpaid" ? "text-warning" : "text-success" ?> fz-12"> <i class='fas <?= $row->payment_status == "unpaid" ? "fa-spinner" : "fa-check"; ?>'></i> <?= __($row->payment_status); ?></p>
                                </div>
                            </div>
                        </td>
                        <td data-label="<?= __('action'); ?>" class="">
                            <div class="text-center d-flex flex-wrap gap-10 align-center orderListBtn">
                                <a href="<?= base_url("vendor/order-details/{$row->uid}") ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>

                                <div class="orderButton">
                                    <select name="" class="ci-select text-wrap" onchange="status(event,this.value);">

                                        <?php if (!in_array($row->status, ['accept', 'complete', 'processing', 'out_for_delivery', 'delivered'])): ?>
                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('pending')) ?>?q=live" <?= isset($row->status) && $row->status == 'pending' ? "selected" : ""; ?>><?= lang('pending'); ?></option>
                                        <?php endif; ?>


                                        <?php if (!in_array($row->status, ['complete', 'processing', 'out_for_delivery', 'delivered'])): ?>
                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('accept')) ?>?q=live" <?= isset($row->status) && $row->status == 'accept' ? "selected" : ""; ?>><?= lang('accept'); ?></option>
                                        <?php endif; ?>


                                        <?php if (!in_array($row->status, ['complete', 'out_for_delivery', 'delivered'])): ?>
                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('processing')) ?>?q=live" <?= isset($row->status) && $row->status == 'processing' ? "selected" : ""; ?>><?= lang('processing'); ?></option>
                                        <?php endif; ?>


                                        <?php if (!in_array($row->status, ['out_for_delivery', 'delivered'])): ?>
                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('complete')) ?>?q=live" <?= isset($row->status) && $row->status == 'complete' ? "selected" : ""; ?>><?= lang('complete'); ?></option>
                                        <?php endif; ?>

                                        <?php if ($row->order_type == 'cod' && in_array($row->status, ['complete', 'out_for_delivery', 'delivered'])): ?>

                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('out_for_delivery')) ?>?q=live" <?= isset($row->status) && $row->status == 'out_for_delivery' ? "selected" : ""; ?>><?= __('out_for_delivery'); ?></option>

                                            <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('delivered')) ?>?q=live" <?= isset($row->status) && $row->status == 'delivered' ? "selected" : ""; ?>><?= __('delivered'); ?></option>


                                        <?php endif; ?>

                                        <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('returned')) ?>?q=live" <?= isset($row->status) && $row->status == 'return' ? "selected" : ""; ?>><?= __('returned'); ?></option>

                                        <option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('cancel')) ?>?q=live" <?= isset($row->status) && $row->status == 'cancel' ? "selected" : ""; ?>><?= __('cancel'); ?></option>
                                    </select>


                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div><!-- card-content -->