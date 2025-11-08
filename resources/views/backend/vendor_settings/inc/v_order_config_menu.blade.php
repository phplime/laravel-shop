<div class="col-lg-3 sidebarStyle">
    <?php
    __adminMenu(
        [
            ['title' => __('order_types-configuration'), 'url' => 'vendor/settings/order-types', 'icon' => 'fa fa-arrow-right', '_title' => 'order types Configuration', 'page_title' => $page_title ?? ''],

            ['title' => __('order_configuration'), 'url' => 'vendor/settings/order-configuration', 'icon' => 'fa fa-arrow-right', '_title' => 'Order Configuration', 'page_title' => $page_title ?? ''],

            ['title' => __('item-configuration'), 'url' => 'vendor/settings/item-configuration', 'icon' => 'fa fa-arrow-right', '_title' => 'Item Configuration', 'page_title' => $page_title ?? ''],

            ['title' => __('tax-configuration'), 'url' => 'vendor/settings/tax-configuration', 'icon' => 'fa fa-arrow-right', '_title' => 'Tax Configuration', 'page_title' => $page_title ?? ''],
        ]
    );
    ?>
</div>
