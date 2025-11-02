    <div id="mainContent">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('addon_list'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add']); ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= __('images'); ?></th>
                                            <th><?= __('title'); ?></th>
                                            <th><?= __('price'); ?></th>
                                            <th><?= __('max_quantity'); ?></th>
                                            <th><?= __('status'); ?></th>
                                            <th><?= __('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($addon_list as $key => $row) : ?>
                                            <tr id="hide_<?= _x($row->id); ?>">
                                                <td><?= $key + 1; ?></td>
                                                <td>
                                                    <img src="<?= __image(_x($row->thumb), 'thumb'); ?>" alt="allergen_image" class="avatar round">
                                                </td>

                                                <td>
                                                    <?= __names($row->_names, 'addon_name', true); ?>
                                                </td>
                                                <td>
                                                    <?= _currency_position($row->price, _ID()) ?>
                                                </td>
                                                <td><?= $row->max_select_qty == 0 ? '&#8734;' : $row->max_select_qty ?? 0; ?></td>

                                                <td> <?= __status($row->id, $row->status, 'vendor_addon_library'); ?></td>
                                                <td class="">
                                                    <div class="btnGroup">
                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_' . _x($row->id)]); ?>
                                                        <?= __deleteBtn(_x($row->id), $table, true); ?>
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


        <?= __header(__('add_new'), base_url('vendor/products/add_addons'), 'add'); ?>


        <?php foreach (shop_language() as  $key => $lang) : ?>
            <div class="form-group">
                <label><?= __line('addon_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                <input type="text" name="addon_name[<?= $lang['slug'] ?>]" class="form-control" value="">
            </div>
        <?php endforeach; ?>

        <div class="form-group ">
            <label><?= __('price'); ?></label>
            <div class="ci-input-group input-group-prepand">
                <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price'); ?>" value="">
                <div class="input-group">
                    <span>
                        <?= __vcountry()->currency_icon; ?>
                    </span>
                </div>
            </div>


        </div>


        <div class="form-group">
            <label><?= __('max_quantity'); ?></label>
            <input type="number" name="max_select_qty" class="form-control only_number" value="0">
        </div>

        <div class="form-group">
            <label><?= __('image'); ?> <?= __get('site_lang'); ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>

        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>



        <?php foreach ($addon_list as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('vendor/products/add_addons'), 'edit_' . _x($erow->id)); ?>

            <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                <?php
                $names = [];
                foreach ($erow->_names as $name_obj) {
                    $names[$name_obj->language] = $name_obj->addon_name;
                }
                ?>
                <div class="form-group">
                    <label><?= __line('addon_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <input type="text" name="addon_name[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($names[$lang['slug']]) ? $names[$lang['slug']] : ''; ?>">
                </div>
            <?php endforeach; ?>

            <div class="form-group ">
                <label><?= __('price'); ?></label>
                <div class="ci-input-group input-group-prepand">
                    <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price'); ?>" value="<?= __isset($erow, 'price', 0); ?>">
                    <div class="input-group">
                        <span>
                            <?= __vcountry()->currency_icon; ?>
                        </span>
                    </div>
                </div>


            </div>

            <div class="form-group">
                <label><?= __('max_quantity'); ?></label>
                <input type="number" name="max_select_qty" class="form-control only_number" value="<?= __isset($erow, 'max_select_qty', 0); ?>">
            </div>

            <div class="form-group">
                <label><?= __('image'); ?></label>
                <div class="mb-4">
                    <?= media_files('image', 'single', __isset($erow, 'thumb')); ?>
                </div>

            </div>
            <?= hidden('id', __isset($erow, 'id')); ?>
            <?= __footer(); ?>
        <?php endforeach; ?>


    </div>