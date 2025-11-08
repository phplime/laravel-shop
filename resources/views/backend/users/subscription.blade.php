@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="callout callout-danger bg-danger d-flex align-center gap-20">
                <i class="icon fas fa-exclamation-triangle fz-2rm"></i>
                <div class="mt-5">
                    <h2>5 day left </h2>

                    <p><?= __('please_renewal_your_subscription') ?></p>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-4">
            @include('backend.admin.auth.current_subscription_thumb')
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card activePackage">
                <div class="card-body d-flex flex-column">
                    <div class="card-top-header bb-1 text-center d-flex flex-column align-items-center pb-10 mb-10">
                        <h4 class="card-title fz-3rm">Pro</h4>
                        <h6 class="card-price text-center fz-20 mt-5">
                            <span class="previous_price mr-5 fz-20">$&nbsp;10</span>
                            <span class=""> $&nbsp;0</span> <span class="period"> / monthly</span>
                        </h6>
                    </div>
                    <div class="card-details">
                        <div class="featureList">
                            <div class="featureList">
                                <ul class="d-flex gap-10 flex-column">
                                    <li class="fz-1rm p-5 d-flex gap-10 align-center">
                                        <i class="fas fa-check text-success"></i> Landing page / Welcome page
                                    </li>
                                    <li class="fz-1rm p-5 d-flex gap-10 align-center">
                                        <i class="fas fa-check text-success"></i> Menu
                                    </li>
                                    <li class="fz-1rm p-5 d-flex gap-10 align-center">
                                        <i class="fas fa-check text-success"></i> WhatsApp Order
                                    </li>
                                    <li class="fz-1rm p-5 d-flex gap-10 align-center">
                                        <i class="fas fa-check text-success"></i> Digital/Online payment
                                    </li>
                                    <li class="fz-1rm p-5 d-flex gap-10 align-center">
                                        <i class="fas fa-check text-success"></i> <b>5</b> Store/vendor maximum
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Module Features -->
                        <div class="moduleDetails">
                            <!-- Loop through all modules from the full list -->
                            <p class="bb-1 pb-7 mt-10 mb-7 fz-20">
                                <i class="fas "></i>
                                Restaurant
                            </p>

                            <!-- Module Features -->
                            <div class="moduleFeature">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Allergens
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Veg types
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Variants
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Addons
                                    </li>
                                </ul>
                            </div>

                            <!-- Order Types -->
                            <div class="orderTypes mt-10">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Cash on delivery
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pickup / takeaway
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Dine-in
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pay cash
                                    </li>

                                </ul>
                            </div>

                            <p class="bb-1 pb-7 mt-10 mb-7 fz-20">
                                <i class="fas "></i>
                                Shop
                            </p>

                            <!-- Module Features -->
                            <div class="moduleFeature">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Variants
                                    </li>
                                </ul>
                            </div>

                            <!-- Order Types -->
                            <div class="orderTypes mt-10">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Cash on delivery
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pickup / takeaway
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pay cash
                                    </li>

                                </ul>
                            </div>

                            <p class="bb-1 pb-7 mt-10 mb-7 fz-20">
                                <i class="fas "></i>
                                Grocery
                            </p>

                            <!-- Module Features -->
                            <div class="moduleFeature">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Veg types
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Variants
                                    </li>
                                </ul>
                            </div>

                            <!-- Order Types -->
                            <div class="orderTypes mt-10">
                                <ul class="d-flex flex-column">
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Cash on delivery
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pickup / takeaway
                                    </li>
                                    <li>
                                        <i class="icofont-long-arrow-right"></i> Pay cash
                                    </li>

                                </ul>
                            </div>

                        </div><!-- moduleDetails -->
                    </div> <!-- card-details -->
                </div> <!-- card-body -->
                <div class="card-footer">
                    <a href="" class="btn btn-info btn-block">
                        <?= __('pay_now') ?> <i class="icofont-arrow-right ml-5"></i>
                    </a>
                    {{-- <a href="" class="btn btn-info btn-block">
                    <?= __('renew') ?> <i class="icofont-arrow-right ml-5"></i>
                </a>
                <a href="javascript:;" class="btn btn-success btn-block">
                    <i class="icofont-check mr-5"></i>
                    <?= __('running') ?>
                </a>
                <a href="" class="btn btn-primary btn-block">
                    <?= __('upgrade') ?> <i class="icofont-arrow-right ml-5"></i>
                </a> --}}
                </div>
            </div> <!-- card -->
        </div> <!-- col-md-3 -->
    </div>
@endsection
