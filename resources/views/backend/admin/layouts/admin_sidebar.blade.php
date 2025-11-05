<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-gray">
    <!-- Brand Logo -->
    <a href="javacript:;" class="h_50">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link <?= isset($page_title) && $page_title == 'Dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/user_list') }}"
                        class="nav-link <?= isset($page_title) && $page_title == 'User List' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Subscribers
                        </p>
                    </a>
                </li>

                <li class="nav-item <?= isset($page) && $page == 'Packages' ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-cloud-meatball"></i>
                        <p>
                            plan packages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/admin/package') }}"
                                class="nav-link <?= isset($page_title) && $page_title == 'Packages' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>
                                    Plan / Packages
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('admin/feature') }}"
                                class="nav-link <?= isset($page_title) && $page_title == 'Features' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>
                                    Features
                                </p>
                            </a>
                        </li>
                    </ul>

                </li>


                <li class="nav-item <?= isset($page) && $page == 'Home' ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'How it works' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>
                                    How it works
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Services' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>
                                    Services
                                </p>
                            </a>
                        </li>
                    </ul>

                </li>



                <li class="nav-item <?= isset($page) && $page == 'Settings' ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'General Settings' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> Site settings </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href=""
                                class="nav-link <?= isset($page_title) && $page_title == 'Security Settings' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> security settings </p>
                            </a>
                        </li>
                    </ul>

                </li>



                <li class="nav-item ">
                    <a href="" class="nav-link <?= isset($page) && $page == 'Module' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-wind"></i>
                        <p>
                            Module list
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ isset($page) && $page == 'Language' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-language"></i>
                        <p>
                            {{ __('langauge') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ url('admin/language-list') }}"
                                class="nav-link {{ isset($page_title) && $page_title == 'Language List' ? 'active' : '' }} ">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                @lang('language_list')
                            </a>
                        </li>


                        <li class="nav-item ">
                            <a href="{{ url('admin/language-data') }}"
                                class="nav-link <?= isset($page_title) && $page_title == 'Language Data' ? 'active' : '' ?>">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                @lang('language_data')
                            </a>
                        </li>


                    </ul>

                </li>

                <li class="nav-item">
                    <a href=""
                        class="nav-link <?= isset($page_title) && $page_title == 'Payments' ? 'active' : '' ?>">
                        <i class="nav-icon fab fa-google-wallet"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=""
                        class="nav-link <?= isset($page_title) && $page_title == 'App Info' ? 'active' : '' ?>">
                        <i class="nav-icon icofont-info-circle"></i>
                        <p>
                            App Info
                        </p>
                    </a>
                </li>



                <li class="nav-item hidden">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
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
