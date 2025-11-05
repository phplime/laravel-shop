<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"><span class="fi fi-bd"></span> 0.3885</a>
        </li>
    </ul>
    <ul class="navbar-nav topCenterMenu">
        <li class="align-center">
            <a href=""
                class="nav-link <?= isset($page) && $page == 'Orders' ? 'active' : '' ?> align-center gap-5">
                <i class="nav-icon fas fa-cloud-meatball"></i>
                <p> <?= __('vendor_order') ?></p>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-center sm-menu">
        <li class="nav-item d-flex align-center">
            <a href="" target="_blank" class=" d-sm-inline-block btn ci-outline btn-sm"><i class="fa fa-eye"></i>
                <?= __('shop') ?></span> </a>
        </li>

        <!-- Navbar Search -->
        <li class="nav-item hidden">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown notificationThumb">
            @include('backend.vendor.layouts.notification_thumb')
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fi fi-en fz-14"></i> <span class="hidden-xs hidden-sm">English</span>
                <!-- <span class="badge badge-warning navbar-badge">english</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right langMenu">
                <a href="" class="dropdown-item">
                    <i class="fi fi-en"></i> English
                </a>
            </div>
        </li>

        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/backend/images/avatar.png') }}" class="user-image uploaded_img"
                    alt="User Image">
                <span class="hidden-xs hidden-sm">emran</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('assets/backend/images/avatar.png') }}"
                        class="img-circle uploaded_img" alt="User Image">
                    <p>
                        09 Apr, 2024 - 10:26 pm
                        <!-- <small id="time"></small> -->
                    </p>
                </li>
                <div class="text-center">
                    <small>Login - 03 Nov, 2025 - 12:24 pm</small>
                </div>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href=""
                        class="btn btn-default btn-flat float-left"><?= __('profile') ?></a>
                    <a href=""
                        class="btn btn-default btn-flat float-right"><?= __('profile') ?></a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
