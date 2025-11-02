<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="search-area">
                    <input type="text" class="search-input form-control" placeholder="Search items by name or ID..." id="searchInput">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4><?= __('total_items'); ?></h4>
            </div>
            <div class="card-body">
                <h2 class="metric-value count" id="totalItems">0</h2>
                <div class="chart-bars blue-bars" id="itemsChart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h><?= __('total_revenue'); ?></h>
            </div>
            <div class="card-body">
                <h2 class="metric-value count" id="totalRevenue">$0.00</h2>
                <div class="chart-bars green-bars" id="revenueChart"></div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4><?= __('total_qty'); ?></h4>
            </div>
            <div class="card-body">
                <h2 class="metric-value count" id="totalQuantity">0</h2>
                <div class="chart-bars purple-bars" id="quantityChart"></div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4><?= __('average_price'); ?></h4>
            </div>
            <div class="card-body">
                <h2 class="metric-value count" id="averagePrice">$0.00</h2>
                <div class="chart-bars orange-bars" id="avgPriceChart"></div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <!-- Top by Quantity -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">🔥 <?= __('top_selling_by'); ?> <?= __('units'); ?></div>
            <div class="card-body">
                <h1 class="product-name mb-1rm" id="topQtyName"><?= __('loading'); ?>...</h1>
                <div class="product-details" id="topQtyDetails"><?= __('calculating'); ?>...</div>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card">
            <div class="card-header">🏆 <?= __('top_selling_by'); ?> <?= __('revenue'); ?></div>
            <div class="card-body">
                <h1 class="product-name mb-1rm" id="topRevenueName"><?= __('loading'); ?>...</h1>
                <div class="product-details" id="topRevenueDetails"><?= __('calculating'); ?>...</div>
            </div>
        </div>
    </div>


</div>


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <?= __('popular_items'); ?> <?= __('qty'); ?>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="orderTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('title'); ?></th>
                                <th><?= __('qty'); ?></th>
                                <th><?= __('price'); ?></th>
                                <th><?= __('total'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Filled by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <?= __('popular_items'); ?> (<?= __('revenue'); ?>)
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="orderTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= __('title'); ?></th>
                                <th><?= __('qty'); ?></th>
                                <th><?= __('price'); ?></th>
                                <th><?= __('total'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyRevenue">
                            <!-- Filled by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>











<script>
    // Inject PHP data into JS
    const foodData = <?= json_encode($json_food_data) ?>;
    let filteredData = [...foodData];


    const revenueFoodData = <?= json_encode($json_revenue_data) ?>;
    let revenueFilteredData = [...revenueFoodData];

    // Calculate metrics dynamically
    function calculateMetrics() {
        const totalItems = foodData.length;
        const totalQuantity = foodData.reduce((sum, item) => sum + item.total_qty, 0);
        const totalRevenue = foodData.reduce((sum, item) => sum + item.total_price, 0);
        const averagePrice = totalItems > 0 ? totalRevenue / totalItems : 0;

        // Update display values
        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('totalQuantity').textContent = totalQuantity;
        document.getElementById('totalRevenue').textContent = showPrice(totalRevenue);
        document.getElementById('averagePrice').textContent = showPrice(averagePrice);

        // 🔥 Find top by REVENUE
        const topByRevenue = foodData.length > 0 ?
            foodData.reduce((top, item) =>
                item.total_price > top.total_price ? item : top
            ) :
            null;

        if (topByRevenue) {
            document.getElementById('topRevenueName').textContent = topByRevenue.title;
            document.getElementById('topRevenueDetails').innerHTML =
                `<span class="dcolor"><b>${showPrice(topByRevenue.total_price)}</b></span> <?= __('earned') ?> (${topByRevenue.total_qty} <?= __('units') ?>)`;

        } else {
            document.getElementById('topRevenueDetails').innerHTML =
                `<?= __('not_found'); ?>`;
        }

        // 🏆 Find top by QUANTITY
        const topByQty = foodData.length > 0 ?
            foodData.reduce((top, item) =>
                item.total_qty > top.total_qty ? item : top
            ) :
            null;

        if (topByQty) {
            document.getElementById('topQtyName').textContent = topByQty.title;
            document.getElementById('topQtyDetails').innerHTML =
                `<span class="dcolor"><b>${topByQty.total_qty}</b></span> <?= __('units') ?> (${showPrice(topByQty.total_price)} <?= __('revenue'); ?>)`;
        } else {
            document.getElementById('topQtyDetails').innerHTML =
                `<?= __('not_found'); ?>`;
        }
    }

    // Generate dynamic charts
    function generateCharts() {
        const sortedByRevenue = [...filteredData].sort((a, b) => b.total_price - a.total_price);
        const sortedByQty = [...filteredData].sort((a, b) => b.total_qty - a.total_qty);
        const sortedByUnitPrice = [...filteredData].sort((a, b) => {
            const unitA = a.total_price / a.total_qty;
            const unitB = b.total_price / b.total_qty;
            return unitB - unitA;
        });

        generateBarsChart('itemsChart', sortedByQty, 'total_qty');
        generateBarsChart('revenueChart', sortedByRevenue, 'total_price');
        generateBarsChart('quantityChart', sortedByQty, 'total_qty');
        generateBarsChart('avgPriceChart', sortedByUnitPrice, 'unit_price');
    }

    // Create bar charts
    function generateBarsChart(containerId, data, valueType) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        if (data.length === 0) return;

        const values = data.map(item => {
            return valueType === 'unit_price' ?
                item.total_price / item.total_qty :
                item[valueType];
        });

        const maxValue = Math.max(...values);

        data.forEach(item => {
            const value = valueType === 'unit_price' ?
                item.total_price / item.total_qty :
                item[valueType];
            const height = (value / maxValue) * 100;

            const bar = document.createElement('div');
            bar.className = 'bar';
            bar.style.height = `${height}%`;
            bar.title = `${item.title}: ${valueType === 'unit_price' ? '$' + value.toFixed(2) : value}`;
            container.appendChild(bar);
        });
    }

    // Populate the table
    function populateRevenueTable(data = revenueFilteredData) {
        const tableBody1 = document.getElementById('tableBodyRevenue');
        tableBody1.innerHTML = '';

        const sortedData = [...data].sort((a, b) => b.total_price - a.total_price);

        sortedData.forEach((item, index) => {
            const unitPrice = (item.total_price / item.total_qty).toFixed(2);
            const row = `
                    <tr>
                        <td>${index + 1}</td> <!-- serial number -->
                        <td class="item-name">${item.title}</td>
                        <td>${item.total_qty}</td>
                        <td>${showPrice(unitPrice)}</td>
                        <td class="price-cell">${showPrice(item.total_price)}</td>
                    </tr>
                `;
            tableBody1.innerHTML += row;
        });
    }


    function populateTable(data = filteredData) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        // 🔽 Sort by total_qty (highest first)
        const sortedData = [...data].sort((a, b) => b.total_qty - a.total_qty);

        sortedData.forEach((item, index) => {
            const unitPrice = (item.total_price / item.total_qty).toFixed(2);
            const row = `
            <tr>
                <td>${index + 1}</td> <!-- serial number -->
                <td class="item-name">${item.title}</td>
                <td>${item.total_qty}</td>
                <td>${showPrice(unitPrice)}</td>
                <td class="price-cell">${showPrice(item.total_price)}</td>
            </tr>
        `;
            tableBody.innerHTML += row;
        });
    }


    // Search function
    function searchItems() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
        if (searchTerm === '') {
            filteredData = [...foodData];
        } else {
            filteredData = foodData.filter(item =>
                item.title.toLowerCase().includes(searchTerm) ||
                item.item_id.toString().includes(searchTerm)
            );
        }
        populateTable(filteredData);
        populateRevenueTable(revenueFilteredData);
        generateCharts();
    }

    // Search on Enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchItems();
        }
    });

    // Live search as you type
    document.getElementById('searchInput').addEventListener('input', function() {
        searchItems();
    });

    // Initialize dashboard
    function initializeDashboard() {
        calculateMetrics();
        generateCharts();
        populateTable();
        populateRevenueTable();
    }

    // Run after page loads
    window.onload = initializeDashboard;
</script>