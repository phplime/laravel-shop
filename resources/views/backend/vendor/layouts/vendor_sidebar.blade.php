<!-- Main Sidebar Container -->
<aside class="main-sidebar  sidebar-light-gray">
    <!-- Brand Logo -->
    <a href="javascript:;" class="h_50">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel vendorPanel pb-3 d-flex">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="vandorSingleModule bb-0">
                        <div class="image">
                            <img src="{{ asset('assets/backend/images/logo.jpg') }}" alt="shopLogo"
                                class="img-circle elevation-2 elevation-2 logo-light">
                        </div>
                        <div class="info">
                            shop
                        </div>
                    </div>
                    <i class="icofont-simple-down"></i>
                    <!-- /.fa fa-arrow-right -->
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="">
                        <div class="vandorSingleModule">
                            <div class="image">
                                <img src="{{ asset('assets/backend/images/logo.jpg') }}" class="img-circle elevation-2"
                                    alt="User Image">
                            </div>
                            <div class="info">
                                <h5>qmenu</h5>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="">
                        <div class="vandorSingleModule">
                            <div class="image">
                                <img src="{{ asset('assets/backend/images/logo.jpg') }}" class="img-circle elevation-2"
                                    alt="User Image">
                            </div>
                            <div class="info">
                                <h5>xmenu</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline hidden">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item ">
                    <a href="{{ url('vendor/dashboard') }}"
                        class="nav-link <?= isset($page_title) && $page_title == 'Dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> <?= __('dashboard') ?> </p>
                    </a>
                </li>

                <li class="nav-drawer-header"><?= __('orders') ?></li>

                <li class="nav-item ">
                    <a href="{{ url('vendor/order-list') }}"
                        class="nav-link <?= isset($page) && $page == 'Order' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p> <?= __('online_orders') ?></p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ url('vendor/all-orders-list') }}"
                        class="nav-link <?= isset($page) && $page == 'Orders' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cloud-meatball"></i>
                        <p> <?= __('vendor_order') ?></p>
                    </a>
                </li>

                <li class="nav-drawer-header"><?= __('settings') ?></li>
                <li class="nav-item ">
                    <a href="{{ url('vendor/settings') }}"
                        class="nav-link <?= isset($page) && $page == 'settings' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p> <?= __('settings') ?></p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a href="{{ url('vendor/settings/order_types') }}"
                        class="nav-link <?= isset($page) && $page == 'order config' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p> <?= __('order_configuration') ?></p>
                    </a>
                </li>

                <li class="nav-drawer-header"><?= __('items') ?></li>

                <li class="nav-item <?= isset($page) && $page == 'Products' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class=" nav-icon fab fa-product-hunt"></i>
                        <p>
                            <?= __('products') ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Products' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('item_products') ?> </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Categories' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('categories') ?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Sub Categories' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('subcategories') ?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Allergens' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('allergens') ?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Addon Library' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('addon_library') ?></p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-drawer-header"><?= __('communications') ?></li>

                <li class="nav-item <?= isset($page) && $page == 'Whatsapp' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-whatsapp"></i>
                        <p>
                            <?= __('whatsapp_config') ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Whatsapp Order' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('whatsapp_order') ?> </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-drawer-header"><?= __('users') ?></li>

                <li class="nav-item ">
                    <a href=""
                        class="nav-link <?= isset($page) && $page == 'Staff' ? 'active' : '' ?>">
                        <i class="nav-icon icofont-users-social"></i>
                        <p> <?= __('customers') ?></p>
                    </a>
                </li>

                <li class="nav-drawer-header"><?= __('others') ?></li>

                <li class="nav-item <?= isset($page) && $page == 'Reports' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="icofont-sound-wave nav-icon"></i>
                        <p>
                            <?= __('reports') ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link <?= isset($page_title) && $page_title == 'Item Statistics' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p><?= __('item') ?> <?= __('statistics') ?> </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link <?= isset($page_title) && $page_title == 'Order Reports' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p><?= __('order') ?> <?= __('reports') ?> </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?= isset($page) && $page == 'Pages' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="icofont-page nav-icon"></i>
                        <p>
                            <?= __('pages') ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Cookies' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('cookies_and_privacy') ?> </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Terms' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> <?= __('terms_and_condition') ?> </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="" class="nav-link <?= $page_title == 'Profile' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-plus"></i>
                        <p> <?= __('create_new_shop') ?> </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="" class="nav-link <?= isset($page) && $page == 'Subscriptions' ? 'active' : '' ?>">
                        <i class="nav-icon far fa-gem"></i>
                        <p> <?= __('subscriptions') ?></p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div id="mainContent">

                {{-- <script>
                    let numberFormat = `<?= __vsettings('number_format') ?>`;
                    let currencyPosition = '<?= __vsettings('currency_position') ?>';
                    let currencyIcon = ' <?= __vcountry(_ID())->currency_icon ?>';
                    let shopId = '<?= _ID() ?>';
                    let returnPrice = 0;

                    function showPrice(price) {
                        if (currencyPosition == 'right') {
                            returnPrice = currencyFormat(price) + ' ' + currencyIcon
                        } else {
                            returnPrice = currencyIcon + ' ' + currencyFormat(price);
                        }
                        return returnPrice;
                    }

                    function currencyFormat(price) {
                        if (numberFormat == 0) {
                            return parseFloat(price).toFixed(0)
                        } else {
                            return parseFloat(price).toFixed(2)
                        }
                    }
                </script> --}}
