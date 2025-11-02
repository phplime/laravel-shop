<div class="row">
    <?php $this->load->view('backend/settings/inc/settings_menu.php', ['col' => 'col-lg-12']); ?>
    <div class="<?= __settings('menu_style') == 1 ? "col-lg-8" : "col-lg-8"; ?> col-xs-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= __('payment_method'); ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <th>#</th>
                        <th><?= __('name'); ?></th>
                        <th><?= __('keyword'); ?></th>
                        <th><?= __('status'); ?></th>
                        <th><?= __('action'); ?></th>

                        <tbody>
                            <?php foreach ($all_payment as $key => $row) { ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row->title; ?></td>
                                    <td><?= $row->slug; ?></td>
                                    <td> <?= __status($row->id, $row->status, 'payment_gateway_list'); ?></td>
                                    <td class="">
                                        <div class="btnGroup">
                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_category_' . _x($row->id)]); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <form action="<?= base_url("payment/add_payment_config") ?>" method="post">
            <?php csrf(); ?>
            <?php foreach ($payment_list as $key => $row) : ?>
                <?php $payment_config = $this->default_m->single_select_by_slug($row->slug, 'payment_gateway_list'); ?>
                <?php
                $file_path = VIEWPATH . "backend/payment/{$row->slug}_thumb.php";
                if (file_exists($file_path)) {
                    include_once $file_path;
                }
                ?>
            <?php endforeach; ?>

            <div class="card">
                <button class="btn btn-block btn-primary" type="submit"><?= __('save_change'); ?></button>
            </div>
        </form>

    </div>
</div>