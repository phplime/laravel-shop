@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
    <div class="col-md-8">
        <div class="callout callout-success">
            <h4 class="fz-20 mb-5"><?= __('good') ?> Afternoon,
                <span class="dcolor">phplime</span>
            </h4>
            <p><?= __('welcome_text') ?></p>
        </div>
    </div>
</div>

<!-- //todays revenue, orders, customers, growth -->

<div class="row mt-2rm">
    <div class="col-md-3">
        <div class="info-box bg-purple vendorbox">
            <span class="info-box-icon  elevation-1 text-purple"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('sales') ?></span>
                <span class="info-box-number fz-22 count">
                    5
                </span>
            </div>

        </div>
    </div>


    <div class="col-md-3">
        <div class="info-box bg-primary vendorbox">
            <span class="info-box-icon  elevation-1 text-primary"><i class="fas fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('orders') ?></span>
                <span class="info-box-number fz-22 count">
                    10
                </span>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-info vendorbox">
            <span class="info-box-icon elevation-1 text-info"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('customers') ?></span>
                <span class="info-box-number fz-22 count">
                    10
                </span>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-pink vendorbox">
            <span class="info-box-icon  elevation-1 text-pink"><i class="fab fa-product-hunt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('products') ?></span>
                <span class="info-box-number fz-22 count">
                    20
                </span>
            </div>

        </div>
    </div>
</div>

<div class="row mt-2rm">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" control-id="ControlID-5">
                        <i class="fas fa-minus"></i>
                    </button>

                    <button type="button" class="btn btn-tool" data-card-widget="remove" control-id="ControlID-7">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- <div class="card-body">
                <div class="row" id="chart-sales">
                    <div class="col-md-8">
                        <p class="text-center">
                            <?php
                            $monthYear = getLastSixMonths(_vtime(_ID()), 'year-month');
                            $first_month = reset($monthYear); // First element
                            $last_month = end($monthYear);
                            ?>

                            <strong><?= __('sales') ?> : <?= _vfull_date($first_month, _ID()) ?> -
                                <?= _vfull_date(_vdate(_ID()), _ID()) ?></strong>
                        </p>
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>

                            <canvas id="salesChart" height="360" style="height: 180px; display: block; width: 1478px;"
                                width="2956" class="chartjs-render-monitor"></canvas>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <p class="text-center"><strong><?= __('goals') ?></strong></p>

                        <?php
                        $max_products = 200;
                        $max_sales = 400;
                        $max_orders = 800;
                        $max_customers = 500;
                        ?>
                        <div class="progress-group">
                            <?= __('add_products_to_cart') ?>
                            <span
                                class="float-right"><b><?= $sales_data['total_add_to_cart_products'] ?></b>/<?= $max_products ?></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary"
                                    style="width: <?= ($sales_data['total_add_to_cart_products'] / $max_products) * 100 ?>%">
                                </div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <?= __('total_sales_product') ?>
                            <span
                                class="float-right"><b><?= $sales_data['total_sales_product'] ?></b>/<?= $max_sales ?></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger"
                                    style="width: <?= ($sales_data['total_sales_product'] / $max_sales) * 100 ?>%">
                                </div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <span class="progress-text"><?= __('total_orders') ?></span>
                            <span
                                class="float-right"><b><?= $sales_data['total_orders'] ?></b>/<?= $max_orders ?></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success"
                                    style="width: <?= ($sales_data['total_orders'] / $max_orders) * 100 ?>%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <?= __('total_customers') ?>
                            <span
                                class="float-right"><b><?= $sales_data['total_customers'] ?></b>/<?= $max_customers ?></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning"
                                    style="width: <?= ($sales_data['total_customers'] / $max_customers) * 100 ?>%">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div> --}}

            <div class="card-footer hidden">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">$35,210.43</h5>
                            <span class="description-text">TOTAL REVENUE</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                0%</span>
                            <h5 class="description-header">$10,390.90</h5>
                            <span class="description-text">TOTAL COST</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                20%</span>
                            <h5 class="description-header">$24,813.53</h5>
                            <span class="description-text">TOTAL PROFIT</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                18%</span>
                            <h5 class="description-header">1200</h5>
                            <span class="description-text">GOAL COMPLETIONS</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title"><?= __('popular_items') ?></h4>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body p-0">
                <div class=" table-responsive">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th><?= __('item') ?></th>
                                <th><?= __('sales') ?></th>
                                <th><?= __('price') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}" alt="Product 1"
                                        class="img-circle img-size-32 mr-2">
                                    <span class="no-wrap">pizza</span>
                                </td>
                                <td>10</td>
                                <td>
                                    $56
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
