<div class="invoiceArea">
    <style>
        .printBtnArea {
            width: 360px;
            margin: 10px auto;
        }

        @media print {
            .printBtnArea {
                display: none !important;
            }
        }
    </style>
    <div id="printArea">
        <?php include "invoice_thumb.php"; ?>
    </div>
    <div class="printBtnArea d-flex space-between align-center gap-10 mt-10">
        <button type="btn" class="btn btn-primary btn-block" onclick="print('printArea');"><i class="fa fa-print mr-5"></i> <?= __('print'); ?></button>
        <button type="btn" class="btn btn-danger btn-block" onclick="exportPDF(this,'printArea');" data-id="<?= $order->uid ?? random_string('numeric', 10); ?>"><i class="fa fa-file-pdf mr-5"></i> <?= __('export'); ?></button>
    </div>
</div>