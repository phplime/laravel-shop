    <div id="mainContent">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('services'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_services']); ?>
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
                                            <th><?= __('description'); ?></th>
                                            <th><?= __('status'); ?></th>
                                            <th><?= __('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($service_list as $key => $row) : ?>
                                            <tr id="hide_<?= _x($row->id); ?>">
                                                <td><?= $key + 1; ?></td>
                                                <td>
                                                    <img src="<?= __image(_x($row->image), 'thumb'); ?>" alt="category_image" class="avatar round">
                                                </td>

                                                <td>
                                                    <?= __names($row->_names, 'title', true); ?>
                                                </td>

                                                <td>
                                                    <?= __names($row->_names, 'description', true); ?>
                                                </td>

                                                <td> <?= __status($row->id, $row->status, $table); ?></td>
                                                <td class="">
                                                    <div class="btnGroup">
                                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_service_' . _x($row->id)]); ?>
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


        <?= __header(__('add_new'), base_url('admin/home/add_services'), 'add_services'); ?>


        <?php foreach (shop_language() as  $key => $lang) : ?>
            <div class="form-group">
                <label><?= __('title'); ?> <?= country($lang['country_id'])->flag; ?></label>
                <input type="text" name="title[<?= $lang['slug'] ?>]" class="form-control" value="">
            </div>

            <div class="form-group">
                <label><?= __('description'); ?> <?= country($lang['country_id'])->flag; ?></label>
                <textarea name="description[<?= $lang['slug'] ?>]" class="form-control dataTextarea"></textarea>
            </div>
            <hr>
        <?php endforeach; ?>


        <div class="form-group">
            <label><?= __('image'); ?> <?= __get('site_lang'); ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>

        </div>
        <?= hidden('id', isset($data->id) ? $data->id : 0); ?>
        <?= __footer(); ?>


        <?php foreach ($service_list as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('admin/home/add_services'), 'edit_service_' . _x($erow->id)); ?>
            <?php $datalag = isset($erow->_names) ? $erow->_names : []; ?>
            <?php foreach (shop_language() as $lang_key => $lang) : ?>
                <?php
                $_details = [];
                if (!empty($datalag)) :
                    foreach ($datalag as $name_obj) {
                        if ($name_obj->language === $lang['slug']) {
                            $_details = [
                                'title' => $name_obj->title,
                                'description' => $name_obj->description,
                            ];
                        }
                    }
                endif;
                ?>
                <div class="form-group">
                    <label><?= __('title'); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <input type="text" name="title[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($_details['title']) ? _x($_details['title']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label><?= __('description'); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <textarea name="description[<?= $lang['slug'] ?>]" class="form-control dataTextarea"><?= isset($_details['description']) ? $_details['description'] : ''; ?></textarea>
                </div>
            <?php endforeach; ?>

            <div class="form-group">
                <label><?= __('image'); ?></label>
                <div class="mb-4">
                    <?= media_files('image', 'single', __isset($erow, 'image')); ?>
                </div>
            </div>

            <?= hidden('id', __isset($erow, 'id')); ?>
            <?= __footer(); ?>
        <?php endforeach; ?>



    </div>