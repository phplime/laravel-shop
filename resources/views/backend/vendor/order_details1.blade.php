<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header space-between">
                <h4 class="card-title">#<?= _x($order->uid); ?></h4>
                <div class="topBtn">
                    <a href="javascript:;" onclick="print('printArea')" class="btn btn-sm  btn-outline-success"><i class="fa fa-print"></i> <?= __('print_invoice'); ?></a>
                    <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="<?= $order->uid ?? random_string('numeric', 10); ?>" class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export'); ?></a>
                </div>

            </div>
            <div class="card-body pt-5">
                <div class="d-flex space-between flex-wrap">
                    <div class="ordeLeft">
                        <ul>
                            <li><?= __('order_type'); ?> : <span class="text-heading dColor"> <?= __($order->order_type); ?></span></li>
                            <?php if ($order->order_type == 'cod'): ?>
                                <?php if (!empty($order->shipping_charge)): ?>
                                    <li><?= __('shipping_charge'); ?> : <span class="text-heading"> <?= _currency_position($order->shipping_charge, _ID()); ?></span></li>
                                <?php endif; ?>
                                <?php $shipping_info = isJson($order->shipping_info) ? __isJson($order->shipping_info) : ''; ?>

                                <?php if (!empty($order->shipping_type) && $order->shipping_type == 'area'): ?>
                                    <?php if (isset($shipping_info->area_name) && !empty($shipping_info->area_name)): ?>
                                        <li><?= __('shipping_area'); ?> : <span class="text-heading"> <?= _x($shipping_info->area_name); ?></span></li>
                                    <?php endif; ?>
                                <?php endif; ?><!-- shipping type -->

                                <?php if (!empty($order->shipping_type) && $order->shipping_type == 'radius'): ?>
                                    <?php if (isset($shipping_info->distance) && !empty($shipping_info->distance)): ?>
                                        <li><?= __('distance'); ?> : <span class="text-heading"> <?= _x($shipping_info->distance); ?></span></li>
                                    <?php endif; ?>
                                <?php endif; ?>

                            <?php endif; ?><!-- cod -->
                            <?php if ($order->order_type == 'pickup'): ?>
                                <li><?= __('pickup_point'); ?> : <span class="text-heading"> <?= __single($order->pickup_id, 'vendor_pickup_point_list')->name ?? ''; ?></span></li>
                                <li><?= __('pickup_date'); ?> : <span class="text-heading"> <?= _vfull_date($order->pickup_date, $order->vendor_id); ?></span></li>
                                <?php
                                $pickupTime = explode('-', $order->pickup_time);
                                ?>
                                <li><?= __('pickup_time'); ?> : <span class="text-heading label badge-success"> <?= isset($pickupTime[0]) ? _vtime_format($pickupTime[0], $order->vendor_id) : ''; ?> - <?= isset($pickupTime[1]) ? _vtime_format($pickupTime[1], $order->vendor_id) : ''; ?></span></li>
                            <?php endif; ?>

                            <?php if ($order->order_type == 'dinein'): ?>
                                <li><?= __('table'); ?> : <span class="text-heading"> <?= __single($order->table_no, 'vendor_table_list')->table_name ?? ''; ?></span></li>
                                <li><?= __('guest'); ?> : <span class="text-heading"> <?= _x($order->person) ?></span></li>
                            <?php endif; ?>
                            <li><?= __('order_time'); ?> : <span class="text-heading"> <?= _vfull_time($order->created_at, _ID()); ?></span></li>
                        </ul>
                    </div>
                    <div class="orderRight gap-10 flex-wrap mt-10">

                        <select name="" class="ci-select" onchange="status(event,this.value)">
                            <option value="<?= base_url("vendor/order/payment_status/{$order->uid}/" . Orders::status('paid')) ?>" <?= isset($order->payment_status) && $order->payment_status == 'paid' ? "selected" : ""; ?>><?= __('paid'); ?></option>
                            <option value="<?= base_url("vendor/order/payment_status/{$order->uid}/" . Orders::status('unpaid')) ?>" <?= isset($order->payment_status) && $order->payment_status == 'unpaid' ? "selected" : ""; ?>><?= __('unpaid'); ?></option>
                        </select>

                        <div class="btn_group d-flex gap-10 flex-wrap">
                            <?php if (in_array($order->status, ['accept', 'complete', 'processing', 'out_for_delivery', 'delivered'])): ?>
                                <a href="javascript:;" class="btn info-light-active"><i class="icofont-check"></i> <?= lang('accepted'); ?></a>
                            <?php else: ?>
                                <a href="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('accept')) ?>" class="btn info-light" onclick="status(event,this.href);"><i class="icofont-hand-drag1"></i> <?= lang('accept'); ?></a>
                            <?php endif; ?>


                            <?php if (in_array($order->status, ['processing', 'complete', 'out_for_delivery', 'delivered'])): ?>
                                <a href="javascript:;" class="btn success-light-active"><i class="icofont-check"></i> <?= lang('processing'); ?></a>
                            <?php else: ?>
                                <a href="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('processing')) ?>" class="btn success-light" onclick="status(event,this.href);"><i class="icofont-hand-drag1"></i> <?= lang('processing'); ?></a>
                            <?php endif; ?>


                            <?php if (in_array($order->status, ['complete', 'out_for_delivery', 'delivered'])): ?>
                                <a href="javascript:;" class="btn primary-light-active"><i class="icofont-check"></i> <?= lang('complete'); ?></a>
                            <?php else: ?>
                                <a href="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('complete')) ?>" class="btn primary-light" onclick="status(event,this.href);"><i class="icofont-hand-drag1"></i> <?= lang('complete'); ?></a>
                            <?php endif; ?>
                        </div>

                        <select name="" class="ci-select" onchange="status(event,this.value)">
                            <option value=""><?= __('more'); ?></option>
                            <?php if ($order->order_type == 'cod' && in_array($order->status, ['complete', 'out_for_delivery', 'delivered'])): ?>

                                <option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('out_for_delivery')) ?>" <?= isset($order->status) && $order->status == 'out_for_delivery' ? "selected" : ""; ?>><?= __('out_for_delivery'); ?></option>


                                <option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('delivered')) ?>" <?= isset($order->status) && $order->status == 'delivered' ? "selected" : ""; ?>><?= __('delivered'); ?></option>

                            <?php endif; ?>

                            <option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('returned')) ?>" <?= isset($order->status) && $order->status == 'returned' ? "selected" : ""; ?>><?= __('returned'); ?></option>
                            <option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('cancel')) ?>" <?= isset($order->status) && $order->status == 'cancel' ? "selected" : ""; ?>><?= __('cancel'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php if (!empty($order->item_list)): ?>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('item_list'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="itemList">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('item_details'); ?></th>
                                        <th><?= __('qty'); ?></th>
                                        <th><?= __('total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order->item_list as  $key => $item): ?>
                                        <tr>
                                            <td data-label="# "><?= $key + 1; ?></td>
                                            <td data-label="<?= __("item_details"); ?>">
                                                <div class="itemTopsection">
                                                    <div class="avatar avatar-small">
                                                        <img src="<?= avatar($item->thumb, 'item') ?>" alt="item_image">
                                                    </div>
                                                    <div class="itemDetails">
                                                        <h4><?= _x($item->title); ?></h4>
                                                        <?php if (!empty($item->tax) && $item->tax != 'null' && isJson($item->tax)): ?>
                                                            <?php $taxItems = []; ?>
                                                            <?php foreach (__isJson($item->tax) as  $key => $tax): ?>
                                                                <?php
                                                                $taxStatus = $tax->tax_status == 'include' ? __('included') : __('excluded');
                                                                $taxItems[] = "{$tax->tax_name} {$tax->tax_percentage}% {$taxStatus}"; ?>
                                                            <?php endforeach; ?>
                                                            <p><small> <?= implode(', ', $taxItems); ?></small></p>
                                                        <?php endif; ?>

                                                        <?php if ($item->is_variant == 1 && isJson($item->variants)): ?>
                                                            <?php $variants = __isJson($item->variants); ?>
                                                            <p class="mt-2"><span><?= isset($variants->variant_name) ? $variants->variant_name : ""; ?> </span> : <span class="text-heading"><?= isset($variants->name) ? $variants->name : ""; ?></span> <span><?= __('price'); ?> </span> <span class="text-heading"><?= isset($variants->price) ? _currency_position($variants->price, _ID()) : ""; ?></span></p>
                                                        <?php else: ?>
                                                            <p class="mt-2"><span><?= __('price'); ?>: <?= isset($item->item_price) ? _currency_position($item->item_price, _ID()) : ""; ?></span> </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php if ($item->is_extras == 1 && isJson($item->extras)): ?>
                                                    <div class="extraSection pl-75">
                                                        <ul>
                                                            <?php foreach (__isJson($item->extras) as  $key => $extra): ?>
                                                                <li><span><?= isset($extra->ex_qty) ? $extra->ex_qty : 1; ?> x <?= __exName($extra->ex_id); ?> (<?= isset($extra->ex_price) ? $extra->ex_price : 0; ?>) </span> = <span class="text-heading"> <?= _currency_position($extra->ex_qty * $extra->ex_price, _ID()) ?></span></li>
                                                            <?php endforeach; ?>

                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td data-label="<?= __("qty"); ?>"><?= $item->qty; ?></td>
                                            <td data-label="<?= __("total"); ?>"><?= _currency_position($item->subtotal, _ID()); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="2" class="colspan-null"></td>
                                        <td colspan="2" class="colspan-data">
                                            <?= __orderDetails($order, _ID()) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if (!empty($order->comments)): ?>
                    <div class="commentsArea pt-0 px-15 pb-15">
                        <p><?= __('comments'); ?> : <?= _x($order->comments); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= __('order_history'); ?></h5>
            </div>
            <div class="card-body p-sm-10-0">
                <div class="orderHistory">
                    <div class="timeline">

                        <div>
                            <i class="fas fa-bell bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> <?= get_time_ago($order->created_at); ?></span>
                                <h4 class="timeline-header no-border"><?= __('just_created'); ?></h4>
                                <div class="timeline-body">
                                    <div class="customerInfos">
                                        <?php if (!empty($order->customer_id)): ?>
                                            <?php $customer_info = __staff_info($order->customer_id); ?>
                                            <?php if (isset($customer_info->profile) && !empty($customer_info->profile)) ?>
                                            <img src="<?= avatar($customer_info->profile, 'profile') ?>" class="avatar" alt="avatar">
                                        <?php endif; ?>
                                        <?= __get_customer_details($order); ?>

                                        <?php if ($order->order_type == 'cod' && !empty($order->address)): ?>
                                            <?php $customerAddress = __customerAddress($order->customer_id, $order->address); ?>
                                            <div class=" mt-1rm">
                                                <?php if (is_numeric($order->address)): ?>
                                                    <div class="space-between align-center">
                                                        <div class="left flex-1">
                                                            <h4><?= __('address'); ?></h4>
                                                            <p class="mt-5"><i class="fas fa-map-marker"></i> <?= $customerAddress->address ?? ''; ?></p>
                                                        </div>
                                                        <?php if (isset($customerAddress->latitude) && !empty($customerAddress->latitude)): ?>
                                                            <div class="right">
                                                                <a href="<?= gmap_link($customerAddress->latitude, $customerAddress->longitude) ?>" target="_blank" class="ci-round-btn active"><i class="fas fa-map-marker-alt"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="left">
                                                        <h4><?= __('delivery_address'); ?></h4>
                                                        <p class="mt-5"><i class="fas fa-map-marker"></i> <?= $order->address; ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($order->is_online_payment == 1): ?>
                            <div>
                                <i class="fas fa-bell bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= get_time_ago($order->created_at); ?></span>
                                    <h4 class="timeline-header no-border"><?= __('payment_method'); ?> : <label class="label bg-success"><?= __($order->payment_method); ?></label></h4>
                                    <div class="timeline-body">
                                        <div class="customerInfos">
                                            <p class="text-success"> <?= $order->payment_status == 'paid' ? '<i class="icofont-check-alt"></i>' : '<i class="fas fa-spinner"></i>'; ?> <?= __($order->payment_status); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($order->actions) && isJson($order->actions)): ?>
                            <?php foreach (__isJson($order->actions) as  $key => $ac): ?>
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= get_time_ago($ac->date); ?></span>
                                        <h4 class="timeline-header no-border"><?= __('order'); ?> <b class="dColor"><?= __($ac->action); ?></b> </h4>
                                        <div class="timeline-body">
                                            <p><?= __('status_from'); ?> <b><?= __($ac->action_by); ?></b></p>
                                            <small><i class="icofont-clock-time"></i> <?= _vfull_time($ac->date, _ID()); ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- customer Info -->
</div>

<?php __include('invoice', _ID()); ?>


<script>
    var redirectUrl = `<?= base_url("vendor/order-details/{$order->uid}?isAjax=1") ?>`

    function status(event, url) {
        event.preventDefault();
        if (url == null || url == undefined || url == 'javascript:;' || url == '#') {
            return;
        }

        getRequest(url).then(function(json) {
            setTimeout(() => {
                axios.get(redirectUrl)
                    .then(function(response) {
                        MSG(true, '');
                        setTimeout(() => {
                            $('#mainContent').html(response.data);
                        }, 150);
                    })
                    .catch(function(error) {
                        console.log('Error loading order type settings:', error);
                    });
            }, 150);
        }).catch(function(error) {
            console.error('Error:', error);
        });
    }
</script>