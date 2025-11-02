<div id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <style>
                @media print {
                    .printBtn {
                        display: none !important;
                    }

                    .printBtnArea {
                        display: none !important;
                    }
                }
            </style>
            <div id="printArea">
                <?php $this->load->view("invoices/invoice_thumb", ['vendor_id' => $vendor_id]) ?>
            </div>
        </div>
    </div>
</div>