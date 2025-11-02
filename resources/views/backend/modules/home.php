<div class="moduleArea">
    <div class="row">
        <div class="col-md-12">
            <ul class="moudleUl">
                <li class="hidden"><a href="#orderTypesModal" data-toggle="modal" class="btn btn-sm bg-soft-info"><?= __('order_types'); ?></a></li>
                <li class="hidden"><a href="#moduleFeatureListModal" data-toggle="modal" class="btn btn-sm bg-soft-primary"><?= __('module_feature'); ?></a></li>
                <li><a href="#addModuleModal" data-toggle="modal" class="btn btn-sm bg-soft-primary"><i class="fa fa-plus"></i> <?= __('add_module'); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <?php foreach ($module_list as $key => $row): ?>
            <div class="col-md-3">
                <div class="singleModule">
                    <div class="module-body">
                        <?= __status($row->id, $row->status, 'module_list'); ?>
                        <div class="iconArea">
                            <img src="<?= base_url("app/assets/backend/images/modules/{$row->slug}.svg"); ?>" alt="<?= $row->slug; ?>">
                        </div>
                        <div class="moduleDetails">
                            <h4><?= $row->title; ?></h4>
                        </div>
                    </div>
                    <div class="module-footer hidden">
                        <ul>
                            <li><a href=""><i class="fa fa-users"></i></a></li>
                            <li><a href=""><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>
</div>


<hr>
<div class="row mt-50">
    <div class="col-md-6">
        <div class="header mb-10">
            <h4><?= __('order_types'); ?></h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('title'); ?></th>
                                <th><?= __('slug'); ?></th>
                                <th><?= __('status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_type_list as $key => $row) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row->title; ?></td>
                                    <td><?= $row->slug; ?></td>
                                    <td><label class="badge badge-soft-primary"><?= $row->status == 1 ? "Live" : "Hide"; ?></label></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
            </div>
        </div>
        <!-- /.table-responsive -->
    </div>

    <div class="col-md-6">
        <div class="header mb-10">
            <h4><?= __('features'); ?></h4>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= __('title'); ?></th>
                            <th><?= __('slug'); ?></th>
                            <th><?= __('status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($module_feature_list as $key => $row) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $row->feature_name; ?></td>
                                <td><?= $row->slug; ?></td>
                                <td><label class="badge badge-soft-primary"><?= $row->status == 1 ? "Live" : "Hide"; ?></label></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->




<div class="modal fade" id="moduleFeatureListModal">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/module/add_module_features') ?>" method="post">
            <?= csrf(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __('module_feature_list'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="title">
                    </div>

                    <div class="form-group">
                        <input type="text" name="slug" class="form-control" placeholder="slug">
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="modal-footer">
                    <?= hidden('id', 0); ?>
                    <button type="submit" class="btn btn-primary"><?= __('submit'); ?></button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="orderTypesModal">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/module/add_order_types') ?>" method="post">
            <?= csrf(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= lang('order_types'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="title">
                    </div>

                    <div class="form-group">
                        <input type="text" name="slug" class="form-control" placeholder="slug">
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="modal-footer">
                    <?= hidden('id', 0); ?>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $module_feature_list = $this->default_m->select_result('module_feature_list'); ?>
<?php $order_type_list = $this->default_m->select_result('order_type_list'); ?>
<div class="modal fade" id="addModuleModal">
    <div class="modal-dialog" role="document">
        <?= __startForm(base_url('admin/module/add_module'), 'post') ?>
        <?= csrf(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= __('add_module'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="title">
                </div>

                <div class="form-group">
                    <input type="text" name="slug" class="form-control slug" placeholder="slug">
                </div>

                <div class="form-group">
                    <div class="mb-10">
                        <label>Module Feature</label>
                    </div>
                    <!-- /. -->
                    <?php foreach ($module_feature_list as $key => $feature): ?>
                        <label class="custom-checkbox mr-5"> <input type="checkbox" name="features_ids[]" value="<?= $feature->id; ?>">
                            <?= $feature->feature_name; ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <div class="mb-10">
                        <label>Order Types</label>
                    </div>
                    <?php foreach ($order_type_list as $key => $order_type): ?>
                        <label class="custom-checkbox mr-5"> <input type="checkbox" name="order_type_ids[]" value="<?= $order_type->id; ?>">
                            <?= $order_type->title; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="modal-footer">
                <?= hidden('id', 0); ?>
                <button type="submit" class="btn btn-primary"><?= __('submit'); ?></button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->