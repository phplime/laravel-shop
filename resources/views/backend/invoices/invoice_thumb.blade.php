<?php $vendor_id = isset($vendor_id) ? $vendor_id : (isset($order->vendor_id) ? $order->vendor_id : _ID()); ?>
<style>
    .receipt {
        max-width: 360px;
        margin: 0 auto;
        background-color: white !important;
        color: #000 !important;
        padding: 5px;
    }

    .receipt h1,
    .receipt h2 {
        text-align: center !important;
        margin: 0 !important;
    }

    .receipt h1 {
        font-size: 22px !important;
        font-weight: bold !important;
    }

    .receipt h2 {
        font-size: 18px !important;
        margin-bottom: 10px !important;
    }

    .receipt .address,
    .receipt .contact {
        text-align: center !important;
        margin-bottom: 5px !important;
        font-size: 14px !important;
    }

    .receipt .order-info {
        border-top: 1px dashed #ddd !important;
        padding: 5px 0 !important;
        margin: 10px 0 !important;
        font-size: 14px !important;
    }

    .receipt .items {
        margin-bottom: 15px !important;
        font-size: 14px !important;
    }

    .receipt .item-header,
    .receipt .item {
        display: flex !important;
        justify-content: space-between !important;
        padding: 3px 0 !important;
    }

    .receipt .item-header {
        padding: 5px 0 !important;
    }

    .receipt .item-qty {
        flex: 0 0 30px !important;
    }

    .receipt .item-desc {
        flex: 1 !important;
        padding: 0 10px !important;
    }

    .receipt .item-price {
        flex: 0 0 68px !important;
        text-align: right !important;
    }

    .receipt .item-size {
        font-size: 12px !important;
        color: #666 !important;
    }

    .receipt .total-section {
        border-top: 1px dashed #ddd !important;
        padding-top: 10px !important;
        font-size: 14px !important;
    }

    .receipt .total-row {
        display: flex !important;
        justify-content: space-between !important;
    }

    .receipt .footer {
        text-align: center !important;
        margin-top: 15px !important;
        font-size: 14px !important;
    }

    .receipt .bold {
        font-weight: bold !important;
    }

    .receipt .bt-1 {
        border-top: 1px dashed #ddd !important;
    }

    .receipt .bb-1 {
        border-bottom: 1px dashed #ddd !important;
    }

    .receipt .bbt-1 {
        border-top: 1px dashed #ddd !important;
        border-bottom: 1px dashed #ddd !important;
    }

    .receipt .item {
        border-bottom: .5px dashed #ddd !important;
        padding: 5px 0 !important;
        margin: 5px 0 !important;
    }

    .receipt .item:last-child {
        border: 0 !important;
    }

    .receipt .orderInfo span.bold {
        font-size: .75rem !important;
    }

    .receipt .orderInfo p>span {
        width: max-content !important;
        margin-right: 7px !important;
    }

    .receipt p.tax * {
        font-size: .65rem !important;
    }

    .receipt .extraSection {
        padding-top: 3px !important;
        margin-top: 3px !important;
    }

    .receipt .extraSection ul {
        font-size: .75rem !important;
    }

    .receipt .item-serial {
        flex: 0 0 15px !important;
    }

    .receipt p.tax {
        margin-top: -3px !important;
    }

    .receipt ul.checkoutSummary {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .receipt ul.checkoutSummary li {
        display: flex !important;
        justify-content: space-between !important;
        font-weight: normal !important;
    }

    .receipt ul.checkoutSummary li b {
        font-weight: normal !important;
    }

    .receipt ul.checkoutSummary li.total {
        font-weight: bold !important;
        border-top: 1px dashed #ddd !important;
        padding-top: 2px !important;
        margin-top: 2px !important;
    }

    .receipt ul.checkoutSummary li.total b {
        font-weight: bold !important;
    }

    .receipt small.taxName {
        font-size: 10px !important;
    }

    @media print {
        .printBtn {
            display: none !important;
        }

    }

    /*----------------------------------------------
     POS INVOICE 
    ----------------------------------------------*/
    body {
        background-color: #f9f9f9;
    }

    .posInvoice {
        max-width: 54mm;
        width: 100%;
        margin: 0 auto;
        background: #fff !important;
        color: #000 !important;
        font-family: 'Arial', sans-serif;
        font-size: 12px !important;
        line-height: 1.3;
        padding: 0;
        padding-right: 10px !important;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
        overflow-x: hidden;
        box-sizing: border-box;
    }

    .posInvoice h1,
    .posInvoice h2 {
        text-align: center !important;
        margin: 0 !important;
    }

    .posInvoice h1 {
        font-size: 16px !important;
        font-weight: bold;
    }

    .posInvoice h2 {
        font-size: 13px !important;
        margin-bottom: 5px;
    }

    .posInvoice .address,
    .posInvoice .contact {
        text-align: center;
        margin-bottom: 4px;
        font-size: 11px;
    }

    .posInvoice .order-info {
        border-top: 1px dashed #000;
        border-bottom: 1px dashed #000;
        padding: 4px 0;
        margin: 5px 0;
        font-size: 11px;
    }

    .posInvoice .items {
        margin: 5px 0;
    }

    .posInvoice .item-header,
    .posInvoice .item {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
    }

    .posInvoice .item-header {
        border-bottom: 1px dashed #000;
        font-weight: bold;
        padding-bottom: 3px;
    }

    .posInvoice .item {
        border-bottom: 1px dashed #ccc;
        padding: 3px 0;
    }

    .posInvoice .item-serial {
        width: 10%;
    }

    .posInvoice .item-desc {
        width: 55%;
        font-size: 11px;
        padding: 0 4px;
    }

    .posInvoice .item-qty {
        width: 15%;
        text-align: center;
    }

    .posInvoice .item-price {
        width: 20%;
        text-align: right;
    }

    .posInvoice .item-size,
    .posInvoice .extraSection {
        font-size: 10px;
        color: #555;
        margin-top: 2px;
    }

    .posInvoice .extraSection ul {
        padding-left: 10px;
        margin: 0;
    }

    .posInvoice .extraSection li {
        display: flex;
        justify-content: space-between;
    }

    .posInvoice .total-section {
        border-top: 1px dashed #000;
        padding-top: 5px;
        margin-top: 5px;
        font-size: 11px;
    }

    .posInvoice ul.checkoutSummary {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .posInvoice ul.checkoutSummary li {
        display: flex;
        justify-content: space-between;
        padding: 1px 0;
    }

    .posInvoice ul.checkoutSummary li.total {
        border-top: 1px dashed #000;
        margin-top: 5px;
        padding-top: 3px;
        font-weight: bold;
    }

    .posInvoice .orderInfo {
        font-size: 11px;
        margin-top: 5px;
        padding-top: 5px;
        border-top: 1px dashed #000;
    }

    .posInvoice .orderInfo p {
        margin: 0;
        display: flex;
        justify-content: space-between;
    }

    .posInvoice .footer {
        text-align: center;
        font-size: 10px;
        margin-top: 8px;
        border-top: 1px dashed #000;
        padding-top: 5px;
    }

    ul.CheckoutSummaryUl {
        list-style: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
        padding-left: 0;
    }

    ul.CheckoutSummaryUl li {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
    }

    @media print {
        .printBtn {
            display: none !important;
        }
    }
</style>

</style>


<div class="receipt">
    <h1><?= _vendor('app_name', $vendor_id); ?></h1>
    <div class="address">
        <?= _vendor('address', $vendor_id); ?>
    </div>
    <div class="contact"><?= _vendor('phone', $vendor_id); ?></div>

    <div class="order-info">
        <div> #<?= _x($order->uid); ?></div>
        <div><?= _vfull_time($order->created_at, $vendor_id); ?></div>
    </div>

    <div class="items">
        <div class="item-header bbt-1">
            <div class="item-qty">#</div>

            <div class="item-desc"><?= __('items'); ?></div>
            <div class="item-qty"><?= __('qty'); ?></div>
            <div class="item-price"><?= __('price'); ?></div>
        </div>
        <?php foreach ($order->item_list as  $key => $item): ?>
            <div class="item">
                <div class="item-serial"><?= $key + 1; ?></div>
                <div class="item-desc">
                    <?= _x($item->title); ?>
                    <?php if (isJson($item->tax)): ?>
                        <?php $taxItems = []; ?>
                        <?php foreach (__isJson($item->tax) as  $key => $tax): ?>
                            <?php
                            $taxStatus = $tax->tax_status == 'include' ? __('included') : __('excluded');
                            $taxItems[] = "{$tax->tax_name} {$tax->tax_percentage}% {$taxStatus}"; ?>
                        <?php endforeach; ?>
                        <p class="tax"><small> <?= implode(', ', $taxItems); ?></small></p>
                    <?php endif; ?>
                    <div class="item-size">
                        <?php if ($item->is_variant == 1 && isJson($item->variants)): ?>
                            <?php $variants = __isJson($item->variants); ?>
                            <p class="mt-2"><span><?= isset($variants->variant_name) ? $variants->variant_name : ""; ?> </span> : <span class="text-heading"><?= isset($variants->name) ? $variants->name : ""; ?></span> <span><?= __('price'); ?> </span> <span class="text-heading"><?= isset($variants->price) ? _currency_position($variants->price, _ID()) : ""; ?></span></p>
                        <?php else: ?>
                            <p class="mt-2 hidden"><span><?= __('price'); ?>: <?= isset($item->item_price) ? _currency_position($item->item_price, _ID()) : ""; ?></span> </p>
                        <?php endif; ?>
                    </div>
                    <?php if ($item->is_extras == 1 && isJson($item->extras)): ?>
                        <div class="extraSection bt-1">
                            <ul>
                                <?php foreach (__isJson($item->extras) as  $key => $extra): ?>
                                    <li><span><?= isset($extra->ex_qty) ? $extra->ex_qty : 1; ?> x <?= __exName($extra->ex_id); ?> (<?= isset($extra->ex_price) ? $extra->ex_price : 0; ?>) </span> = <span class="text-heading"> <?= _currency_position($extra->ex_qty * $extra->ex_price, $vendor_id) ?></span></li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="item-qty"><?= $item->qty; ?></div>
                <div class="item-price"><?= _currency_position($item->subtotal, $vendor_id); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="total-section bb-1 pb-7 mb-7">
        <div class="total-row">
            <?= __orderDetails($order, _ID()) ?>
        </div>
    </div>

    <div class="orderInfo bb-1 pb-7 mb-7">
        <p><span><?= __('order_type'); ?>:</span> <span class="bold"><?= __($order->order_type); ?></span></p>
        <p><span><?= __('payment_status'); ?>:</span> <span class="bold"><?= __('paid'); ?></span></p>
        <?php if ($order->order_type == 'cod' && !empty($order->address)): ?>
            <?php $customerAddress = __customerAddress($order->customer_id, $order->address); ?>
            <?php if (is_numeric($order->address)): ?>
                <p><span><?= __('delivery_address'); ?>:</span> <span class="bold"><?= $customerAddress->address ?? ''; ?></span></p>
            <?php else: ?>
                <p><span><?= __('delivery_address'); ?>:</span> <span class="bold"><?= $order->address; ?></span></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class=" orderInfo bb-1 pb-7">
        <p><span><?= __('customer'); ?></span> </p>
        <div class="customerInfo">
            <?php if (!empty($row->customer_id)): ?>
                <?php $customer_info = __staff_info($row['customer_id']); ?>
                <?php if (isset($customer_info->profile) && !empty($customer_info->profile)) ?>
                <img src="<?= avatar($customer_info->profile, 'profile') ?>" class="avatar" alt="avatar">
            <?php endif; ?>
            <?= __get_customer_details($order, 'html', false);
            ?>
        </div>
    </div>

    <div class="footer">
        <p><?= __('thank_you'); ?></p>
        <div class="poweredBy d-flex flex-column mt-10">
            <small class="" style="align-self: flex-end;"><?= __('powered_by'); ?></small>
            <p><?= __settings('app_name', $vendor_id); ?></p>
        </div>
    </div>

</div>