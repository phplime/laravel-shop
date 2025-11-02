    <div id="mainContent">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('category_list'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_category']); ?>
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
                                            <th><?= __('category_name'); ?></th>
                                            <th><?= __('status'); ?></th>
                                            <th><?= __('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($category_list as $key => $row) : ?>
                                            <tr id="hide_<?= _x($row->id); ?>">
                                                <td data-label="#"><?= $key + 1; ?></td>
                                                <td data-label="<?= __("images"); ?>">
                                                    <img src="<?= __image(_x($row->thumb), 'thumb'); ?>" alt="category_image" class="avatar round">
                                                </td>


                                                <td data-label="<?= __("category_name"); ?>">
                                                    <?= __names($row->category_names, 'category_name', true, true); ?>
                                                </td>

                                                <td data-label="<?= __("status"); ?>"> <?= __status($row->id, $row->status, $table); ?></td>
                                                <td data-label="<?= __("action"); ?>" class="">
                                                    <div class="btnGroup">
                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_category_' . _x($row->id)]); ?>
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


        <?= __header(__('add_new'), base_url('vendor/products/add_category'), 'add_category'); ?>


        <?php foreach (shop_language() as  $key => $lang) : ?>
            <div class="form-group">
                <label><?= __line('category_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                <input type="text" name="category_name[<?= $lang['slug'] ?>]" class="form-control" value="">
            </div>
        <?php endforeach; ?>


        <div class="form-group">
            <label><?= __('image'); ?> </label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>

        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>



        <?php foreach ($category_list as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('vendor/products/add_category'), 'edit_category_' . _x($erow->id)); ?>

            <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                <?php
                $category_names = [];
                foreach ($erow->category_names as $category_name_obj) {
                    $category_names[$category_name_obj->language] = $category_name_obj->category_name;
                }
                ?>
                <div class="form-group">
                    <label><?= __line('category_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <input type="text" name="category_name[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($category_names[$lang['slug']]) ? $category_names[$lang['slug']] : ''; ?>">
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