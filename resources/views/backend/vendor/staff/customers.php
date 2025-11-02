    <div id="mainContent">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('customers'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_customer']); ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <div class="table-responsive responsiveTable">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= __('images'); ?></th>
                                            <th><?= __('name'); ?></th>
                                            <th><?= __('contact'); ?></th>
                                            <th><?= __('status'); ?></th>
                                            <th><?= __('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($customer_list as $key => $row) : ?>
                                            <tr id="hide_<?= _x($row->id); ?>">
                                                <td data-label="#"><?= $key + 1; ?></td>
                                                <td data-label="<?= __("images"); ?>">
                                                    <img src="<?= avatar($row->profile ?? '', 'profile') ?>" alt="profile" class="avatar round">
                                                </td>

                                                <td data-label="<?= __("name"); ?>">
                                                    <?= $row->name; ?>
                                                </td>

                                                <td data-label="<?= __("contact"); ?>">
                                                    <p><?= $row->email ?? ""; ?></p>
                                                    <p><?= !empty($row->phone) ? '+' . $row->dial_code . '' . $row->phone ?? "" : ""; ?></p>
                                                </td>

                                                <td data-label="<?= __("status"); ?>"> <?= __status($row->id, $row->status, 'customer_list'); ?></td>
                                                <td data-label="<?= __("action"); ?>" class="">
                                                    <div class="btnGroup">
                                                        <a href="<?= base_url("vendor/staff/reset/{$row->id}") ?>" class="btn btn-info btn-sm resetPassword" data-title="<?= __('reset_password'); ?>" data-toggle="tooltip"><i class="fa fa-lock"></i> <?= __('reset'); ?></a>
                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_customer_' . _x($row->id)]); ?>
                                                        <?= __deleteBtn(_x($row->id), 'customer_list', true); ?>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>


        <?= __header(__('add_new'), base_url('vendor/staff/add_customer'), 'add_customer'); ?>


        <div class="form-group">
            <label for=""><?= __('name'); ?></label>
            <input type="text" name="name" class="form-control" value="" placeholder="<?= __('name'); ?>">
        </div>

        <div class="form-group">
            <label for=""><?= __('phone'); ?></label>
            <div class="ci-input-group input-group-append">
                <div class="input-group">
                    <span class="d-flex">
                        <span class="fi fi-<?= country(__vsettings('country_id'))->code ?>"></span>
                        <span class="ml-5 phone_with_input"> <input type="text" name="dial_code" class="form-control" value="<?= __vsettings('dial_code'); ?>"> </span>
                    </span>
                </div>
                <input type="text" name="phone" class="form-control" value="" placeholder="<?= __('phone'); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for=""><?= __('email'); ?></label>
            <input type="text" name="email" class="form-control" value="" placeholder="<?= __('email'); ?>">
        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>



        <?php foreach ($customer_list as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('vendor/staff/add_customer'), 'edit_customer_' . _x($erow->id)); ?>

            <div class="form-group">
                <label for=""><?= __('name'); ?></label>
                <input type="text" name="name" class="form-control" value="<?= __isset($erow, 'name'); ?>">
            </div>

            <div class="form-group">
                <label for=""><?= __('phone'); ?></label>
                <div class="ci-input-group input-group-append">
                    <div class="input-group">
                        <span class="d-flex">
                            <span class="fi fi-<?= country(__vsettings('country_id'))->code ?>"></span>
                            <span class="ml-5 phone_with_input"> <input type="text" name="dial_code" class="form-control" value="<?= __isset($erow, 'dial_code'); ?>"> </span>
                        </span>
                    </div>
                    <input type="text" name="phone" class="form-control" value="<?= __isset($erow, 'phone'); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for=""><?= __('email'); ?></label>
                <input type="text" name="email" class="form-control" value="<?= __isset($erow, 'email'); ?>">
            </div>
            <?= hidden('id', __isset($erow, 'id')); ?>
            <?= __footer(); ?>
        <?php endforeach; ?>


    </div>