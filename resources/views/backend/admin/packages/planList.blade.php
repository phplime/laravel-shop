<x-admin-layout>
    <div class="row">
        <div class="col-lg-10 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang('package_list') ?></h5>
                    <div class="card-tools">
                        <a href="{{ url('admin/package/create') }}" class="btn btn-secondary text-right btn-sm addBtn"><i class="fa fa-plus"></i>
                            <?= lang('add_new') ?></a>
                    </div>
                </div>
                <div class="card-body table-style">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('name') ?></th>
                                        <th><?= __('slug') ?></th>
                                        <th><?= __('type') ?></th>
                                        <th><?= __('price') ?></th>
                                        <th><?= __('modules') ?></th>
                                        <th><?= __('features') ?></th>
                                        <th><?= __('status') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="hide_1">
                                        <td data-label="#">1</td>
                                        <td data-label="<?= __('name') ?>">pro</td>
                                        <td data-label="<?= __('slug') ?>">pro</td>
                                        <td data-label="<?= __('type') ?>"><?= __('days') ?></td>
                                        <td data-label="<?= __('price') ?>">
                                            $5
                                            <span class="previous_price">$5</span>
                                        </td>
                                        <td data-label="<?= __('modules') ?>">
                                            <div class="d-flex flex-row flex-wrap gap-10 align-start">
                                                <label class="label badge-soft-success">Restaurant</label>
                                            </div>
                                        </td>
                                        <td data-label="<?= __('features') ?>">
                                            <ul class="d-flex gap-10 flex-column">
                                                <li class="fz-14 p-5 d-flex gap-10 align-center"> <i
                                                        class="fas fa-check text-success"></i> Menu</li>
                                            </ul>
                                            <ul class="d-flex gap-10 flex-column">
                                                <li class="fz-14 p-5 d-flex gap-10 align-center"> <i
                                                        class="fas fa-times text-danger"></i> WhatsApp Order</li>
                                            </ul>
                                        </td>
                                        <td data-label="<?= __('status') ?>">
                                            <?= __status(1, 1, 'package_list') ?>

                                            <a href="javascript:;" class="badge bg-info-light-active ml-5"><i
                                                    class="icofont-ui-lock"></i> <?= lang('default') ?></a>
                                            <a href="" class="badge bg-info-light ml-5 action_btn"><i
                                                    class="icofont-ui-unlock"></i> <?= lang('make_default') ?></a>
                                        </td>
                                        <td class="btnGroup" data-label="<?= __('action') ?>">
                                            <a href="{{ url('/admin/package/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                                Edit</a>
                                            <a href="" data-id="1" data-msg="Want to delete?"
                                                class="btn btn-danger btn-sm ajaxDelete"><i class="fa fa-trash"></i>
                                                Delete</a>
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
