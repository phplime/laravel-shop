

<?php if ($row->order_type == 'cod' && in_array($row->status, ['complete', 'out_for_delivery', 'delivered'])): ?>

	<option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('out_for_delivery')) ?>?q=live" <?= isset($row->status) && $row->status == 'out_for_delivery' ? "selected" : ""; ?>><?= __('out_for_delivery'); ?></option>

	<option value="<?= base_url("vendor/order/status/{$row->uid}/" . Orders::status('delivered')) ?>?q=live" <?= isset($row->status) && $row->status == 'delivered' ? "selected" : ""; ?>><?= __('delivered'); ?></option>


<?php endif; ?>

<option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('returned')) ?>?q=live" <?= isset($order->status) && $order->status == 'returned' ? "selected" : ""; ?>><?= __('returned'); ?></option>
<option value="<?= base_url("vendor/order/status/{$order->uid}/" . Orders::status('cancel')) ?>?q=live" <?= isset($order->status) && $order->status == 'cancel' ? "selected" : ""; ?>><?= __('cancel'); ?></option>