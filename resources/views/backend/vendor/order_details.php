<div class="row">
    <div class="col-md-12">
        <div class="orderDetails_header">
            <div class="header__leftContent">
                <div class="flex align-center gap-10">
                    <a href="<?= base_url('vendor/order/order_list') ?>" class="back__btn"><i class="icofont-undo"></i></a>
                    <h2 class="orderUid">#<?= _x($order->uid); ?></h2>
                </div>
                <span class="order_time">Created At - <?= _vfull_time(_x($order->created_at)); ?></span>
            </div>
            <div class="header__rightBtns">
                <a href="" class="btn order_delete"><i class="far fa-trash-alt"></i>&nbsp;Delete Order</a>
                <a href="" class="btn order_track"><i class="fas fa-map-marked-alt"></i>&nbsp;Track Order</a>
                <a href="" class="btn order_edit"><i class="far fa-edit"></i>&nbsp;Edit Order</a>
            </div>
        </div>
    </div>
</div>
<!-- Details Header Area End -->

<div class="row mt-40">
    <div class="col-md-12 col-lg-8 col-sm-12">

        <div class="card">
            <div class="card-body">
                <div class="orderInfo_title">
                    <h4>Progress</h4>
                    <p>Current Order Status</p>
                </div>
                <div class="orderStatus_boxArea">

                    <div class="singleStatus_box active">
                        <span class="icon"><i class="icofont-spinner"></i></span>
                        <h6 class="title">Order Pending</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="icofont-spinner-alt-3"></i></span>
                        <h6 class="title">Order Processing</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="fas fa-clipboard-check"></i></span>
                        <h6 class="title">Order Complete</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="icofont-vehicle-delivery-van fz-29"></i></span>
                        <h6 class="title">Out For Delivery</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="icofont-checked"></i></span>
                        <h6 class="title">Order Delivered</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="icofont-close"></i></span>
                        <h6 class="title">Order Cancel</h6>
                        <span class="status_progress"></span>
                    </div>

                    <div class="singleStatus_box">
                        <span class="icon"><i class="icofont-undo"></i></span>
                        <h6 class="title">Order Return</h6>
                        <span class="status_progress"></span>
                    </div>

                </div><!-- orderStatus_boxArea -->
            </div>
        </div><!-- Order Status Card Area -->

        <div class="card">
            <div class="card-header space-between">
                <div class="orderInfo_title flex-1">
                    <h4>Product</h4>
                    <p>Your Shipment</p>
                </div>
                <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="<?= $order->uid ?? random_string('numeric', 10); ?>" class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export'); ?></a>
            </div>
            <div class="card-body">
                <div class="itemList">
                    <div class="table-responsive responsiveTable">
                        <table class="table orderItems_table table-bordered">
                            <thead>
                                <tr>
                                    <th><?= __('items'); ?></th>
                                    <th><?= __('qty'); ?></th>
                                    <th><?= __('price'); ?></th>
                                    <th><?= __('total'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="orderItems_tbody">
                                <?php foreach ($order->item_list as  $key => $item): ?>
                                    <tr>
                                        <td data-label="<?= __("items"); ?>">
                                            <div class="itemTopsection align-center">
                                                <div class="avatar avatar-small">
                                                    <img src="<?= avatar($item->thumb, 'item') ?>" alt="item_image">
                                                </div>
                                                <div class="itemDetails">
                                                    <h4><?= _x($item->title); ?></h4>

                                                    <?php if ($item->is_variant == 1 && isJson($item->variants)): ?>
                                                        <?php $variants = __isJson($item->variants); ?>
                                                        <span><?= isset($variants->variant_name) ? $variants->variant_name : ""; ?> </span> : <span class="text-heading"><?= isset($variants->name) ? $variants->name : ""; ?></span>
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
                                        <td data-label="<?= __("qty"); ?>">
                                            <?= $item->qty; ?>
                                        </td>
                                        <td data-label="<?= __("price"); ?>">

                                            <?php if ($item->is_variant == 1 && isJson($item->variants)): ?>
                                                <?php $variants = __isJson($item->variants); ?>
                                                <p class="f-bold"><span class="text-heading"><?= isset($variants->price) ? _currency_position($variants->price, _ID()) : ""; ?></span></p>
                                            <?php else: ?>
                                                <p class="f-bold"><?= isset($item->item_price) ? _currency_position($item->item_price, _ID()) : ""; ?></p>
                                            <?php endif; ?>

                                            <?php if (!empty($item->tax) && $item->tax != 'null' && isJson($item->tax)): ?>
                                                <?php $taxItems = []; ?>
                                                <?php foreach (__isJson($item->tax) as  $key => $tax): ?>
                                                    <?php
                                                    $taxStatus = $tax->tax_status == 'include' ? __('included') : __('excluded');
                                                    $taxItems[] = "{$tax->tax_name} {$tax->tax_percentage}% {$taxStatus}"; ?>
                                                <?php endforeach; ?>
                                                <p><small> <?= implode(', ', $taxItems); ?></small></p>
                                            <?php endif; ?>

                                        </td>
                                        <td data-label="<?= __("total"); ?>">
                                            <p class="f-bold"><?= _currency_position($item->subtotal, _ID()); ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- Order Items card -->

        <div class="card">
            <div class="card-header">
                <div class="orderInfo_title flex-1">
                    <h4>Timeline</h4>
                    <p>Track shipment progress</p>
                </div>
                <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="<?= $order->uid ?? random_string('numeric', 10); ?>" class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export'); ?></a>
            </div>
            <div class="card-body">

                <?php if ($order->is_online_payment == 1): ?>
                    <div class="timeline_infoContainer">
                        <div class="timeline_infoContent">
                            <span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                            <div class="info__title">
                                <h4><?= __('payment_method'); ?> : <label class="label bg-success"><?= __($order->payment_method); ?></h4>
                                <p class="text-success"> <?= $order->payment_status == 'paid' ? '<i class="icofont-check-alt"></i>' : '<i class="fas fa-spinner"></i>'; ?> <?= __($order->payment_status); ?></p>
                            </div>
                        </div>
                        <div class="timeline_datetime">
                            <span class="time"><?= _vfull_time(_x($order->created_at)); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($order->actions) && isJson($order->actions)): ?>
                    <?php foreach (__isJson($order->actions) as  $key => $ac): ?>
                        <div class="timeline_infoContainer">
                            <div class="timeline_infoContent">
                                <span class="icon"><i class="icofont-ui-check"></i></span>
                                <div class="info__title">
                                    <h4><?= __('order'); ?> <b class="dColor"><?= __($ac->action); ?></b> </h4>
                                    <p><?= __('status_from'); ?> <b><?= __($ac->action_by); ?></b></p>
                                </div>
                            </div>
                            <div class="timeline_datetime">
                                <span class="time"></i> <?= _vfull_time($ac->date, _ID()); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- col./ -->

    <div class="col-md-12 col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header p-10">
                <div class="orderInfo_title flex-1">
                    <h4>Payment</h4>
                    <p>Final payment amount</p>
                </div>
                <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="<?= $order->uid ?? random_string('numeric', 10); ?>" class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export'); ?></a>
            </div>
            <div class="card-body p-10">
                <div class="bg_color p-10">
                    <?= __orderDetails($order, _ID()) ?>
                </div>
            </div>
        </div><!-- Payment Info Card -->

        <?php if (!empty($order->customer_id)): ?>
            <?php $customer_info = __staff_info($order->customer_id); ?>
            <div class="card">
                <div class="card-header p-10">
                    <div class="orderInfo_title">
                        <h4>Customer</h4>
                        <p>Information Details</p>
                    </div>
                </div>
                <div class="card-body p-10">
                    <div class="bg_color p-10">

                        <div class="singleCustomerInfo">
                            <i class="fa fa-user"></i>
                            <div class="infoContent">
                                <h5>General Information</h5>
                                <ul class="infoList">
                                    <li><?= $customer_info->name ?></li>
                                    <li><?= $customer_info->email ?></li>
                                    <?php if (!empty($customer_info->phone)): ?>
                                        <li><?= $customer_info->phone ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div><!-- singleCustomerInfo -->

                        <?php if ($order->order_type == 'cod' && !empty($order->address)): ?>
                            <?php $customerAddress = __customerAddress($order->customer_id, $order->address); ?>
                            <div class="singleCustomerInfo">
                                <i class="fa fa-home"></i>
                                <div class="infoContent">
                                    <h5>Shipping Address</h5>
                                    <ul class="infoList">
                                        <?php if (is_numeric($order->address)): ?>
                                            <li>
                                                <div class="flex align-center gap-10">
                                                    <?= $customerAddress->address ?? ''; ?>
                                                    <?php if (isset($customerAddress->latitude) && !empty($customerAddress->latitude)): ?>
                                                        <div class="right">
                                                            <a href="<?= gmap_link($customerAddress->latitude, $customerAddress->longitude) ?>" target="_blank" class="ci-round-btn active"><i class="fas fa-map-marker-alt"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php else: ?>
                                            <li><?= $customerAddress->address; ?></li>
                                        <?php endif; ?>
                                        <li>
                                            <?php if ($customerAddress->address_label == 'home'): ?>
                                                <span class="text-uppercase"><?= $customerAddress->address_label ?></span>&nbsp;<i class="fas fa-house-user"></i>
                                            <?php elseif ($customerAddress->address_label == 'work'): ?>
                                                <span class="text-uppercase"><?= $customerAddress->address_label ?></span>&nbsp;<i class="fas fa-briefcase"></i>
                                            <?php else: ?>
                                                <span class="text-uppercase"><?= $customerAddress->otherslabel ?></span>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- singleCustomerInfo -->
                        <?php endif; ?>

                        <div class="singleCustomerInfo">
                            <i class="fa fa-home"></i>
                            <div class="infoContent">
                                <h5>Billing Address</h5>
                                <ul class="infoList">
                                    <li>Same as shopping address</li>
                                </ul>
                            </div>
                        </div><!-- singleCustomerInfo -->

                    </div>
                </div>
            </div><!-- Customer Info Card -->
        <?php endif; ?>
    </div>
</div><!-- row./ -->