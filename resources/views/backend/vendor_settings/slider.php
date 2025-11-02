<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-9']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-9" : "col-lg-8 "; ?> col-xs-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= __('slider'); ?></h5>
                <div class="card-tools">
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_slider']); ?>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= __('image'); ?></th>
                            <th><?= __('title'); ?></th>
                            <th><?= __('status'); ?></th>
                            <th><?= __('action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slider_list as  $key => $row) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td>
                                    <img src="<?= __image(_x($row->image), 'thumb'); ?>" alt="allergen_image" class="avatar round">
                                </td>
                                <td>
                                    <?= _x($row->title); ?>
                                </td>

                                <td> <?= __status($row->id, $row->status, 'vendor_slider_list'); ?></td>
                                <td class="">
                                    <div class="btnGroup">
                                        <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_slider_' . _x($row->id)]); ?>
                                        <?= __deleteBtn(_x($row->id), 'vendor_slider_list', true); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<?= __header(__('add_new'), base_url('vendor/settings/add_slider'), 'add_slider'); ?>

<div class="form-group">
    <label><?= __('title'); ?></label>
    <input type="text" name="title" class="form-control" value="">
</div>

<div class="form-group">
    <label><?= __('image'); ?></label>
    <div class="mb-4">
        <?= media_files('image', 'single', ''); ?>
    </div>

</div>
<?= hidden('id', 0); ?>
<?= __footer(); ?>


<?php foreach ($slider_list as $key => $erow) : ?>
    <?= __header(__('edit'), base_url('vendor/settings/add_slider'), 'edit_slider_' . _x($erow->id)); ?>

    <div class="form-group">
        <label><?= __('title'); ?></label>
        <input type="text" name="title" class="form-control" value="<?= __isset($erow, 'title') ?>">
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