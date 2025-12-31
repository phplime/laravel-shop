<style>
    .subscribeInvoiceCard * {
        color: #000;
    }

    .subscribeInvoiceCard img {
        width: auto;
        max-height: 120px !important;
        height: 100%;
        object-fit: cover;
    }

    .subscribeInvoiceCard p,
    .subscribeInvoiceCard h4 {
        padding: 0;
        margin: 0;
    }

    .subscribeInvoiceCard {
        padding-top: 10px;
    }

    .subscribeInvoiceCard .invoiceHeader {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 15px 19px;
    }

    .subscribeInvoiceCard .invoiceHeader.headerTop {
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 18px;
    }

    .subscribeInvoiceCard .invoiceImg {
        max-width: 187px;
        text-align: center;
        height: 100px;
        min-height: 50px;
    }



    .subscribeInvoiceCard td.invoiceTotal p b:first-child,
    .subscribeInvoiceCard td.invoiceTotal p span:first-child {
        min-width: 180px;
        display: inline-block;
    }

    .subscribeInvoiceCard a.invoiceBtn {
        padding: 0;
        margin: 0;
        border: 0;
        color: tomato;
        margin-top: 7px;
        text-decoration: underline !important;
    }

    .subscribeInvoiceCard .subscriptionInvoiceArea {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .subscribeInvoiceCard .subscriptionInvoiceArea {
        background: var(--card-color);
    }

    .subscribeInvoiceCard .bg_white {
        background: #fff;
    }

    .subscribeInvoiceCard .exportBtn {
        margin-bottom: 20px;
    }

    pre {
        font-family: "-apple-system", " BlinkMacSystemFont",
            "Segoe UI", "Roboto", "Oxygen",
            "Ubuntu", "Cantarell", "Fira Sans",
            "Droid Sans", "Helvetica Neue", sans-serif;
        font-size: 16px;
        background: var(--card-color);
        border: 0;
        padding: 0;
        margin: 0;
        color: var(--color);
    }

    .subscribeInvoiceCard .table thead th {
        vertical-align: bottom;
        border-bottom: 0;
    }

    .subscribeInvoiceCard p {
        padding: 0;
        margin: 0;
    }

    .subscribeInvoiceCard .invoiceCompany h4 {
        font-size: 1.2rem;
    }

    .subscribeInvoiceCard .label {
        color: #fff;
    }


    .subscribeInvoiceCard table *,
    .subscribeInvoiceCard .card * {
        color: #000;
    }

    .subscribeInvoiceCard label {
        border-radius: .6rem;
        color: #fff !important;
        padding: 5px 20px;
        font-size: .75rem
    }

    .subscribeInvoiceCard.card {
        background-color: #fff !important;
        color: #fff !important;
    }

    .subscribeInvoiceCard .btn,
    .subscribeInvoiceCard .btn i {
        color: #fff !important;
    }
</style>
<?php

?>
<div class="card subscribeInvoiceCard">
    <div class="invoiceHeader headerTop">
        <div class="invoiceCompany invoiceLeft">
            <p>{{ lang('order_no'); }} : # {{ $invoice_info['order_id'] }}</p>
            <p>{{ lang('date'); }} : {{ makeDate($invoice_info['created_at'],'fulldatetime') }}</p>
            @if (isset($page_title) && $page_title != 'Payment Method')
            <p class="mt-5"><label
                    class="label bg-<?= $invoice_info['is_payment'] == 1 ? "success" : "warning"; ?>"><?= $invoice_info['is_payment'] == 1 ? lang('paid') : lang('pending'); ?></label>
            </p>
            @endif
        </div>
        <div class="invoiceCompany invoiceRight">
            <div class="invoiceImg">
                <img src="<?= __image(__settings('logo'), 'logo'); ?>" alt="logo">
            </div>
        </div>
    </div>

    <div class="invoiceHeader mt-20">
        <div class="invoiceCompany invoiceLeft">
            @if (!empty(__settings('company_details')))
            <h4>{{ __settings('app_name') }}</h4>
            <pre>{{ __settings('company_details') }}</pre>
            @else
            <h4>{{ __settings('app_name') }}</h4>
            @endif

            <p>{{ __settings('email') }}</p>
            @if (!empty(__settings('tax_number')))
            <p>{{ lang('tax_number') }} : {{ __settings('tax_number') }}</p>
            @endif
        </div>
        <div class="invoiceCompany invoiceRight">
            <h4>{{ !empty($invoice_info['name'])?$invoice_info['name']:($invoice_info['username']??'') }}</h4>
            <p>{{ $invoice_info['email'] ?? '' }}</p>
            <p>{{ $invoice_info['address'] ?? '' }}</p>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>{{ lang('package_name') }}</th>
                    <th>{{ lang('qty') }}</th>
                    <th>{{ lang('price') }}</th>
                    <th>{{ lang('total') }}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $invoice_info['package_name'] }}</td>
                        <td>1</td>
                        <td>{{ admin_currency_position($invoice_info['subtotal']) }}</td>
                        <td>{{ admin_currency_position($invoice_info['subtotal']) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td class="invoiceTotal">
                            <p clas><b>{{ lang('subtotal') }} : </b>
                                <b>{{ admin_currency_position($invoice_info['subtotal']) }}</b>
                            </p>

                            <p><span clas>{{ lang('tax') }} <small class="text-muted fz-12">({{ $invoice_info['tax_percent'] }}%)</small >: </span>
                                <span clas>{{ admin_currency_position($invoice_info['tax_fee']) }}</span>
                            </p>
                            <p><b>{{ lang('total') }} : </b> <b>{{ admin_currency_position($invoice_info['total']) }}</b></p>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if (isset(auth()->user()->role) && (auth()->user()->role == 'admin' || auth()->user()->role != 'user'))
    <div class="card-footer text-right">
        <a href="<?= url("admin/auth/create_package/{$invoice_info['user_id']}/{$invoice_info['package_id']}/{$invoice_info['total']}/admin") ?>" class="btn btn-primary"><i class="fa fa-check"></i> {{ __('confirm') }}</a>
    </div>
    @endif
</div>