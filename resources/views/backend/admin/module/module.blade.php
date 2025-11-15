@extends('backend.admin.layouts.app')
@section('content')
    <div class="moduleArea">
        <div class="row">
            <div class="col-md-12">
                <ul class="moudleUl">
                    <li class="hidden"><a href="#orderTypesModal" data-toggle="modal"
                            class="btn btn-sm bg-soft-info"><?= __('order_types') ?></a></li>
                    <li class="hidden"><a href="#moduleFeatureListModal" data-toggle="modal"
                            class="btn btn-sm bg-soft-primary"><?= __('module_feature') ?></a></li>
                    <li><a href="#addModuleModal" data-toggle="modal" class="btn btn-sm bg-soft-primary"><i
                                class="fa fa-plus"></i> <?= __('add_module') ?></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php foreach ($module_list as $key => $row): ?>
            <div class="col-md-3">
                <div class="singleModule">
                    <div class="module-body">
                        <?= __status($row->id, $row->status, 'module_list') ?>
                        <div class="iconArea">
                            <img src="<?= asset("assets/backend/modules/{$row->slug}.svg") ?>"
                            alt="<?= $row->slug ?>">
                        </div>
                        <div class="moduleDetails">
                            <h4><?= $row->title ?></h4>
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
            <div class="card">
                <div class="card-header mb-10">
                    <h4><?= __('order_types') ?></h4>
                    <?= __addBtn('', '', ['is_modal' => 1, 'target' => 'orderTypesModal']) ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('title') ?></th>
                                    <th><?= __('slug') ?></th>
                                    <th><?= __('status') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_type_list as $key => $ordertype) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $ordertype->title ?></td>
                                    <td><?= $ordertype->slug ?></td>
                                    <td> <?= __status($ordertype->id, $ordertype->status, 'order_type_list') ?>
                                    </td>
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
            <div class="card">
                <div class="card-header">
                    <h4><?= __('module_feature_list') ?></h4>
                    <?= __addBtn('', '', ['is_modal' => 1, 'target' => 'featureListModal']) ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('title') ?></th>
                                <th><?= __('slug') ?></th>
                                <th><?= __('status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($module_feature_list as $key => $modulefeature) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $modulefeature->title ?></td>
                                <td><?= $modulefeature->slug ?></td>
                                <td>
                                    <?= __status($modulefeature->id, $modulefeature->status, 'module_feature_list') ?>
                                </td>
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




    <div class="modal fade customModal" id="featureListModal">
        <div class="modal-dialog" role="document">
            <?= __startForm(url('admin/module/add_module_features'), 'post') ?>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __('module_feature_list') ?></h4>
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
                    <?= hidden('id', 0) ?>
                    <button type="submit" class="btn btn-primary"><?= __('submit') ?></button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ===================
                 Order types modal
        ===========================-->
    <div class="modal fade customModal" id="orderTypesModal">
        <div class="card-header">
            <h4 class="card-title">{{ __('order_types') }}</h4>

        </div>
        <div class="modal-dialog" role="document">
            <?= __startForm(url('admin/module/add_order_types'), 'post') ?>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= lang('order_types') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">{{ __('close') }}</span>
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
                    <?= hidden('id', 0) ?>
                    <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade customModal" id="addModuleModal">
        <div class="modal-dialog" role="document">
            <?= __startForm(url('admin/module/add_new_module'), 'post') ?>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __('add_module') ?></h4>
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
                            <label>{{ __('module_features') }}</label>
                        </div>
                        <!-- /. -->
                        <?php foreach ($module_feature_list as $key => $feature): ?>
                        <label class="custom-checkbox mr-5"> <input type="checkbox" name="features_ids[]"
                                value="<?= $feature->id ?>">
                            <?= $feature->title ?>
                        </label>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-group">
                        <div class="mb-10">
                            <label>{{ __('order_types') }}</label>
                        </div>
                        <?php foreach ($order_type_list as $key => $order_type): ?>
                        <label class="custom-checkbox mr-5"> <input type="checkbox" name="order_type_ids[]"
                                value="<?= $order_type->id ?>">
                            <?= $order_type->title ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="modal-footer">
                    <?= hidden('id', 0) ?>
                    <button type="submit" class="btn btn-primary"><?= __('submit') ?></button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
