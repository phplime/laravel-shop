<form action="" method="post">
    @csrf
    <div class="card mt-30">
        <div class="card-header flex align-center space-between">
            <h5 class="card-title">Shopping Address</h5>
            <a href="javascript:;" data-toggle="modal" data-target="#add_address"
                class="btn btn-primary"><i class="fa-solid fa-location-crosshairs"></i> Add
                Address</a>
        </div>
        <div class="card-body">
            <div class="shoppingAddressArea">

                <label class="address-label m-0">
                    <input type="radio" name="address_id" class="d-none">
                    <div class="addressInfoArea">
                        <div class="addressType">
                            <div class="icon">
                                <i class="fa-solid fa-house-chimney"></i>
                            </div>
                            <h6>Home</h6>
                            <div class="addressAction">
                                <a href="javascript:;" class="btn editAddress"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <a href="javascript:;" class="btn deleteAddress"><i
                                        class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>
                        <div class="address_content">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            <p>Char Rajibpur, Kurigram</p>
                        </div>
                        <span class="check-icon"><i class="fa-solid fa-circle-check"></i></span>
                    </div>
                </label>

                <label class="address-label m-0">
                    <input type="radio" name="address_id" class="d-none">
                    <div class="addressInfoArea">
                        <div class="addressType">
                            <div class="icon">
                                <i class="fa-solid fa-house-chimney"></i>
                            </div>
                            <h6>Home</h6>
                            <div class="addressAction">
                                <a href="javascript:;" class="btn editAddress"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <a href="javascript:;" class="btn deleteAddress"><i
                                        class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>
                        <div class="address_content">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            <p>Char Rajibpur, Kurigram</p>
                        </div>
                        <span class="check-icon"><i class="fa-solid fa-circle-check"></i></span>
                    </div>
                </label>

                <label class="address-label m-0">
                    <input type="radio" name="address_id" class="d-none">
                    <div class="addressInfoArea">
                        <div class="addressType">
                            <div class="icon">
                                <i class="fa-solid fa-house-chimney"></i>
                            </div>
                            <h6>Home</h6>
                            <div class="addressAction">
                                <a href="javascript:;" class="btn editAddress"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <a href="javascript:;" class="btn deleteAddress"><i
                                        class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>
                        <div class="address_content">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            <p>Char Rajibpur, Kurigram</p>
                        </div>
                        <span class="check-icon"><i class="fa-solid fa-circle-check"></i></span>
                    </div>
                </label>

            </div>
        </div>
    </div><!-- shopping address card./ -->

    <div class="card mt-20">
        <div class="card-header">
            <h6 class="card-title">Payment Method</h6>
        </div>
        <div class="card-body">
            <div class="orderType">
                <label class="custom-checkbox" data-toggle="collapse"
                    data-target="#checkoutType">
                    <input type="checkbox" name="is_pay_type">
                    <span>Order Type</span>
                </label>
            </div>
            <div class="checkoutType collapse" id="checkoutType">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <label class="tabLink nav-link active" data-toggle="tab"
                            data-target="#cod" role="tab">
                            Cash on delivery
                            <input type="radio" name="order_type" value="cod"
                                class="d-none" checked>
                        </label>
                        <label class="tabLink nav-link " data-toggle="tab" data-target="#pickup"
                            role="tab">
                            Pickup / takeaway
                            <input type="radio" name="order_type" value="pickup"
                                class="d-none">
                        </label>
                        <label class="tabLink nav-link" data-toggle="tab" data-target="#dinein"
                            role="tab">
                            Dine-in
                            <input type="radio" name="order_type" value="dinein"
                                class="d-none">
                        </label>
                        <label class="tabLink nav-link" data-toggle="tab" data-target="#paycash"
                            role="tab">
                            Pay cash
                            <input type="radio" name="order_type" value="paycash"
                                class="d-none">
                        </label>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane custom-tabContent show active" id="cod"
                        role="tabpanel">
                        <div class="codContent">
                            <div class="deliverySystem">
                                <div class="form-group">
                                    <label>Delivery area <span class="error"> * </span></label>
                                    <select name="shipping" id="shipping" class="form-control">
                                        <option value="">Select</option>
                                        <option value="3" data-charge="5.00 $">Rajibpur :
                                            5.00 $</option>
                                        <option value="2" data-charge="60.00 $">Dhaka : 60.00
                                            $</option>
                                    </select>
                                </div>
                            </div>
                            <!-- For Guest -->
                            <div class="mt-10">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <div class="ci-input-group input-group-append">
                                        <div class="addons">
                                            <span><i class="fa fa-plus"></i></span>
                                            <input type="text" name="cod_dial_code"
                                                class="only_number" value="880">
                                        </div>
                                        <input type="text" name="guest_phone"
                                            class="form-control only_number" placeholder="Phone"
                                            value="">
                                        <input type="hidden" name="dial_code" value="880">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address <span class="error">*</span></label>
                                    <textarea name="guest_address" class="form-control" placeholder="Shopping address.."></textarea>
                                </div>
                            </div>
                            <!-- For Guest -->
                        </div>
                    </div><!-- COD area End./ -->

                    <div class="tab-pane custom-tabContent" id="pickup" role="tabpanel">
                        <div class="pickupContent">
                            <div class="form-group">
                                <label>Select pickup area</label>
                                <div class="pickup_area_list">
                                    <label class="single_pickup_area" data-toggle="tooltip"
                                        title="" data-original-title="Dhaka">
                                        <i class="fa fa-location fz-14 mr-4"></i>
                                        Main store
                                        <input type="radio" name="pickup_point_id"
                                            class="d-none">
                                    </label>
                                    <label class="single_pickup_area" data-toggle="tooltip"
                                        title="" data-original-title="Point 1">
                                        <i class="fa fa-location fz-14 mr-4"></i>
                                        Point 1
                                        <input type="radio" name="pickup_point_id"
                                            class="d-none">
                                    </label>
                                    <label class="single_pickup_area" data-toggle="tooltip"
                                        title="" data-original-title="Point">
                                        <i class="fa fa-location fz-14 mr-4"></i>
                                        Point 2
                                        <input type="radio" name="pickup_point_id"
                                            class="d-none">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 p-0">
                                <label for="">Pickup Date <span
                                        class="error">*</span></label>
                                <div class="pickupCheckDate mt-5 mb-10">
                                    <label class="custom-radio">
                                        <input type="radio" class="pickup_check_input"
                                            name="today" data-id="1" value="1"
                                            checked>Today
                                    </label>
                                    <label class="ml-10 custom-radio">
                                        <input type="radio" class="pickup_check_input"
                                            name="today" data-id="1" value="2">Others
                                    </label>
                                </div>
                                <div class="pickupTime mt-20 mb-5" style="display: none;">
                                    <div class="input-group">
                                        <input type="date" name="pickup_date"
                                            class="form-control" readonly="readonly">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i
                                                    class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- pickup time area -->
                            <div class="form-group mt-5">
                                <div class="pickupTimeSlots">
                                    <label>Pickup time <span class="error">*</span></label>
                                    <div class="time_slots_list mt-10">

                                        <label class="single_timeSlots">
                                            <input type="radio" name="pickup_time"
                                                value="19:00 - 19:30" class="d-none">
                                            <i class="icofont-wall-clock"></i> 07:00 pm - 07:30 pm
                                        </label>

                                        <label class="single_timeSlots">
                                            <input type="radio" name="pickup_time"
                                                value="19:00 - 19:30" class="d-none">
                                            <i class="icofont-wall-clock"></i> 07:00 pm - 07:30 pm
                                        </label>

                                        <label class="single_timeSlots">
                                            <input type="radio" name="pickup_time"
                                                value="19:00 - 19:30" class="d-none">
                                            <i class="icofont-wall-clock"></i> 07:00 pm - 07:30 pm
                                        </label>

                                        <label class="single_timeSlots">
                                            <input type="radio" name="pickup_time"
                                                value="19:00 - 19:30" class="d-none">
                                            <i class="icofont-wall-clock"></i> 07:00 pm - 07:30 pm
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <!-- pickup time area -->
                        </div>
                    </div><!-- Pickup Time Area end./ -->

                    <div class="tab-pane custom-tabContent" id="dinein" role="tabpanel">
                        <div class="dineinSection">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="">Select Table</label>
                                    <select name="table_no" class="form-control table_no"
                                        id="table_no_2" data-id="1">
                                        <option value="">Select</option>
                                        <option value="1" data-size="5">Table - 1 / Inside -
                                            5
                                            person </option>
                                        <option value="3" data-size="5">Table - 2 / Inside -
                                            5
                                            person </option>
                                        <option value="4" data-size="2">Terrasse / Terrasse
                                            - 2
                                            person </option>
                                        <option value="7" data-size="10">Table - 3 / Terrasse
                                            -
                                            10 person </option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="">Select person</label>
                                    <select name="person" class="form-control"
                                        id="table_person">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="paycash" role="tabpanel"></div>
                </div>
            </div><!-- checkoutType -->
            <div class="row mt-30">
                <div class="form-group col-md-12">
                    <textarea name="comments" id="comments" class="form-control" cols="5" rows="5"
                        placeholder="comments"></textarea>
                </div>
            </div>
        </div><!-- card-body -->
    </div><!-- card -->

    <div class="card mt-50 mb-lg-0 mb-20">
        <div class="card-body">
            <label class="custom-checkbox">
                <input type="checkbox" name="terms" value="1">
                <span>I have read the <a href="#termsModal" class="decoration-none terms"
                        data-toggle="modal"> Terms &amp; Conditions </a> accept them</span>
            </label>
            <button type="submit" class="btn btn-primary w-100"><i
                    class="icofont-hand-drag2"></i>&nbsp; Place Order</button>
        </div>
    </div>
</form>
