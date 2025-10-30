@extends('frontend.baseapp')

@section('content')
    <section class="viewOrder_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12 mb-lg-0 mb-5">

                    <div class="card mb-4">
                        <div class="card-header trackingHeader">
                            <p>Order Tracking</p>
                            <h6 class="order_id">Order ID: <b>#yt6734h89nf</b></h6>
                        </div>
                        <div class="card-body">

                            <div class="orderTracking_system">
                                <ul class="tracking_container">
                                    <li class="tracking_info active">
                                        <div class="icon">
                                            <i class="fa-solid fa-cart-flatbed"></i>
                                        </div>
                                        <div class="tracking_ui_line"><span></span></div>
                                        <div class="trackingText">
                                            <b>Order Accept</b>
                                            <h6>10 Jan 2025, 10:40 AM</h6>
                                        </div>
                                    </li>
                                    <li class="tracking_info">
                                        <div class="icon"><i class="fa-solid fa-people-carry-box"></i></div>
                                        <div class="tracking_ui_line"><span></span></div>
                                        <div class="trackingText">
                                            <b>Order Processing</b>
                                            <h6>10 Jan 2025, 10:40 AM</h6>
                                        </div>
                                    </li>
                                    <li class="tracking_info">
                                        <div class="icon"><i class="fa-solid fa-check-to-slot"></i></div>
                                        <div class="tracking_ui_line"><span></span></div>
                                        <div class="trackingText">
                                            <b>Order Completed</b>
                                            <h6>10 Jan 2025, 10:40 AM</h6>
                                        </div>
                                    </li>
                                    <li class="tracking_info">
                                        <div class="icon"><i class="fa-solid fa-truck-fast"></i></div>
                                        <div class="tracking_ui_line"><span></span></div>
                                        <div class="trackingText">
                                            <b>Out For Delivery</b>
                                            <h6>10 Jan 2025, 10:40 AM</h6>
                                        </div>
                                    </li>
                                    <li class="tracking_info">
                                        <div class="icon"><i class="fa-solid fa-house-circle-check"></i></div>
                                        <div class="tracking_ui_line"><span></span></div>
                                        <div class="trackingText">
                                            <b>Order Delivered</b>
                                            <h6>10 Jan 2025, 10:40 AM</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tracking System -->

                        </div>
                    </div><!-- Order Tracking System -->

                    <div class="card">
                        <div class="card-body">
                            <div class="delivery_addressArea">
                                <div class="tracking_title">
                                    <h6>Delivery Address</h6>
                                </div>
                                <div class="deliveryAddressItem">
                                    <div class="deliveryType">
                                        <i class="fa-solid fa-house-chimney icon"></i>
                                        <h6>Home</h6>
                                    </div>
                                    <div class="addressContent">
                                        <i class="icofont-location-pin"></i>
                                        Char Rajibpur, Rajibpur, Kurigram
                                    </div>
                                </div>
                                <span class="createDate"><i class="fa-regular fa-clock"></i>&nbsp; 10 Jan 2025 -
                                    10:30PM</span>
                            </div>

                            <div class="tracking_title">
                                <h6>Order Payment</h6>
                            </div>
                            <b class="unpaid"><i class="icofont-close"></i> Unpaid</b>
                            <b class="paid"><i class="icofont-verification-check"></i> Paid</b>

                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- col./ -->
                <div class="col-md-12 col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order Items</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="orderItems_container">
                                <div class="singleCartItem">
                                    <div class="image">
                                        <img src="http://shop.test/frontend/images/food2.jpg" alt="img">
                                    </div>
                                    <div class="cartItem_details">
                                        <div class="topTitle">
                                            <h6>Burger</h6>
                                        </div>
                                        <div class="middleText">
                                            <div class="item_variant">
                                                <b>Size: <span>medium</span></b>
                                                <span class="itemTax">10% Included</span>
                                            </div>
                                        </div>
                                        <div class="itemAction">
                                            <div class="itemPrice">
                                                <p>$5 x 3 = $15</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleCartItem">
                                    <div class="image">
                                        <img src="http://shop.test/frontend/images/food2.jpg" alt="img">
                                    </div>
                                    <div class="cartItem_details">
                                        <div class="topTitle">
                                            <h6>Burger</h6>
                                        </div>
                                        <div class="middleText">
                                            <div class="item_variant">
                                                <b>Size: <span>medium</span></b>
                                                <span class="itemTax">10% Included</span>
                                            </div>
                                        </div>
                                        <div class="itemAction">
                                            <div class="itemPrice">
                                                <p>$5 x 3 = $15</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleCartItem">
                                    <div class="image">
                                        <img src="http://shop.test/frontend/images/food2.jpg" alt="img">
                                    </div>
                                    <div class="cartItem_details">
                                        <div class="topTitle">
                                            <h6>Burger</h6>
                                        </div>
                                        <div class="middleText">
                                            <div class="item_variant">
                                                <b>Size: <span>medium</span></b>
                                                <span class="itemTax">10% Included</span>
                                            </div>
                                        </div>
                                        <div class="itemAction">
                                            <div class="itemPrice">
                                                <p>$5 x 3 = $15</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- orderItems_container -->
                            <div class="sumContainer">
                                <ul class="totalSum">
                                    <li>
                                        <span>Total Qty</span>
                                        <b>4</b>
                                    </li>
                                    <li>
                                        <span>Total Price</span>
                                        <b>$ 564.00</b>
                                    </li>
                                    <li>
                                        <span>Tax <small>10% Included</small></span>
                                        <b>$ 5.00</b>
                                    </li>
                                    <li>
                                        <span>Delivery Charge </span>
                                        <b>$ 5.00</b>
                                    </li>
                                    <li class="totalAmount">
                                        <span>Total Price</span>
                                        <b>$ 400.00</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- card./ -->
                    <div class="mt-4">
                        <button type="button" class="btn viewOrder_invoiceBtn"><i class="fa-regular fa-file-lines"></i> Invoice</button>
                    </div>
                </div><!-- col./ -->
            </div><!-- row -->
        </div>
    </section>
@endsection
