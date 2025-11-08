@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('customers') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_customer']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('images') ?></th>
                                        <th><?= __('name') ?></th>
                                        <th><?= __('contact') ?></th>
                                        <th><?= __('status') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="hide_1">
                                        <td data-label="#">1</td>
                                        <td data-label="<?= __('images') ?>">
                                            <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                alt="profile" class="avatar round">
                                        </td>
                                        <td data-label="<?= __('name') ?>">
                                            emran
                                        </td>

                                        <td data-label="<?= __('contact') ?>">
                                            <p>emran@gmail.com</p>
                                            <p>+88017347234</p>
                                        </td>

                                        <td data-label="<?= __('status') ?>">
                                            <?= __status(1, 1, 'customer_list') ?>
                                        </td>
                                        <td data-label="<?= __('action') ?>" class="">
                                            <div class="btnGroup">
                                                <a href="<?= url('vendor/staff/reset/1') ?>"
                                                    class="btn btn-info btn-sm resetPassword"
                                                    data-title="<?= __('reset_password') ?>" data-toggle="tooltip"><i
                                                        class="fa fa-lock"></i> <?= __('reset') ?></a>
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_customer_1']) ?>
                                                <?= __deleteBtn(1, 'customer_list', true) ?>
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


    <?= __header(__('add_new'), url('vendor/staff/add_customer'), 'add_customer') ?>


    <div class="form-group">
        <label for=""><?= __('name') ?></label>
        <input type="text" name="name" class="form-control" value="" placeholder="<?= __('name') ?>">
    </div>

    <div class="form-group">
        <label for=""><?= __('phone') ?></label>
        <div class="ci-input-group input-group-append">
            <div class="input-group">
                <span class="d-flex">
                    <span class="fi fi-us"></span>
                    <span class="ml-5 phone_with_input">
                        <input type="text" name="dial_code" class="form-control" value="88">
                    </span>
                </span>
            </div>
            <input type="text" name="phone" class="form-control" value="" placeholder="<?= __('phone') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for=""><?= __('email') ?></label>
        <input type="text" name="email" class="form-control" value="" placeholder="<?= __('email') ?>">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <?= __header(__('edit'), url('vendor/staff/add_customer'), 'edit_customer_1') ?>

    <div class="form-group">
        <label for=""><?= __('name') ?></label>
        <input type="text" name="name" class="form-control" value="">
    </div>

    <div class="form-group">
        <label for=""><?= __('phone') ?></label>
        <div class="ci-input-group input-group-append">
            <div class="input-group">
                <span class="d-flex">
                    <span class="fi fi-us"></span>
                    <span class="ml-5 phone_with_input"> <input type="text" name="dial_code" class="form-control"
                            value=""> </span>
                </span>
            </div>
            <input type="text" name="phone" class="form-control" value="">
        </div>
    </div>

    <div class="form-group">
        <label for=""><?= __('email') ?></label>
        <input type="text" name="email" class="form-control" value="">
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>
@endsection
