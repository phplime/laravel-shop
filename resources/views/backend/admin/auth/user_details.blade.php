<x-admin-layout>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><a href="{{ url('admin/user_list') }}"><i class="fa fa-arrow-left mr-5"></i>
                            phplime</a></h4>
                </div>
                <div class="card-body">
                    <div class="userDeatils d-flex aling-center flex-column justify-content-center gap-10">
                        <div class="d-flex flex-column align-center justify-content-center">
                            <div class="avatar avatar-big avatar-circle">
                                <img src="{{ asset('assets/backend/images/avatar.png') }}" alt="profile image">
                            </div>
                            <div class="mt-10 text-center">
                                <h4>phplime</h4>
                                <p>phplime.envato@gmail.com</p>
                                <p>09 Apr, 2024 - 10:26 pm</p>
                            </div>
                        </div>
                        <div class="text-center d-flex gap-10 align-center-center justify-content-center">
                            <span data-toggle="tooltip" data-placement="top" data-title="Activated"
                                class="text-success  fz-25" data-original-title="" title=""><i
                                    class="fas fa-user-shield"></i></span>

                            <span data-toggle="tooltip" data-placement="top" data-title="Verified"
                                class="text-success  fz-25" data-original-title="" title=""><i
                                    class="fa fa-envelope"></i></span>

                            <span data-toggle="tooltip" data-placement="top" data-title="Payment Verified"
                                class="text-success  fz-25" data-original-title="" title=""><i
                                    class="fa fa-credit-card"></i>
                            </span>
                        </div>
                        <div class="d-flex align-center-center justify-content-center mt-1rm gap-10">
                            <a href="javascript:;" class="btn btn-primary btn-sm"
                                onclick="sidebar(`edit_username_1Sidebar`)"><i class="fa fa-edit"></i>
                                <?= __('Username') ?></a>
                            <a href="javascript:;" class="btn btn-primary btn-sm"
                                onclick="sidebar(`edit_email_1Sidebar`)"><i class="fa fa-edit"></i>
                                <?= __('Email') ?></a>
                        </div>

                        <div class="d-flex align-center-center justify-content-center mt-1rm gap-10">
                            <a href="/0" data-msg="<?= __('want_to_deactivate_account') ?>"
                                class="btn btn-success btn-sm action_btn" data-title="<?= __('activated') ?>"
                                data-toggle="tooltip"><i class="fa fa-check"></i> <?= __('activated') ?> </a>
                            {{-- <a href="/1" data-msg="<?= __('want_to_activate_account') ?>"
                                class="btn btn-danger btn-sm action_btn" data-title="<?= __('deactive_account') ?>"
                                data-toggle="tooltip"><i class="fa fa-ban"></i> <?= __('deactive_account') ?></a> --}}
                            <a href="" class="btn btn-danger btn-sm action_btn" data-title="<?= __('delete') ?>"
                                data-toggle="tooltip"><i class="fa fa-trash"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                @include('backend.admin.auth.current_subscription_thumb')
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="flex align-flex-start flex-column gap-10">
                        <li>
                            <span class="min-w-120"><?= __('id') ?></span>
                            <b>4</b>
                        </li>
                        <li>
                            <span class="min-w-120"><?= __('email') ?></span>
                            <b>phplime.envato@gmail.com</b>
                        </li>
                        <li>
                            <span class="min-w-120"><?= __('phone') ?></span>
                            <b>+0912380923</b>
                        </li>
                        <li>
                            <span class="min-w-120"><?= __('country') ?></span>
                            <b><i class="fi fi-bd"></i> Bangladesh</b>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- subscription information -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="title"><?= __('subscription_info') ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive responsiveTable">
                        <table class="table table-striped table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('package') ?></th>
                                    <th><?= __('price') ?></th>
                                    <th><?= __('date') ?></th>
                                    <th><?= __('overview') ?></th>
                                    <th><?= __('status') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class='text-success'>
                                    <td data-label="#">1</td>
                                    <td data-label="<?= __('package') ?>">pro</td>
                                    <td data-label="<?= __('price') ?>">$546</td>
                                    <td data-label="<?= __('date') ?>">
                                        <p><?= __('active_date') . ' - ' . '14 Aug, 2025' ?></p>
                                        <p><?= __('expire_date') . ' - ' . '14 Aug, 2025' ?></p>
                                    </td>
                                    <td data-label="<?= __('overview') ?>">
                                        <label class="badge badge-secondary" data-toggle="tooltip"
                                            data-title="<?= __('payment_method') ?>">Stripe</label>
                                        <label class="badge badge-secondary" data-toggle="tooltip"
                                            data-title="<?= __('payment_by') ?>">Self</label>
                                        <label class="badge badge-secondary" data-toggle="tooltip"
                                            data-title="<?= __('subscription_form') ?>">subscription</label>
                                    </td>
                                    <td data-label="<?= __('status') ?>">
                                        <label class="badge badge-success"><i class="fa fa-check"></i> Paid </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- edit username -->
    <?= __header(__('edit'), 'edit','edit_username_1') ?>
    <div class="form-group">
        <label><?= lang('username') ?></label>
        <input class="form-control username" type="text" name="username" id="username"
            placeholder="<?= __('name') ?>" value="emran">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
    <!-- edit username -->

    <!-- edit email -->
    <?= __header(__('edit'),'edit', 'edit_email_1') ?>
    <div class="form-group">
        <label><?= lang('email') ?></label>
        <input class="form-control" type="text" name="email" id="email" placeholder="<?= __('email') ?>"
            value="esd@gmail.com">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
    <!-- edit email -->

</x-admin-layout>
