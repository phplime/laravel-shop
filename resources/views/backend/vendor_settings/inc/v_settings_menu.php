<?php $menu_style = __vsettings('menu_style') == 'topmenu' ? true : false; ?>
<div class="<?= isset($menu_style) && $menu_style == TRUE ? "menuStyle " . (isset($col) ? $col : '') : "col-lg-3 sidebarStyle" ?>">

    <?php
    $menu_items = [
        ['title' => __('settings'), 'url' => 'vendor/settings', 'icon' => 'fa fa-cog', '_title' => 'Settings', 'page_title' => $page_title ?? ''],

        ['title' => __('general'), 'url' => 'vendor/settings/general', 'icon' => 'fas fa-user-cog', '_title' => 'General Settings', 'page_title' => $page_title ?? ''],

        ['title' => __('email_settings'), 'url' => 'vendor/settings/email_settings', 'icon' => 'icofont-envelope', '_title' => 'Email Settings', 'page_title' => $page_title ?? ''],

        ['title' => __('apperence'), 'url' => 'vendor/settings/apperence', 'icon' => 'fas fa-paint-brush', '_title' => 'Apperence', 'page_title' => $page_title ?? ''],

        ['title' => __('available_days'), 'url' => 'vendor/settings/available_days', 'icon' => 'fas fa-calendar-check', '_title' => 'Available Days', 'page_title' => $page_title ?? ''],
    ];


    if (__isPackage('digital_payment')) {
        $menu_items[] = [
            'title' => __('payment_settings'),
            'url' => 'vendor/settings/payment_settings',
            'icon' => 'fas fa-credit-card',
            '_title' => 'Payment Settings',
            'page_title' => $page_title ?? '',
        ];
    }

    // Add remaining menu items
    $menu_items[] = ['title' => __('slider'), 'url' => 'vendor/settings/slider', 'icon' => 'fas fa-sliders-h', '_title' => 'Slider', 'page_title' => $page_title ?? ''];

    $menu_items[] = ['title' => __('qrcode'), 'url' => 'vendor/settings/qrcode', 'icon' => 'fas fa-qrcode', '_title' => 'QR code', 'page_title' => $page_title ?? ''];

    // Pass the menu array to the function
    __adminMenu($menu_items);
    ?>




</div>