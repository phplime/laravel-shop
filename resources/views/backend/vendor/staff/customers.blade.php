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
                                    @foreach ($customer_list as $key => $row)
                                        <tr id="hide_<?= $key ?>">
                                            <td data-label="#">{{ $key+1 }}</td>
                                            <td data-label="<?= __('images') ?>">
                                                <img src="<?= avatar($row->profile ?? '', 'profile') ?>"
                                                    alt="profile" class="avatar round">
                                            </td>
                                            <td data-label="<?= __('name') ?>">
                                                {{ $row->name }}
                                            </td>

                                            <td data-label="<?= __('contact') ?>">
                                                <p>{{ $row->email }}</p>
                                                <p>+<?= $row->dial_code.' '.$row->phone ?></p>
                                            </td>

                                            <td data-label="<?= __('status') ?>">
                                                <?= __status($row->id, $row->status, 'customer_list') ?>
                                            </td>
                                            <td data-label="<?= __('action') ?>" class="">
                                                <div class="btnGroup">
                                                    <a href="<?= url('vendor/staff/reset/1') ?>"
                                                        class="btn btn-info btn-sm resetPassword"
                                                        data-title="<?= __('reset_password') ?>" data-toggle="tooltip"><i
                                                            class="fa fa-lock"></i> <?= __('reset') ?></a>
                                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_customer_'.$row->id]) ?>
                                                    <?= __deleteBtn($row->id, 'customer_list', true) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>


    <!-- Add Sidebar Area -->
        <?= __header(__('add_new'), url('vendor/add-customer'), 'add_customer') ?>
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



    <!-- Edit Sidebar Area -->
    @foreach ($customer_list as $row)
        <?= __header(__('edit'), url('vendor/add-customer'), 'edit_customer_'.$row->id) ?>
            <div class="form-group">
                <label for=""><?= __('name') ?></label>
                <input type="text" name="name" class="form-control" value="<?= $row->name ?>">
            </div>

            <div class="form-group">
                <label for=""><?= __('phone') ?></label>
                <div class="ci-input-group input-group-append">
                    <div class="input-group">
                        <span class="d-flex">
                            <span class="fi fi-us"></span>
                            <span class="ml-5 phone_with_input">
                                <input type="text" name="dial_code" class="form-control" value="<?= $row->dial_code ?>">
                            </span>
                        </span>
                    </div>
                    <input type="text" name="phone" class="form-control" value="<?= $row->phone ?>">
                </div>
            </div>

            <div class="form-group">
                <label for=""><?= __('email') ?></label>
                <input type="text" name="email" class="form-control" value="<?= $row->email ?>">
            </div>
            <?= hidden('id', __isset($row, 'id')) ?>
        <?= __footer() ?>
    @endforeach

@endsection
