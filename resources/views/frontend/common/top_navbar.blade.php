<div class="top-navbar-area">
    <div class="navbar-container">
        <div class="container">
            <div class="custom_navbar">
                <div class="navLeft_menu">
                    <a href="{{ route('Home', ['slug' => 'kinbo']) }}" class="navbar-brand logo">
                        <img src="{{ asset('frontend/images/logo.jpg') }}" alt="logo">
                    </a>
                    <div class="navbar-menu-area">
                        <ul class="navbar-items">
                            <li>
                                <a href="{{ route('Home', ['slug' => 'kinbo']) }}"
                                    class="{{ isset($data['page_title']) && $data['page_title'] == 'Home' ? 'active' : '' }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('Menu', ['slug' => 'kinbo']) }}"
                                    class="{{ isset($data['page_title']) && $data['page_title'] == 'Menu' ? 'active' : '' }}">Menu</a>
                            </li>
                            <li>
                                <a href="{{ route('Special', ['slug' => 'kinbo']) }}"
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
                                    <img class="sm-img" src="{{ asset('frontend/images/avatar.png') }}" alt="">
                                    <span class="name">Emran</span>
                                </button>
                                <div class="dropdown-menu customerInfoContainer" aria-labelledby="customerInfoDropdown">
                                    <a class="dropdown-item {{ isset($data['page_title']) && $data['page_title'] == 'My Orders' ? 'active' : '' }}"
                                        href="{{ route('my_orders', ['slug' => 'kinbo']) }}"><i
                                            class="icofont-cart fz-20"></i> My Orders</a>
                                    <a class="dropdown-item {{ isset($data['page_title']) && $data['page_title'] == 'Profile' ? 'active' : '' }}"
                                        href="{{ route('Profile', ['slug' => 'kinbo']) }}"><i
                                            class="fa-solid fa-user-gear"></i> My Profile</a>
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
            <a href="{{ route('Home', ['slug' => 'kinbo']) }}"
                class="{{ isset($data['page_title']) && $data['page_title'] == 'Home' ? 'active' : '' }}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('Menu', ['slug' => 'kinbo']) }}"
                class="fz-27 {{ isset($data['page_title']) && $data['page_title'] == 'Menu' ? 'active' : '' }}"><i
                    class="icofont-restaurant-menu"></i></a>
        </li>
        <li>
            <a href="{{ route('Special', ['slug' => 'kinbo']) }}"
                class="fz-24  {{ isset($data['page_title']) && $data['page_title'] == 'Special Items' ? 'active' : '' }}"><i
                    class="fa-solid fa-hand-holding-heart"></i></a>
        </li>
        <li>
            <a href="" class=""><i class="icofont-bell-alt"></i></a>
        </li>
        <li>
            <a href="{{ route('customer_login', ['slug' => 'kinbo']) }}"
                class="{{ (isset($data['page_title']) && $data['page_title'] == 'Login') || $data['page_title'] == 'Register' ? 'active' : '' }}"><i
                    class="fa fa-user-circle"></i></a>
        </li>
    </ul>
</div>
