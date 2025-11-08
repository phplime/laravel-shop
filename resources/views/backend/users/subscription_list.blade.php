@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang('invoice') ?></h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped data_tables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('package_name') ?></th>
                                    <th><?= lang('price') ?></th>
                                    <th><?= lang('billing_cycle') ?></th>
                                    <th><?= lang('last_billing') ?></th>
                                    <th><?= lang('status') ?></th>
                                    <th><?= lang('expire_date') ?></th>
                                    <th><?= lang('invoice') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pro</td>
                                    <td>$11</td>
                                    <td>yearly</td>
                                    <td>2025-08-14 16:54:09</td>
                                    <td>
                                        <label class="label bg-default-soft"><?= lang('pending') ?></label>
                                        {{-- <label class="label bg-soft-success"><i class="fa fa-check"></i>
                                            <?= lang('running') ?></label>
                                        <label class="label bg-soft-danger"> <i class="fa fa-ban"></i>
                                            <?= lang('expired') ?></label>
                                        <label class="label bg-danger-soft"> <i class="fa fa-ban"></i>
                                            <?= lang('expired') ?></label> --}}
                                    </td>
                                    <td>
                                        2026-08-14 23:59:59 <span class="label bg-soft-default ml-10"> 279 Days left </span>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-secondary btn-sm" target="blank">
                                            <i class="fa fa-file-pdf"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
