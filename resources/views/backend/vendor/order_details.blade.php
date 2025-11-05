@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="orderDetails_header">
                <div class="header__leftContent">
                    <div class="flex align-center gap-10">
                        <a href="{{ url('vendor/order-list') }}" class="back__btn"><i class="icofont-undo"></i></a>
                        <h2 class="orderUid">#3847294723</h2>
                    </div>
                    <span class="order_time">Created At - 23 Sep 2025 10:26 am</span>
                </div>
                <div class="header__rightBtns">
                    <a href="" class="btn order_delete"><i class="far fa-trash-alt"></i>&nbsp;Delete Order</a>
                    <a href="" class="btn order_track"><i class="fas fa-map-marked-alt"></i>&nbsp;Track Order</a>
                    <a href="" class="btn order_edit"><i class="far fa-edit"></i>&nbsp;Edit Order</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Details Header Area End -->

    <div class="row mt-40">
        <div class="col-md-12 col-lg-8 col-sm-12">

            <div class="card">
                <div class="card-body">
                    <div class="orderInfo_title">
                        <h4>Progress</h4>
                        <p>Current Order Status</p>
                    </div>
                    <div class="orderStatus_boxArea">

                        <div class="singleStatus_box active">
                            <span class="icon"><i class="icofont-spinner"></i></span>
                            <h6 class="title">Order Pending</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="icofont-spinner-alt-3"></i></span>
                            <h6 class="title">Order Processing</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="fas fa-clipboard-check"></i></span>
                            <h6 class="title">Order Complete</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="icofont-vehicle-delivery-van fz-29"></i></span>
                            <h6 class="title">Out For Delivery</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="icofont-checked"></i></span>
                            <h6 class="title">Order Delivered</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="icofont-close"></i></span>
                            <h6 class="title">Order Cancel</h6>
                            <span class="status_progress"></span>
                        </div>

                        <div class="singleStatus_box">
                            <span class="icon"><i class="icofont-undo"></i></span>
                            <h6 class="title">Order Return</h6>
                            <span class="status_progress"></span>
                        </div>

                    </div><!-- orderStatus_boxArea -->
                </div>
            </div><!-- Order Status Card Area -->

            <div class="card">
                <div class="card-header space-between">
                    <div class="orderInfo_title flex-1">
                        <h4>Product</h4>
                        <p>Your Shipment</p>
                    </div>
                    <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="234234"
                        class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export') ?></a>
                </div>
                <div class="card-body">
                    <div class="itemList">
                        <div class="table-responsive responsiveTable">
                            <table class="table orderItems_table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?= __('items') ?></th>
                                        <th><?= __('qty') ?></th>
                                        <th><?= __('price') ?></th>
                                        <th><?= __('total') ?></th>
                                    </tr>
                                </thead>
                                <tbody class="orderItems_tbody">
                                    <tr>
                                        <td data-label="<?= __('items') ?>">
                                            <div class="itemTopsection align-center">
                                                <div class="avatar avatar-small">
                                                    <img src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                                        alt="item_image">
                                                </div>
                                                <div class="itemDetails">
                                                    <h4>Chicken</h4>
                                                    <span>Size </span> : <span class="text-heading">M</span>
                                                </div>
                                            </div>
                                            <div class="extraSection pl-75">
                                                <ul>
                                                    <li>
                                                        <span>1 x pizza ($5) </span> = <span
                                                            class="text-heading">pizza</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td data-label="<?= __('qty') ?>">
                                            7
                                        </td>
                                        <td data-label="<?= __('price') ?>">
                                            <p class="f-bold"><span class="text-heading">$45</span></p>
                                            <p><small> GST 5% Included</small></p>
                                        </td>
                                        <td data-label="<?= __('total') ?>">
                                            <p class="f-bold">$345</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Order Items card -->

            <div class="card">
                <div class="card-header">
                    <div class="orderInfo_title flex-1">
                        <h4>Timeline</h4>
                        <p>Track shipment progress</p>
                    </div>
                    <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="234"
                        class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i> <?= __('export') ?></a>
                </div>
                <div class="card-body">

                    <div class="timeline_infoContainer">
                        <div class="timeline_infoContent">
                            <span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                            <div class="info__title">
                                <h4><?= __('payment_method') ?> : <label class="label bg-success">paper</h4>
                                <p class="text-success"> paid </p>
                            </div>
                        </div>
                        <div class="timeline_datetime">
                            <span class="time">23 Sep 2025 10:26 am</span>
                        </div>
                    </div>

                    <div class="timeline_infoContainer">
                        <div class="timeline_infoContent">
                            <span class="icon"><i class="icofont-ui-check"></i></span>
                            <div class="info__title">
                                <h4><?= __('order') ?> <b class="dColor">5</b> </h4>
                                <p><?= __('status_from') ?> <b>admin</b></p>
                            </div>
                        </div>
                        <div class="timeline_datetime">
                            <span class="time"></i> 23 Sep 2025 10:26 am</span>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- col./ -->

        <div class="col-md-12 col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header p-10">
                    <div class="orderInfo_title flex-1">
                        <h4>Payment</h4>
                        <p>Final payment amount</p>
                    </div>
                    <a href="javascript:;" onclick="exportPDF(this,'printArea');" data-id="234524"
                        class="btn btn-sm  btn-outline-danger ml-5"><i class="far fa-file-pdf"></i>
                        <?= __('export') ?></a>
                </div>
                <div class="card-body p-10">
                    <div class="bg_color p-10">
                        <ul class="CheckoutSummaryUl">
                            <li><span>Qty</span> <b>3</b></li>
                            <li><span>Subtotal</span> <b>219.05 $</b></li>
                            <li><span>Shipping charge</span> <b>5.00 $</b></li>
                            <li><span>Tax <small class="taxName">GST 5% Included</small> </span> <b>10.95 $</b></li>
                            <li><span>Service Charge</span> <b>5.00 $</b></li>
                            <li><span>Discount</span> <b>10.00 $</b></li>
                            <li class="total"><span>Total</span> <b>230.00 $</b></li>
                        </ul>
                    </div>
                </div>
            </div><!-- Payment Info Card -->

            <div class="card">
                <div class="card-header p-10">
                    <div class="orderInfo_title">
                        <h4>Customer</h4>
                        <p>Information Details</p>
                    </div>
                </div>
                <div class="card-body p-10">
                    <div class="bg_color p-10">

                        <div class="singleCustomerInfo">
                            <i class="fa fa-user"></i>
                            <div class="infoContent">
                                <h5>General Information</h5>
                                <ul class="infoList">
                                    <li>phplime</li>
                                    <li>phplime.envato@gmail.com</li>
                                    <li>01745419094</li>
                                </ul>
                            </div>
                        </div><!-- singleCustomerInfo -->

                        <div class="singleCustomerInfo">
                            <i class="fa fa-home"></i>
                            <div class="infoContent">
                                <h5>Shipping Address</h5>
                                <ul class="infoList">
                                    <li>
                                        <div class="flex align-center gap-10">
                                            Rajibpur
                                            <div class="right">
                                                <a href="" target="_blank" class="ci-round-btn active">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Char Rajibpur</li>
                                    <li>
                                        <span class="text-uppercase">Home</span>&nbsp;
                                        {{-- <i class="fas fa-house-user"></i> <span class="text-uppercase">work</span>&nbsp;
                                    <i class="fas fa-briefcase"></i> <span class="text-uppercase">offer</span></span> --}}
                                    </li>
                                </ul>
                            </div>
                        </div><!-- singleCustomerInfo -->

                        <div class="singleCustomerInfo">
                            <i class="fa fa-home"></i>
                            <div class="infoContent">
                                <h5>Billing Address</h5>
                                <ul class="infoList">
                                    <li>Same as shopping address</li>
                                </ul>
                            </div>
                        </div><!-- singleCustomerInfo -->

                    </div>
                </div>
            </div><!-- Customer Info Card -->
        </div>
    </div><!-- row./ -->
@endsection
