<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="headerSection">
            <h4><?= __('setup_guide'); ?></h4>
            <p><?= __('follow_the_setps_below_to_get_started'); ?></p>
        </div>
    </div>
</div>

<?php
$guideArray = [
    [
        'title' => 'Add Your First Product',
        'description' => __("add_your_first_product_description"),
        'btn' => __("add_product"),
        'url' => base_url('vendor/products'),
    ],
    [
        'title' => __('set_up_order_types'),
        'description' => __('set_up_order_types_description'),
        'btn' => __('configuration'),
        'url' => base_url("vendor/settings/order_types"),
    ],
    [
        'title' => __('configure_delivery'),
        'description' => __('set_up_delivery_description'),
        'btn' => __('add_delivery'),
        'url' => base_url("vendor/settings/order_type_settings/cod"),
    ],
    [
        'title' => __('configure_payment_methods'),
        'description' => __('configure_payment_methods_description'),
        'btn' => __('add_payment_method'),
        'url' => base_url("vendor/settings/payment_settings"),
    ],
];

?>

<div class="row justify-content-center mt-20">
    <div class="col-md-8">
        <?php foreach ($guideArray as  $key => $value): ?>
            <div class="card">
                <div class="card-body">
                    <div class="guideStep d-flex space-between align-center gap-10">
                        <div class="stepTopArea d-flex align-center gap-20">
                            <div class="step">
                                <?= $key + 1; ?>
                            </div>
                            <div class="stepDetails">
                                <h4> <?= $value['title'] ?></h4>
                                <p><?= $value['description']; ?></p>
                            </div>
                        </div>

                        <div class="stepBtn">
                            <a href="<?= $value['url']; ?>" target="_blank" class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= $value['btn']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>