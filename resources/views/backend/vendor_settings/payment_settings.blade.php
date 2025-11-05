@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">

        @include('backend.vendor_settings.inc.v_settings_menu')

        <div class="col-lg-8 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('payment_list') ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive responsiveTable">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th><?= __('name') ?></th>
                                <th><?= __('keyword') ?></th>
                                <th><?= __('status') ?></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="#">1</td>
                                    <td data-label="<?= __('name') ?>">Paypal</td>
                                    <td data-label="<?= __('keyword') ?>">Paypal</td>
                                    <td data-label="<?= __('status') ?>"> <?= __status(1, 1, 'payment_gateway_list') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <form action="" method="post">
                @csrf

                @include('backend.payment.paypal_thumb')

                @include('backend.payment.stripe_thumb')

                <div class="card">
                    <?= hidden('user_id', 1) ?>
                    <?= hidden('vendor_id', 1) ?>
                    <button class="btn btn-block btn-primary" type="submit"><?= __('save_change') ?></button>
                </div>
            </form>

        </div>
    </div>
@endsection
