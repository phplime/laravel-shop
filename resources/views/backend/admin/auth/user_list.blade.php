<x-admin-layout>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Subscriber list</h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'subscriber']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>username</th>
                                        <th>account_type</th>
                                        <th>date</th>
                                        <th>overview</th>
                                        <th>status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="hide_1">
                                        <td data-label="#">1 </td>
                                        <td data-label="username">emran</td>
                                        <td data-label="account_type">
                                            <div class="statusList">
                                                <ul class="d-flex gap-10 flex-column">
                                                    <li>
                                                        <small><i class="fab fa-gitkraken"></i> Package name</small> :
                                                        <label class="label bg-soft-info"> Pro</label>
                                                    </li>
                                                    <li>
                                                        <small><i class="fas fa-calendar-week"></i> Package type</small>
                                                        :
                                                        <label class="label bg-soft-warning"> yearly</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td data-label="date">
                                            <div class="statusList">
                                                <ul class="d-flex gap-10 flex-column">
                                                    <ul class="d-flex gap-10 flex-column">
                                                        <li>
                                                            <small><i class="fas fa-user-shield"></i> Active
                                                                date</small> :
                                                            <label class="label bg-soft-info"> 14 Aug, 2025</label>
                                                        </li>
                                                        <li>
                                                            <small><i class="fas fa-ban"></i> Expire date</small> :
                                                            <label class="label bg-soft-warning"> 14 Aug, 2026 - 11:59
                                                                pm</label>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </td>
                                        <td data-label="overview">
                                            <label class="badge badge-danger" data-toggle="tooltip" data-title="Expired"
                                                data-original-title="" title=""
                                                aria-describedby="tooltip764356"><i class="fas fa-ban"></i> Expired
                                            </label>
                                            <div class="statusList">
                                                <ul class="d-flex gap-10 flex-column">
                                                    <li>
                                                        <small><i class="fa fa-credit-card"></i> Payment</small> :
                                                        <a href="" class="label bg-soft-success action_btn">
                                                            <i class="fa fa-check"></i> Paid
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <small><i class="fas fa-envelope"></i> verification</small> :
                                                        <a href="" class="label bg-soft-success action_btn">
                                                            <i class="fas fa-check"></i> Verified
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td data-label="status">
                                            <a href="javascript:;" data-status="1"
                                                onclick="changeStatus(event,this,6,1,'users')"
                                                class="badge badge-success changeStatus"><i class="fa fa-check"></i>
                                                &nbsp;Activated</a>
                                            <div class="mt-5">
                                                <label class="label label-soft-default">286 Days left</label>
                                            </div>
                                        </td>
                                        <td data-label="action">
                                            <div class="btnGroup">
                                                <a href="{{ url('admin/user_details/phplime') }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="javascript:;"
                                                    class="btn btn-info btn-sm change_packageSidebar_1"
                                                    onclick="sidebar(`change_package_1Sidebar`)"
                                                    data-title="change package" data-toggle="tooltip"><i
                                                        class="fas fa-exchange-alt"></i> </a>

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


    <?= __header(__('add_subscriber'), 'admin/auth/create_subscriber', 'subscriber') ?>
    <div class="form-group">
        <label><?= lang('username') ?></label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Name" value="">
    </div>

    <div class="form-group">
        <label><?= lang('email') ?></label>
        <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="">
    </div>

    <div class="form-group">
        <label for="Name"><?= lang('package_list') ?></label>
        <select name="package_id" class="form-control niceSelect wide" id="packageList">
            <option value=""><?= lang('select') ?></option>
            <option value="1">free</option>
            <option value="2">free</option>
            <option value="3">free</option>
        </select>
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <?= __header(__('change_package'), 'admin/auth/change_package', 'change_package_1') ?>

    <div class="form-group">
        <label for="Name"><?= lang('package_list') ?></label>
        <select name="package_id" class="form-control niceSelect wide" id="packageList">
            <option value=""><?= lang('Select') ?></option>
            <option value="trial">Trial/1 Trial - $&nbsp;0</option>
            <option value="pro">Pro/10 Yearly - $&nbsp;10</option>
            <option value="gold" selected="">Gold/1 Monthly - $&nbsp;0</option>
        </select>
    </div>
    <?= hidden('id', 0) ?>
    <?= __footer() ?>



    <div id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keybard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title"></h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modalContent">

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
