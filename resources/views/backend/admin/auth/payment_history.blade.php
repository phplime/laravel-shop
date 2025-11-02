<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= __('payment_list'); ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('subscriber'); ?></th>
                                <th><?= __('amount'); ?></th>
                                <th><?= __('payment_date'); ?></th>
                                <th><?= __('payment_method'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as  $key => $payment) { ?>
                                <?php if (!empty($payment->username)): ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><a href="<?= base_url("admin/auth/vsubscriber/{$payment->username}") ?>" class="dcolor"><?= !empty($payment->name) ? _x($payment->name) : _x($payment->username); ?></a></td>
                                        <td><?= _x($payment->total_amount); ?></td>
                                        <td><?= !empty($payment->payment_date) ? full_time($payment->payment_date) : ''; ?></td>
                                        <td><?= _x($payment->method); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>