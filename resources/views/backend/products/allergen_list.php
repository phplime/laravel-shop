    <div id="mainContent">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('allergen_list'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_allergen']); ?>
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
                                            <th><?= __('category_name'); ?></th>
                                            <th><?= __('status'); ?></th>
                                            <th><?= __('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allergen_list as $key => $row) : ?>
                                            <tr id="hide_<?= _x($row->id); ?>">
                                                <td><?= $key + 1; ?></td>
                                                <td>
                                                    <img src="<?= __image(_x($row->thumb), 'thumb'); ?>" alt="allergen_image" class="avatar round">
                                                </td>

                                                <td>
                                                    <?= __names($row->_names, 'allergen_name', true); ?>
                                                </td>

                                                <td> <?= __status($row->id, $row->status, 'vendor_allergen_list'); ?></td>
                                                <td class="">
                                                    <div class="btnGroup">
                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_allergen_' . _x($row->id)]); ?>
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


        <?= __header(__('add_new'), base_url('vendor/products/add_allergen'), 'add_allergen'); ?>


        <?php foreach (shop_language() as  $key => $lang) : ?>
            <div class="form-group">
                <label> <?= __line('allergen_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                <input type="text" name="allergen_name[<?= $lang['slug'] ?>]" class="form-control" value="">
            </div>
        <?php endforeach; ?>


        <div class="form-group">
            <label><?= __('image'); ?> <?= __get('site_lang'); ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>

        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>



        <?php foreach ($allergen_list as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('vendor/products/add_allergen'), 'edit_allergen_' . _x($erow->id)); ?>

            <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                <?php
                $allergen_names = [];
                foreach ($erow->_names as $name_obj) {
                    $allergen_names[$name_obj->language] = $name_obj->allergen_name;
                }
                ?>
                <div class="form-group">
                    <label><?= __line('allergen_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <input type="text" name="allergen_name[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($allergen_names[$lang['slug']]) ? $allergen_names[$lang['slug']] : ''; ?>">
                </div>
            <?php endforeach; ?>

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