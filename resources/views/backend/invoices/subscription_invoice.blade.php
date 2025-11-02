<x-admin-layout>
    <?php $id = 1; ?>
    <style>
        .subscriptionInvoiceArea {
            color: #000;
            background-color: #ddd !important;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .subscriptionInvoiceArea .card-body * {
            color: #000 !important;
        }
    </style>
    <div class="subscriptionInvoiceArea">
        <div class="container">
            <div class="exportBtn mb-10">
                <a href="javascript:;" onclick="makepdf(`<?= $id ?>`)" class="btn btn-secondary"><i
                        class="fa fa-file-pdf-o"></i> <?= lang('download') ?></a>
            </div>
            <div class="subscribeInvoice" id="makePdf">
                @include('backend.invoices.subscription_invoice_thumb')
            </div><!-- subscribeInvoice -->

        </div>
    </div>

    <script>
        function makepdf(ID) {
            var section = document.getElementById('makePdf');
            var options = {
                filename: `invoice_${ID}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(options).from(section).save();
        }
    </script>
</x-admin-layout>
