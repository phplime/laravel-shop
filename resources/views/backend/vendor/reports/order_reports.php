<div class="card">
    <div class="card-body">
        <div class="filterArea d-flex align-center gap-10">
            <div class="form-group">
                <label for=""><?= __("date"); ?> </label>
                <input type="text" name="daterange" class="form-control datetime" placeholder="<?= __('date') ?>" value="">
            </div>
            <div class="form-group">
                <label for=""></label>
                <button id="apply_filter" class="btn btn-primary btn-block">
                    <i class="fas fa-filter"></i><?= __('filter'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="menuUl orderTypeMenu gap-10">
                    <li class="orderType active" data-type=""><a href="javascript:;"><?= __("all"); ?> </a></li>
                    <?php foreach ($order_types as $key => $type): ?>
                        <li class="orderType" data-type="<?= $type->order_type; ?>"><a href="javascript:;"><?= __($type->order_type); ?> <span class="badge badge-primary ml-5 d-none"><?= _x($type->total_orders); ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row" id="statistics-cards">
    <div class="col-lg-3 col-md-6">
        <div class="card text-center p-1rm">
            <div class="stat-icon fz-2rm"><i class="fas fa-shopping-cart"></i></div>
            <div class="stat-number fz-2rm count" id="total-orders">-</div>
            <div class="stat-label"><?= __('total_orders'); ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center p-1rm">
            <div class="stat-icon fz-2rm"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-number fz-2rm count" id="total-revenue">-</div>
            <div class="stat-label"><?= __('total_revenue'); ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center p-1rm">
            <div class="stat-icon fz-2rm"><i class="fas fa-boxes"></i></div>
            <div class="stat-number fz-2rm count" id="total-items">-</div>
            <div class="stat-label"><?= __('total_items'); ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center p-1rm">
            <div class="stat-icon fz-2rm"><i class="fas fa-calculator"></i></div>
            <div class="stat-number fz-2rm count" id="avg-order-value">-</div>
            <div class="stat-label"><?= __('average_price'); ?></div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-chart-line"></i> <?= __('orders_revenue'); ?></h4>
            </div>
            <div class="card-body chart-container chart-height">
                <canvas id="ordersChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-chart-pie"></i> <?= __('order_status'); ?></h4>
            </div>
            <div class="card-body chart-container chart-height">
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>

    </div>
</div>





<script>
    $(document).ready(function() {

        const order_types = `<?= json_encode($order_types) ?>`;
        // Set default dates
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);

        $('#date_from').val(firstDay.toISOString().split('T')[0]);
        $('#date_to').val(today.toISOString().split('T')[0]);

        // Initialize charts
        let ordersChart, statusChart;

        // Load initial data
        loadDashboardData();

        // Event handlers
        $('#apply_filter').click(function() {
            loadDashboardData();
        });

        $(document).on('click', '.orderType[data-type]', function() {
            $('.orderType').removeClass('active');
            $(this).addClass('active');
            loadDashboardData();
        });



        function loadDashboardData() {
            const activeTab = $('.orderType.active');
            const orderType = activeTab.data('type') || '';
            const dateRange = $("[name='daterange']").val();
            const chartType = $('#chart_type').val();

            $('.loader').show();

            // Load statistics
            loadStatistics(orderType, dateRange);

            // Load chart data
            loadChartData(orderType, dateRange, chartType);

            // Load top items
            // loadTopItems(orderType,daterange);
        }

        function loadStatistics(orderType, dateRange) {
            $.ajax({
                url: '<?php echo base_url("vendor/reports/get_order_statistics"); ?>',
                method: 'GET',
                data: {
                    order_type: orderType,
                    daterange: dateRange,
                },
                success: function(response) {
                    const data = JSON.parse(response);

                    $('#total-orders').text(data.total_orders.toLocaleString());
                    $('#total-revenue').text('$' + parseFloat(data.total_revenue).toLocaleString());
                    $('#total-items').text(data.total_items.toLocaleString());
                    $('#avg-order-value').text('$' + data.avg_order_value);

                    // Update status chart
                    updateStatusChart(data.status_breakdown);
                },
                error: function() {
                    console.error('Error loading statistics');
                }
            });
        }

        function loadChartData(orderType, dateRange, chartType) {
            $.ajax({
                url: '<?php echo base_url("vendor/reports/get_chart_data"); ?>',
                method: 'GET',
                data: {
                    order_type: orderType,
                    daterange: dateRange,
                    chart_type: chartType
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    updateOrdersChart(data);
                    $('.loader').hide();
                },
                error: function() {
                    console.error('Error loading chart data');
                    $('.loader').hide();
                }
            });
        }

        function loadTopItems(orderType, dateRange, dateTo) {
            $.ajax({
                url: '<?php echo base_url("vendor/reports/get_top_items"); ?>',
                method: 'GET',
                data: {
                    order_type: orderType,
                    daterange: dateRange,
                    limit: 10
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    updateTopItemsTable(data);
                },
                error: function() {
                    console.error('Error loading top items');
                }
            });
        }

        function updateOrdersChart(data) {
            const ctx = document.getElementById('ordersChart').getContext('2d');

            if (ordersChart) {
                ordersChart.destroy();
            }

            ordersChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Orders',
                        data: data.orders,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y'
                    }, {
                        label: 'Revenue ($)',
                        data: data.revenues,
                        borderColor: '#764ba2',
                        backgroundColor: 'rgba(118, 75, 162, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        }
                    }
                }
            });
        }

        function updateStatusChart(statusData) {
            const ctx = document.getElementById('statusChart').getContext('2d');

            if (statusChart) {
                statusChart.destroy();
            }

            const labels = statusData.map(item => item.status);
            const data = statusData.map(item => item.count);
            const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

            statusChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors.slice(0, data.length)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true
                }
            });
        }

        function updateTopItemsTable(items) {
            const tbody = $('#top-items-table');
            tbody.empty();

            if (items.length === 0) {
                tbody.append('<tr><td colspan="4" class="text-center">No data available</td></tr>');
                return;
            }

            items.forEach((item, index) => {
                tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.item_name}</td>
                            <td><span class="badge badge-primary">${item.total_quantity}</span></td>
                            <td><strong>$${parseFloat(item.total_revenue).toFixed(2)}</strong></td>
                        </tr>
                    `);
            });
        }
    });
</script>