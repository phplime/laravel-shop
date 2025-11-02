    <div id="mainContent">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?= __('subcategory_list'); ?></h5>
                        <div class="card-tools">
                            <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_subcategory']); ?>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="card-content">
                            <div class="table-responsive">

                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= __('category_name'); ?></th>
                                            <th><?= __('subcategories'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($subcategory_list as  $key => $row) : ?>
                                            <tr>
                                                <td><?= $key + 1; ?></td>
                                                <td>
                                                    <img src="<?= __image(_x($row->category_img), 'thumb'); ?>" alt="category_image" class="avatar round mr-10">

                                                    <div class="mt-10">
                                                        <?php $catdata = langData($row->category_id, 'category_id', 'vendor_category_list_ln') ?>

                                                        <div class="catName">
                                                            <?= isset($catdata) && !empty($catdata) ? __names($catdata, 'category_name', true) : ''; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><?= __('images'); ?></th>
                                                                <th><?= __('subcategory_name'); ?></th>
                                                                <th><?= __('status'); ?></th>
                                                                <th><?= __('action'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($row->subcategories as $key => $sub) : ?>
                                                                <tr id="hide_<?= _x($sub->id); ?>">
                                                                    <td><?= $key + 1; ?></td>
                                                                    <td>
                                                                        <img src="<?= __image(_x($sub->thumb), 'thumb'); ?>" alt="category_image" class="avatar round">
                                                                    </td>

                                                                    <td>

                                                                        <?php $scatdata = langData($sub->id, 'subcategory_id', 'vendor_subcategory_list_ln') ?>

                                                                        <div class="catName">
                                                                            <?= isset($catdata) && !empty($catdata) ? __names($scatdata, 'subcategory_name', true) : ''; ?>
                                                                        </div>

                                                                    </td>

                                                                    <td> <?= __status($sub->id, $sub->status, $table); ?></td>
                                                                    <td class="">
                                                                        <div class="btnGroup">
                                                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_subcategory_' . _x($sub->id)]); ?>
                                                                            <?= __deleteBtn(_x($sub->id), $table, true); ?>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>





                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>


        <?= __header(__('add_new'), base_url('vendor/products/add_subcategory'), 'add_subcategory'); ?>
        <div class="form-group">
            <label><?= __('category_name'); ?> <?= __required(); ?></label>
            <select name="category_id" id="category_id" class="form-control">
                <option value=""><?= __('select'); ?></option>
                <?php foreach ($category_list as  $key => $category) : ?>
                    <option value="<?= _x($category->id) ?>"><?= _x(__names($category->category_names, 'category_name', false)); ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <?php foreach (shop_language() as  $key => $lang) : ?>
            <div class="form-group">
                <label><?= __line('subcategory_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                <input type="text" name="subcategory_name[<?= $lang['slug'] ?>]" class="form-control" value="">
            </div>
        <?php endforeach; ?>



        <div class="form-group">
            <label><?= __('image'); ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', ''); ?>
            </div>

        </div>
        <?= hidden('id', 0); ?>
        <?= __footer(); ?>


        <?php foreach ($subcategories as $key => $erow) : ?>
            <?= __header(__('edit'), base_url('vendor/products/add_subcategory'), 'edit_subcategory_' . _x($erow->id)); ?>

            <div class="form-group">
                <label><?= __('category_name'); ?> <?= __required(); ?></label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value=""><?= __('select'); ?></option>
                    <?php foreach ($category_list as  $key => $category) : ?>
                        <option value="<?= _x($category->id) ?>" <?= __checked($category->id, $erow->category_id, 'selected'); ?>><?= _x(__names($category->category_names, 'category_name', false)); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
                $datalag = langData($erow->id, 'subcategory_id', 'vendor_subcategory_list_ln'); 
               
             ?>
            <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                <?php
                $category_names = [];
                if (!empty($datalag)) :
                    foreach ($datalag as $category_name_obj) {
                        $category_names[$category_name_obj->language] = $category_name_obj->subcategory_name;
                    }
                endif;
                ?>
                <div class="form-group">
                    <label><?= __line('subcategory_name', $lang['slug']); ?> <?= country($lang['country_id'])->flag; ?></label>
                    <input type="text" name="subcategory_name[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($category_names[$lang['slug']]) ? $category_names[$lang['slug']] : ''; ?>">
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