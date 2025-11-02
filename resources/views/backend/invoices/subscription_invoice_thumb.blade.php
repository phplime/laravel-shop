<style>
    .subscribeInvoiceCard * {
        color: #000;
    }

    .subscribeInvoiceCard img {
        width: auto;
        max-height: 120px !important;
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
            <p><?= lang('order_no'); ?> : 345435345</p>
            <p><?= lang('date'); ?> : 01 Nov, 2025 - 10:37 pm</p>
            <p class="mt-5"><label class="label bg-success"><?= lang('paid') ?></label> </p>
        </div>
        <div class="invoiceCompany invoiceRight">
            <div class="invoiceImg">
                <img src="{{ asset('assets/frontend/images/logo.jpg') }}" alt="logo">
            </div>
        </div>
    </div>

    <div class="invoiceHeader mt-20">
        <div class="invoiceCompany invoiceLeft">
            <h4>Xshop - Restaurant Food Ordering & Delivery App</h4>
            <pre>Qrexorder LTD Dhaka Bangladesh</pre>
            {{-- <h4>shop</h4> --}}

            {{-- <p>shop@gmail.com</p> --}}
            <p><?= lang('tax_number'); ?> : QR-1523652</p>
        </div>
        <div class="invoiceCompany invoiceRight">
            <h4>phplime</h4>
            <p>phplime@gmail.com</p>
            <p>char rajibpur</p>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th><?= lang('package_name'); ?></th>
                    <th><?= lang('qty'); ?></th>
                    <th><?= lang('price'); ?></th>
                    <th><?= lang('total'); ?></th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>pro</td>
                        <td>1</td>
                        <td>$456</td>
                        <td>$456</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td class="invoiceTotal">
                            <p><b><?= lang('subtotal'); ?> : </b>
                                <b>$45</b>
                            </p>
                            <p><span><?= lang('tax'); ?> (5%): </span>
                                <span>$3</span>
                            </p>
                            <p><b><?= lang('total'); ?> : </b> <b>$34</b></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="" class="btn btn-primary"><i class="fa fa-check"></i> <?= __('confirm'); ?></a>
    </div>
</div>
