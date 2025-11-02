</div> <!-- mainContent-->
</div> <!-- content-->
</div> <!-- Container-fluid -->
</div> <!-- content-wrapper -->
<!-- Comes from sidebar.blade.php -->


<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        <label class="label label-soft-purple"><?= __settings('version'); ?></label>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= asset_url(); ?>"><?= __settings('app_name'); ?></a>.</strong>
</footer>


</div> <!-- end wrapper -->

<?php $this->common_m->getJs(false); ?>

<script src="<?= asset_url('app/assets/backend/js/adminlte.min.js'); ?>"></script>
<script src="<?= asset_url('public/js/utilities.js') ?>?t=<?= time(); ?>"></script>
<script src="<?= asset_url('app/assets/backend/admin.js') ?>?t=<?= time(); ?>"></script>
<script src="<?= asset_url('app/assets/backend/ajaxJs.js') ?>?t=<?= time(); ?>"></script>




<?= $this->load->view('media_layouts/uploader.php', ['userId' => !empty(__auth('id')) ? __auth('id') : (!empty(auth('id')) ? auth('id') : '0'), 'vendorId' => !empty(auth('vendor_id')) ? auth('vendor_id') : '0', 'role' => !empty(auth('user_login')) ? 'user' : 'admin'], true); ?>

<?php if ($this->session->flashdata('success')) { ?>
    <script>
        new Notify({
            status: 'success',
            title: `<?= __('success'); ?>`,
            text: `<?= $this->session->flashdata('success'); ?>`,
            effect: 'slide',
            speed: 300,
            autoclose: true,
            showCloseButton: true,
            gap: 20,
            distance: 20,
            customClass: 'ci-notify',
            type: 'filled', // or 'filled' outline
        })
    </script>
<?php }; ?>

<?php if ($this->session->flashdata('errorMsg')) : ?>
    <script>
        new Notify({
            status: 'error',
            title: `<?= __('success'); ?>`,
            text: `<?= $this->session->flashdata('success'); ?>`,
            effect: 'slide',
            speed: 300,
            autoclose: true,
            showCloseButton: true,
            gap: 20,
            distance: 20,
            customClass: 'ci-notify',
            type: 'filled', // or 'filled' outline
            progress: true,
            progressDuration: 5000,
        })
    </script>
<?php endif ?>


<?php if ($this->session->flashdata('error')) : ?>
    <script>
        new Notify({
            status: 'error',
            title: `<?= __('sorry'); ?>`,
            text: `<?= $this->session->flashdata('error'); ?>`,
            effect: 'slide',
            speed: 300,
            autoclose: true,
            showCloseButton: true,
            gap: 20,
            distance: 20,
            customClass: 'ci-notify',
            type: 'filled', // or 'filled' outline
            progress: true,
            progressDuration: 5000,
        })
    </script>
<?php endif ?>

<script>
    $(document).ready(function() {
        $('.dataTable, .data-table').DataTable();
    });
</script>


<script>

    if ($('.singeSelect').length > 0) {

        $(document).ready(function() {
            new Selectr('.singeSelect', {
                renderOption: myRenderFunction,
                multiple: false,
                customClass: 'customSelect-2'
            });
        });


        function myRenderFunction(option) {
            var template = [
                "<div class='selectImg'><img src='", option.dataset.src, "'><span>",
                option.textContent,
                "</span></div>"
            ];
            return template.join('');
        }

        function updateFlag(select) {

            var selectedOption = select.options[select.selectedIndex];
            var flagUrl = selectedOption.dataset.src;
            select.style.backgroundImage = "url('" + flagUrl + "')";
        }
    }
</script>





<div class="defaultSidebar theme-1">
    <div class="sidebarWrapper">
        <div class="sidebar_header">
            <h4 class="title"></h4>
            <a href="javascript:;" class="hideSidebar"><i class="icofont-close-line-squared-alt"></i></a>
        </div>
        <div class="sidebarContent">

        </div>
    </div>
</div><!-- defaultSidebar -->

</body>

</html>
<?php if (isset($page_title) && $page_title == "Dashboard" && auth('role') == 'user'): ?>
    <script>
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");

        // Fetch the months from PHP
        var monthData = <?= json_encode(getLastSixMonths(_vtime(_ID()))); ?>;
        var salesChartData = {
            labels: monthData,
            datasets: [
                <?php foreach ($sales_report['order_data'] as $key => $d): ?> {
                        label: '<?= __(htmlspecialchars($d['order_type'])) ?>', // Escape the label for safety
                        backgroundColor: '<?= $d['color']['bg'] ?>', // Use single quotes for consistency
                        borderColor: '<?= $d['color']['border'] ?>', // Use single quotes for consistency
                        pointRadius: false,
                        pointColor: '<?= $d['color']['border'] ?>', // Use single quotes
                        pointStrokeColor: '<?= $d['color']['border'] ?>', // Use single quotes
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: '<?= $d['color']['border'] ?>', // Use single quotes
                        data: <?= json_encode($d['data']) ?>
                    },
                <?php endforeach; ?>
            ]
        };

        // Chart options
        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true
            },

        };

        // Create the chart
        var salesChart = new Chart(salesChartCanvas, {
            type: "line", // You can change the chart type here
            data: salesChartData,
            options: salesChartOptions
        });
    </script>
<?php endif; ?>

<!----------------------------------------------
Get realtime notification
---------------------------------------------->
<?php if (auth('role') == 'user'): ?>
    <script>
        $(document).ready(function() {
            initializeOrderLoading();
        });
    </script>
<?php endif; ?>



<script>
    (function() {
        var originalOpen = XMLHttpRequest.prototype.open;

        XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
            if (typeof url === 'string') {
                url = fixUrlParameters(url);
            }

            return originalOpen.apply(this, [method, url, async, user, password]);
        };
    })();


    function fixUrlParameters(url) {
        if (typeof url !== 'string') return url;

        // Check if there are multiple question marks in the URL
        if ((url.match(/\?/g) || []).length > 1) {
            // Replace all question marks after the first one with ampersands
            return url.replace(/\?([^?]*)$/, '&$1');
        }

        return url;
    }
</script>