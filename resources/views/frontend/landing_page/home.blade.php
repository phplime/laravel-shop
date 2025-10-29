<x-frontend-layout>
    @include('frontend.landing_page.home_menu')
    <section class="home-heroSection">
        <div class="home_heroContainer">
            <div class="hero_leftContent" data-aos="zoom-in" data-aos-delay="1000">
                <h1 class="">Welcome to our communities!!</h1>
                <h4>Create Your Dreams Shop / Restaurant.</h4>
                <a href="" class="btn getStart_btn"><i class="icofont-hand-drawn-right"></i> Get Start</a>
            </div>
            <div class="hero_rightContent" style="background-image: url('{{ asset('frontend/images/suggest.jpeg') }}');">
                <img data-aos="zoom-in" data-aos-delay="1000" src="{{ asset('frontend/images/freame1.png') }}"
                    alt="image">
            </div>
        </div>
    </section>

    <!-- Service Section -->
    <section class="ourService_section">
        <div class="container">
            <div class="section-title">
                <h4 class="title">Site Related Services</h4>
            </div>
            <div class="row">

                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="serviceBox">
                        <div class="icon-img">
                            <img src="{{ asset('frontend/images/service3.jpeg') }}" alt="img">
                        </div>
                        <div class="content">
                            <h5>24 Hours Service</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit dicta dolores
                                nobis
                                ipsam, culpa totam fuga consequatur autem? Amet?</p>
                        </div>
                    </div>
                </div><!-- col./ -->

                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="serviceBox">
                        <div class="icon-img">
                            <img src="{{ asset('frontend/images/service1.jpeg') }}" alt="img">
                        </div>
                        <div class="content">
                            <h5>Easy To Pay</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit dicta dolores
                                nobis
                                ipsam, culpa totam fuga consequatur autem? Amet?</p>
                        </div>
                    </div>
                </div><!-- col./ -->

                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="serviceBox">
                        <div class="icon-img">
                            <img src="{{ asset('frontend/images/service2.png') }}" alt="img">
                        </div>
                        <div class="content">
                            <h5>Secure Payment Method</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit dicta dolores
                                nobis
                                ipsam, culpa totam fuga consequatur autem? Amet?</p>
                        </div>
                    </div>
                </div><!-- col./ -->

            </div>
        </div>
    </section><!-- Site Related Services./ -->


    <section class="shop_serviceSection">
        <div class="container">
            <div class="section-title">
                <h4 class="title">Restaurant / Shop Related Services</h4>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="serviceContainer">
                        <div class="serviceImage">
                            <img src="{{ asset('frontend/images/app-design2.jpeg') }}" alt="img">
                        </div>
                        <div class="serviceDetails">
                            <div class="top_service">
                                <h3>Secure Payments &amp; Billing</h3>
                            </div>
                            <div class="service_details">
                                <p>• Secure Payment Gateway Integration: Stripe, PayPal, Razorpay, and more&nbsp;</p>
                                <p>• Multiple Payment Options: Credit/debit cards, bank transfers, digital wallets&nbsp;
                                </p>
                                <p>• Instant Payment Confirmation: Automatic email or notification after successful
                                    payment
                                </p>
                                <p>• Invoice Generation: PDF receipts for every transaction</p>
                                <p>• Subscription Management: Auto-renew, pause, upgrade, or downgrade anytime&nbsp;</p>
                                <p><br>Enjoy a seamless, safe, and flexible billing experience for your business and
                                    customers.</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="serviceContainer flex-row-reverse">
                        <div class="serviceImage">
                            <img src="{{ asset('frontend/images/app-design1.jpeg') }}" alt="img">
                        </div>
                        <div class="serviceDetails">
                            <div class="top_service">
                                <h3>Secure Payments &amp; Billing</h3>
                            </div>
                            <div class="service_details">
                                <p>• Secure Payment Gateway Integration: Stripe, PayPal, Razorpay, and more&nbsp;</p>
                                <p>• Multiple Payment Options: Credit/debit cards, bank transfers, digital wallets&nbsp;
                                </p>
                                <p>• Instant Payment Confirmation: Automatic email or notification after successful
                                    payment
                                </p>
                                <p>• Invoice Generation: PDF receipts for every transaction</p>
                                <p>• Subscription Management: Auto-renew, pause, upgrade, or downgrade anytime&nbsp;</p>
                                <p><br>Enjoy a seamless, safe, and flexible billing experience for your business and
                                    customers.</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- Shop Service Area ./ -->
    @include('frontend.landing_page.pricing')
</x-frontend-layout>
