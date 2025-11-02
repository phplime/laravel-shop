<div id="mainContent">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><a href="<?= base_url("vendor/settings/order_types") ?>" class="backBtn"><i class="fas fa-chevron-left"></i></a> <?= lang($type); ?></h4>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"><?= lang('table_list'); ?></h5>
                    <?php if (isset($table_area_list) && sizeof($table_area_list) > 0) : ?>
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'table_list']); ?>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('name'); ?></th>
                                    <th><?= __('size'); ?></th>
                                    <th><?= __('area_name'); ?></th>
                                    <th><?= __('status'); ?></th>
                                    <th><?= __('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($table_list as  $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= _x($row->table_name) ?></td>
                                        <td><?= _x($row->size) ?></td>
                                        <td><?= _x(__single($row->table_area_id, 'vendor_table_area_list')->area_name ?? '') ?></td>
                                        <td> <?= __status($row->id, $row->status, 'vendor_table_list'); ?></td>
                                        <td class="btnGroup">
                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'table_list_' . $row->id]); ?>
                                            <?= __deleteBtn($row->id, 'vendor_table_list', true); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card -->

        </div><!-- col-6 -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('table_area'); ?></h5>
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'table_area_list']); ?>
                </div>
                <div class="card-body p-0">
                    <div class="areaBased table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('area_name'); ?></th>
                                    <th><?= __('status'); ?></th>
                                    <th><?= __('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($table_area_list as  $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= _x($row->area_name) ?></td>
                                        <td> <?= __status($row->id, $row->status, 'vendor_table_area_list'); ?></td>
                                        <td class="btnGroup">
                                            <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'area_' . $row->id]); ?>
                                            <?= __deleteBtn($row->id, 'vendor_table_area_list', true); ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- col-5 -->
    </div><!-- row -->


    <!----------------------------------------------
                TABLE AREA
---------------------------------------------->

    <?= __header(__('add_new'), base_url('vendor/settings/add_table_area'), 'table_area_list'); ?>
    <?= csrf(); ?>
    <div class="form-group">
        <label><?= __('area_name'); ?></label>
        <input type="text" name="area_name" id="area_name" class="form-control" placeholder="<?= __('area_name'); ?>">
    </div>

    <?= hidden('id', 0); ?>
    <?= __footer(); ?>


    <?php foreach ($table_area_list as  $key => $t) : ?>
        <?= __header(__('edit'), base_url('vendor/settings/add_table_area'), 'area_' . $t->id); ?>
        <div class="form-group">
            <label><?= __('area_name'); ?></label>
            <input type="text" name="area_name" id="area_name" class="form-control" value="<?= __isset($t, 'area_name'); ?>">
        </div>
        <?= hidden('id', __isset($t, 'id', true)); ?>
        <?= __footer(); ?>

    <?php endforeach; ?>

    <!----------------------------------------------
            Table List
---------------------------------------------->

    <?= __header(__('add_new'), base_url('vendor/settings/add_table'), 'table_list'); ?>
    <?= csrf(); ?>
    <div class="form-group">
        <label><?= __('name'); ?></label>
        <input type="text" name="table_name" id="table_name" class="form-control">
    </div>
    <div class="form-group">
        <label><?= __('size'); ?></label>
        <input type="number" name="size" id="size" class="form-control only_number" value="<?= __isset($data, 'size'); ?>">
    </div>

    <div class="form-group">
        <label><?= __('area_name'); ?></label>
        <select name="area_id" class="form-control" id="area_id">
            <option value=""><?= __('select'); ?></option>
            <?php foreach ($table_area_list as  $key => $tb) : ?>
                <?php if ($tb->status == 1): ?>
                    <option value="<?= $tb->id; ?>"><?= $tb->area_name; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <?= hidden('id',  0); ?>
    <?= __footer(); ?>




    <?php foreach ($table_list as  $key => $table) : ?>
        <?= __header(__('edit'), base_url('vendor/settings/add_table'), 'table_list_' . $table->id); ?>
        <?= csrf(); ?>
        <div class="form-group">
            <label><?= __('name'); ?></label>
            <input type="text" name="table_name" id="table_name" class="form-control" value="<?= __isset($table, 'table_name'); ?>">
        </div>
        <div class="form-group">
            <label><?= __('size'); ?></label>
            <input type="number" name="size" id="size" class="form-control only_number" value="<?= __isset($table, 'size'); ?>">
        </div>

        <div class="form-group">
            <label><?= __('area_name'); ?></label>
            <select name="area_id" class="form-control" id="area_id">
                <option value=""><?= __('select'); ?></option>
                <?php foreach ($table_area_list as  $key => $tb) : ?>
                    <option value="<?= $tb->id; ?>" <?= __checked($tb->id, $table->table_area_id, 'selected'); ?>><?= $tb->area_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?= hidden('id',  __isset($table, 'id', true)); ?>
        <?= __footer(); ?>

    <?php endforeach; ?>





</div>