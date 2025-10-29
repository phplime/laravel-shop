@extends('frontend.baseapp')

@section('content')
    <section class="hero-SliderSection relative">
        <div class="container w-full h-full flex align-center">
            <div class="topSlider_wrap">
                <div class="hero-bannerWrap" style="background-image: url('{{ asset('frontend/images/hero-banner1.jpg') }}')">
                </div>
                <div class="hero-bannerWrap" style="background-image: url('{{ asset('frontend/images/hero-banner2.jpg') }}')">
                </div>
                <div class="hero-bannerWrap" style="background-image: url('{{ asset('frontend/images/hero-banner3.jpg') }}')">
                </div>
            </div>
        </div>
    </section>

    <!-- Category List  -->
    @include('frontend.pages.category_list')
    <!-- Category List  -->

    <div class="full-wrapper">
        <div class="container">

            <section class="popularItems_section">
                <div class="sectionTitle">
                    <h4 class="title underlineStyle">Most Popular Items</h4>
                </div>

                <div class="popularItems_slider">

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType veg">Vegetable</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                </div>

            </section>
            <!------------------------
                            Popular Items Area End
                        --------------------------------->


            <section class="featureItems_section">
                <div class="sectionTitle flex align-center space-between">
                    <h4 class="title underlineStyle">Recommended For You</h4>
                    <a href="{{ route('all_items', ['slug' => 'kinbo']) }}" class="sell_btn">See all</a>
                </div>
                <div class="masonry-container">

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType veg">Vegetable</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                    <div class="masonry-item itemView" data-id="1">
                        <div class="card">
                            <div class="itemImage"
                                style="background-image: url('{{ asset('frontend/images/food2.jpg') }}')">
                                <span class="vegType nonVeg">Non-Veg</span>
                            </div>
                            <div class="itemDetails">
                                <h5 class="itemName">Card title that wraps to a new line</h5>
                                <p class="itemInfo">This is a longer card with supporting text below as a natural lead-in
                                    to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="itemFooter space-between align-center">
                                <div class="price">
                                    <span class="itemPrice">$12.00</span> <span class="previous_price">17.00 $</span>
                                </div>
                                <a href="javascript:;" class="btn itemAdd itemView sm-d-none" data-id="1"> <i
                                        class="fas fa-shopping-bag"></i>
                                    Add</a>
                                <a href="javascript:;" class="btn sm-itemAdd itemView" data-id="1"> <i
                                        class="icofont-plus"></i></a>
                            </div>
                        </div>
                    </div><!-- masonry-item -->

                </div>
            </section>
            <!------------------------
                                Feature Items Area End
                            --------------------------------->



            <section class="offerSection">
                <div class="sectionTitle ">
                    <h4 class="title underlineStyle">Offers</h4>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a href="">
                            <div class="offerBanner"
                                style="background-image: url('{{ asset('frontend/images/hero-banner1.jpg') }}')"></div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a href="">
                            <div class="offerBanner"
                                style="background-image: url('{{ asset('frontend/images/hero-banner1.jpg') }}')"></div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a href="">
                            <div class="offerBanner"
                                style="background-image: url('{{ asset('frontend/images/hero-banner1.jpg') }}')"></div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a href="">
                            <div class="offerBanner"
                                style="background-image: url('{{ asset('frontend/images/hero-banner1.jpg') }}')"></div>
                        </a>
                    </div>
                </div>
            </section>
            <!------------------------
                        Offers Items Area End
                    --------------------------------->


            <section class="specialItemsSection">
                <div class="sectionTitle flex align-center space-between">
                    <h4 class="title underlineStyle">Our Special Dishes</h4>
                    <a href="" class="sell_btn">See all</a>
                </div>
                <div class="row specialRow">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="specialItemContent">
                            <div class="topImage">
                                <img src="{{ asset('frontend/images/food5.jpg') }}" alt="image">
                            </div>
                            <div class="itemDetails">
                                <h6 class="name">Burger</h6>
                                <p class="text m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis,
                                    consequatur expedita. Vel, recusandae! Sit, voluptate?</p>
                            </div>
                            <div class="specialItem_footer space-between align-center">
                                <span class="price">$12.00</span>
                                <a href="javascript:;" class="btn itemAdd "> <i class="fas fa-shopping-bag"></i>
                                    Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="specialItemContent">
                            <div class="topImage">
                                <img src="{{ asset('frontend/images/food5.jpg') }}" alt="image">
                            </div>
                            <div class="itemDetails">
                                <h6 class="name">Burger</h6>
                                <p class="text m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis,
                                    consequatur expedita. Vel, recusandae! Sit, voluptate?</p>
                            </div>
                            <div class="specialItem_footer space-between align-center">
                                <span class="price">$12.00</span>
                                <a href="javascript:;" class="btn itemAdd "> <i class="fas fa-shopping-bag"></i>
                                    Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="specialItemContent">
                            <div class="topImage">
                                <img src="{{ asset('frontend/images/food5.jpg') }}" alt="image">
                            </div>
                            <div class="itemDetails">
                                <h6 class="name">Burger</h6>
                                <p class="text m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis,
                                    consequatur expedita. Vel, recusandae! Sit, voluptate?</p>
                            </div>
                            <div class="specialItem_footer space-between align-center">
                                <span class="price">$12.00</span>
                                <a href="javascript:;" class="btn itemAdd "> <i class="fas fa-shopping-bag"></i>
                                    Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="specialItemContent">
                            <div class="topImage">
                                <img src="{{ asset('frontend/images/food5.jpg') }}" alt="image">
                            </div>
                            <div class="itemDetails">
                                <h6 class="name">Burger</h6>
                                <p class="text m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis,
                                    consequatur expedita. Vel, recusandae! Sit, voluptate?</p>
                            </div>
                            <div class="specialItem_footer space-between align-center">
                                <span class="price">$12.00</span>
                                <a href="javascript:;" class="btn itemAdd "> <i class="fas fa-shopping-bag"></i>
                                    Add to Cart</a>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div><!-- Container -->
    </div><!-- Full Wrapper./ -->
@endsection
