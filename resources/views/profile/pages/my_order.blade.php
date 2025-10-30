@extends('frontend.baseapp')
@section('content')
    <section class="myOrder_section">
        <div class="container">
            <div class="row justify-center">
                <div class="col-md-9">
                    <div class="myOrders_historyArea">

                        <div class="orderInfoArea">
                            <div class="title">
                                <h5>Active Orders</h5>
                            </div>
                            <div class="orderContainer">

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus pending">Pending</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="{{ route('view_order', ['order_id' => 'hgaj76234jha']) }}"
                                                class="viewOrder">View Details <i class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus accept">Accept</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="" class="viewOrder">View Details <i
                                                    class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus processing">Processing</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="" class="viewOrder">View Details <i
                                                    class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus completed">Completed</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="" class="viewOrder">View Details <i
                                                    class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus out_for_delivery">Out For Delivery</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="" class="viewOrder">View Details <i
                                                    class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus cancel">Cancel</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="" class="viewOrder">View Details <i
                                                    class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Active Order Area End -->

                        <div class="orderInfoArea">
                            <div class="title">
                                <h5>Previous Orders</h5>
                            </div>
                            <div class="orderContainer">


                                <div class="singleOrderDetails">
                                    <div class="icon">
                                        <i class="icofont-food-basket"></i>
                                    </div>
                                    <div class="order_infoContent">
                                        <div class="top">
                                            <h5 class="orderID">#4834h33sdf45</h5>
                                            <span class="orderStatus delivered">Delivered</span>
                                        </div>
                                        <div class="middle">
                                            <span class="date">10-22-2025 10:50 PM</span>
                                            <span class="total"><i class="fa-solid fa-cube"></i> 8 Items</span>
                                        </div>
                                        <div class="bottom">
                                            <b class="totalPrice">Total: <span>$540:00</span></b>
                                            <a href="{{ route('view_order', ['order_id' => 'hgaj76234jha']) }}"
                                                class="viewOrder">View Details <i class="icofont-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Active Order Area End -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
