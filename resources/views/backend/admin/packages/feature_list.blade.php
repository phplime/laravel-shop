<x-admin-layout>
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('feature_list') ?></h5>
                    <div class="card-tools">
                        <a href="{{ url('admin/feature/create') }}" class="btn btn-secondary text-right btn-sm addBtn"><i
                                class="fa fa-plus"></i>
                            <?= __('add_new') ?>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('title') ?></th>
                                        <th><?= __('slug') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="hide_1">
                                        <td data-label="<?= __('#') ?>">1</td>
                                        <td data-label="<?= __('title') ?>">menu</td>
                                        <td data-label="<?= __('slug') ?>">menu</td>
                                        <td data-label="<?= __('action') ?>">
                                            <div class="btnGroup">
                                                <a href="" class="btn btn-primary text-right btn-sm"> <i
                                                        class="fa fa-edit"></i> Edit</a>
                                                <a href="" class="btn btn-danger btn-sm action_btn" data-msg="Are you sure?">
                                                    <i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
