@php
$menu_style = __settings('menu_style') == 1 ? true : false;
@endphp

<div class="{{ isset($menu_style) && $menu_style == true ? 'menuStyle ' . ($col ?? '') : 'col-lg-3 sidebarStyle' }}">
    <?php
    __adminMenu([
        [
            'title' => __('general_settings'),
            'url' => 'admin/settings',
            'icon' => 'fas fa-cog',
            '_title' => 'General Settings',
            'page_title' => $page_title ?? ''
        ],
        [
            'title' => __('preferences'),
            'url' => 'admin/settings/preferences',
            'icon' => 'icofont-badge',
            '_title' => 'preferences Settings',
            'page_title' => $page_title ?? ''
        ],
        [
            'title' => __('email_settings'),
            'url' => 'admin/settings/email_settings',
            'icon' => 'icofont-envelope',
            '_title' => 'Email Settings',
            'page_title' => $page_title ?? ''
        ],
        [
            'title' => __('payment_settings'),
            'url' => 'admin/settings/payment_settings',
            'icon' => 'fas fa-credit-card',
            '_title' => 'Payment Settings',
            'page_title' => $page_title ?? ''
        ],
        [
            'title' => __('landingpage'),
            'url' => 'admin/settings/landingpage',
            'icon' => 'fas fa-laptop',
            '_title' => 'landing page',
            'page_title' => $page_title ?? ''
        ],
        [
            'title' => __('contacts'),
            'url' => 'admin/settings/contacts',
            'icon' => 'icofont-live-support',
            '_title' => 'contacts',
            'page_title' => $page_title ?? ''
        ],
    ]);
    ?>
</div>