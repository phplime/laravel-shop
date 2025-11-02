<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-8']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-8" : "col-lg-8 "; ?> col-xs-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= __('payment_list'); ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive responsiveTable">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th><?= __('name'); ?></th>
                            <th><?= __('keyword'); ?></th>
                            <th><?= __('status'); ?></th>
                        </thead>

                        <tbody>
                            <?php foreach ($all_payment as $key => $row) { ?>
                                <tr>
                                    <td data-label="#"><?= $key + 1; ?></td>
                                    <td data-label="<?= __('name'); ?>"><?= $row->title; ?></td>
                                    <td data-label="<?= __('keyword'); ?>"><?= $row->slug; ?></td>
                                    <td data-label="<?= __('status'); ?>"> <?= __status($row->id, $row->status, 'payment_gateway_list'); ?></td>

                                </tr>
                            <?php }; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>



        <?= __startForm(base_url('payment/add_payment_config'), 'post'); ?>
        <?= csrf(); ?>
        <?php foreach ($payment_list as $key => $row) : ?>
            <?php $payment_config = $this->default_m->single_select_by_slug_auth($row->slug, auth('id'), 'vendor_payment_list'); ?>
            <?php
            $file_path = VIEWPATH . "backend/payment/{$row->slug}_thumb.php";
            if (file_exists($file_path)) {
                include_once $file_path;
            }
            ?>
        <?php endforeach; ?>

        <div class="card">
            <?= __hidden('user_id', auth('id')); ?>
            <?= __hidden('vendor_id', _ID()); ?>
            <button class="btn btn-block btn-primary" type="submit"><?= __('save_change'); ?></button>
        </div>
        <?= __endForm() ?>

    </div>
</div>