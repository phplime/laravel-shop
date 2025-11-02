<nav class="main-header navbar navbar-expand <?= __vsettings('theme') == "dark" ? "navbar-dark navbar-dark" : "navbar-white navbar-light"; ?> ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <?php if (env('CI_ENV') == 'development'): ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link"><span class="fi fi-<?= country(__vsettings('country_id'), _ID())->code ?>"></span> {elapsed_time}</a>
            </li>
        <?php endif; ?>
    </ul>
    <ul class="navbar-nav topCenterMenu">
        <li class="align-center">
            <a href="<?= base_url('vendor/order/all_order_list'); ?>" class="nav-link <?= isset($page) && $page == 'Orders' ? 'active' : ''; ?> align-center gap-5">
                <i class="nav-icon fas fa-cloud-meatball"></i>
                <p> <?= __('vendor_order'); ?></p>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-center sm-menu">
        <li class="nav-item d-flex align-center">
            <a href="<?= base_url(auth('vendor_username') ?? auth('username')) ?>" target="_blank" class=" d-sm-inline-block btn ci-outline btn-sm"><i class="fa fa-eye"></i> <?= __('shop'); ?></span> </a>
        </li>

        <!-- Navbar Search -->
        <li class="nav-item hidden">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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
            <?php include VIEWPATH . "backend/inc/_users/notification_thumb.php"; ?>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fi fi-<?= show_language(get_lang())['flag']; ?> fz-14"></i> <span class="hidden-xs hidden-sm"><?= show_language(get_lang())['language_name']; ?></span>
                <!-- <span class="badge badge-warning navbar-badge">english</span> -->
            </a>
            <?php $languages = $this->home_m->get_vendor_language_list(_ID(), 'vendor'); ?>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right langMenu">
                <?php foreach ($languages as  $key => $ln) : ?>
                    <a href="<?= base_url('home/switch/' . $ln['slug']); ?>" class="dropdown-item">
                        <i class="fi fi-<?= strtolower($ln['iso2']); ?>"></i> <?= _x($ln['language_name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </li>

        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url('app/assets/backend/img/user1-128x128.jpg'); ?>" class="user-image uploaded_img" alt="User Image">
                <span class="hidden-xs hidden-sm"><?= auth('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="<?= base_url('app/assets/backend/img/user1-128x128.jpg'); ?>" class="img-circle uploaded_img" alt="User Image">
                    <p>
                        <?= full_time(users()->created_at) ?></small>
                        <!-- <small id="time"></small> -->
                    </p>
                </li>
                <div class="text-center">
                    <small><?= __('login'); ?> - <?= full_time(users()->login_time) ?></small>
                </div>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="<?= base_url("vendor/profile/"); ?>" class="btn btn-default btn-flat float-left"><?= __('profile'); ?></a>
                    <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat float-right"><?= __('profile'); ?></a>
                </li>
            </ul>
        </li>
    </ul>
</nav>