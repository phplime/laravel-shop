@extends('backend.admin.layouts.app')
@section('content')
<div class="row">
    @include('backend.admin.partials.adminmenu')
    <div class="{{ __settings('menu_style') == 1 ? 'col-lg-8' : 'col-lg-8' }} col-xs-12">

        @php echo __startForm(url('public/add_payment_config'), 'post'); @endphp
        @csrf

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= lang("payment_method"); ?></h5>
                <div class="card-tools">
                    <?= __addBtn('', '', ['is_modal' => 1, 'target' => 'newPaymentModal']) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <th>#</th>
                            <th><?= __('name'); ?></th>
                            <th><?= __('keyword'); ?></th>
                            <th><?= __('status'); ?></th>
                            <th><?= __('action'); ?></th>

                            <tbody>
                                <?php foreach ($payment_list as $key => $row) { ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $row->title; ?></td>
                                        <td><?= $row->slug; ?></td>
                                        <td> <?= __status($row->id, $row->status, 'payment_gateway_list'); ?></td>
                                        <td class="">
                                            <div class="btnGroup">
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_category_' . ($row->id)]); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }; ?>
                            </tbody>

                        </table>
                    </div>


                </div><!-- card-content -->
            </div><!-- card-body -->
        </div>

        <form action="<?= url("admin/settings/add_payment_settings") ?>" method="post">
            @csrf
            @foreach ($payment_list as $key => $row)
            @php $payment_config = $row; @endphp

            @php $viewName = 'backend.admin.payment.' . preg_replace('/[^a-z0-9_]/', '', $row->slug) . '_thumb'; @endphp

            @if (view()->exists($viewName))
            @include($viewName)
            @endif
            @endforeach

            <div class="card">
                <button class="btn btn-block btn-primary" type="submit"><?= __('save_change'); ?></button>
            </div>
        </form>


    </div>

</div>


<!-- modal -->

<div class="modal fade customModal" id="newPaymentModal">
    <div class="modal-dialog" role="document">
        <?= __startForm(url('admin/settings/add_new_payment'), 'post') ?>
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= __('new_payment') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title"><?= __('title') ?></label>
                    <input type="text" name="title" class="form-control" placeholder="title">
                </div>

                <div class="form-group">
                    <label for="slug"><?= __('slug') ?></label>
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


@endsection