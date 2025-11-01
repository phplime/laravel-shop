<div class="top-navbar-area">
    <div class="navbar-container">
        <div class="container">
            <div class="custom_navbar">
                <div class="navLeft_menu">
                    <a href="{{ url('kinbo') }}" class="navbar-brand logo">
                        <img src="{{ asset('assets/frontend/images/logo.jpg') }}" alt="logo">
                    </a>
                    <div class="navbar-menu-area">
                        <ul class="navbar-items">
                            <li>
                                <a href="{{ url('kinbo') }}"
                                    class="{{ isset($data['page_title']) && $data['page_title'] == 'Home' ? 'active' : '' }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ url('menu/kinbo') }}"
                                    class="{{ isset($data['page_title']) && $data['page_title'] == 'Menu' ? 'active' : '' }}">Menu</a>
                            </li>
                            <li>
                                <a href="{{ url('special/items/kinbo') }}"
                                    class="{{ isset($data['page_title']) && $data['page_title'] == 'Special Items' ? 'active' : '' }}">Special</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="navRight_action">
                    <ul class="navAction_btn">
                        <li class="topSearchInput">
                            <form action="" method="post">
                                <div class="items_search_input">
                                    <input type="search" name="search_item" class="search"
                                        placeholder="Search for items...">
                                    <button type="submit" class="btn"><i class="icofont-search"></i></button>
                                </div>
                            </form>
                        </li>
                        <li>
                            <button type="submit" class="itemSearch_btn"><i class="icofont-search-1"></i></button>
                        </li>
                        <li>
                            <div class="shoppingCart_btn">
                                <a href="javascript:;" class="btn openCartBtn">
                                    <i class="icofont-cart-alt"></i>
                                </a>
                                <span class="countCart_item">5</span>
                            </div>
                        </li>
                        {{-- <li>
                            <a href="{{ route('customer_login', ['slug' => 'kinbo']) }}" class="btn dz_login_btn"><i
                                    class="fa-regular fa-user-circle"></i> Login</a>
                        </li> --}}
                        <li>
                            <div class="dropdown topNavbar-dropdown">
                                <button class="btn nav-dropBtn dropdown-toggle" type="button" id="customerInfoDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="sm-img" src="{{ asset('assets/frontend/images/avatar.png') }}"
                                        alt="">
                                    <span class="name">Emran</span>
                                </button>
                                <div class="dropdown-menu customerInfoContainer" aria-labelledby="customerInfoDropdown">
                                    <a class="dropdown-item {{ isset($data['page_title']) && $data['page_title'] == 'My Orders' ? 'active' : '' }}"
                                        href="{{ url('my_orders/kinbo') }}"><i class="icofont-cart fz-20"></i> My
                                        Orders</a>
                                    <a class="dropdown-item {{ isset($data['page_title']) && $data['page_title'] == 'Profile' ? 'active' : '' }}"
                                        href="{{ url('my_profile/kinbo') }}"><i class="fa-solid fa-user-gear"></i> My
                                        Profile</a>
                                    <a class="dropdown-item" href="#"><i class="icofont-logout"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Responsive Navbar -->
<div class="bottomNavbarMenu">
    <ul class="bottomNavItems">
        <li>
            <a href="{{ url('kinbo') }}"
                class="{{ isset($data['page_title']) && $data['page_title'] == 'Home' ? 'active' : '' }}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="{{ url('menu/kinbo') }}"
                class="fz-27 {{ isset($data['page_title']) && $data['page_title'] == 'Menu' ? 'active' : '' }}"><i
                    class="icofont-restaurant-menu"></i></a>
        </li>
        <li>
            <a href="{{ url('special/items/kinbo') }}"
                class="fz-24  {{ isset($data['page_title']) && $data['page_title'] == 'Special Items' ? 'active' : '' }}"><i
                    class="fa-solid fa-hand-holding-heart"></i></a>
        </li>
        <li>
            <a href="" class=""><i class="icofont-bell-alt"></i></a>
        </li>
        <li>
            <a href="javascript:;" class="customer_profile"><i class="fa fa-user-circle"></i></a>
        </li>
    </ul>
</div>


<aside class="sm_customerInfo_sidebar">
    <div class="customer_info_container">
        <div class="info_header">
            <img src="{{ asset('assets/backend/images/avatar.png') }}" alt="">
            <div class="mt-10 customerInfoText">
                <h6>Emran hossain</h6>
                <p>emran@gmail.com</p>
            </div>
        </div>
        <div class="info_body">
            <ul class="info_items">
                <li>
                    <a href="{{ url('my_orders/kinbo') }}">
                        <i class="icofont-cart fz-20"></i> My Orders
                    </a>
                </li>
                <li>
                    <a href="{{ url('my_profile/kinbo') }}">
                        <i class="fa-solid fa-user-gear"></i> My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ url('my_orders/kinbo') }}">
                        <i class="icofont-logout"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>


<script>
    $(function() {
        $(document).on('click', '.customer_profile', function(s) {
            s.stopPropagation();
            $('.sm_customerInfo_sidebar').toggleClass('show');
        })

        $(document).on('click', function(s) {
            let sidebar = $('.sm_customerInfo_sidebar');
            if (!sidebar.is(s.target) && sidebar.has(s.target).length === 0) {
                sidebar.removeClass('show');
            }
        })
    })
</script>
