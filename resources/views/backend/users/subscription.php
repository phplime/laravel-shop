<?php if ($active_package->is_expired == 1 || (day_left(_vtoday(_ID()), $active_package->expire_date)['days'] <= 5)): ?>
    <div class="row">
        <div class="col-md-4">
            <div class="callout callout-danger bg-danger d-flex align-center gap-20">
                <i class="icon fas fa-exclamation-triangle fz-2rm"></i>
                <div class="mt-5">
                    <h2><?= day_left(_vtoday(_ID()), $active_package->expire_date)['day_left']; ?> </h2>

                    <p><?= __('please_renewal_your_subscription'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php if (!empty($active_package)): ?>
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('backend/users/current_subscription_thumb', ['active_package' => $active_package, 'see_more' => true]); ?>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <?php
    $all_module_list = $this->default_m->select_result('module_list'); // Full list of all modules
    ?>
    <?php foreach ($package_list as $key => $row): ?>
        <?php $is_active_trial = (isset($active_package->package_id) && $active_package->package_id == $row->id && $row->package_type == "trial"); ?>

        <?php $moduleList = $this->admin_m->get_module_details(json_decode($row->module_ids)); ?>
        <?php if (($is_active_trial) || (!$is_active_trial && $row->package_type != "trial") && $row->package_type != "free" && $row->package_type != "lifetime"): ?>
            <div class="col-md-3">
                <div class="card <?= isset($active_package->package_id) && $active_package->package_id == $row->id  ? 'activePackage' : '' ?>">
                    <div class="card-body d-flex flex-column">
                        <div class="card-top-header bb-1 text-center d-flex flex-column align-items-center pb-10 mb-10">
                            <h4 class="card-title fz-3rm"><?= !empty(__($row->slug)) ? __($row->slug) : $row->package_name; ?></h4>
                            <h6 class="card-price text-center fz-20 mt-5">
                                <?php if (isset($row->previous_price) && !empty($row->previous_price)): ?>
                                    <span class="previous_price mr-5 fz-20"><?= currency_position($row->previous_price); ?></span>
                                <?php endif; ?>
                                <span class=""> <?= currency_position($row->price); ?></span> <span class="period"> / <?= $row->package_type; ?></span>
                            </h6>
                        </div>
                        <div class="card-details">
                            <div class="featureList">
                                <div class="featureList">
                                    <ul class="d-flex gap-10 flex-column">
                                        <?php foreach ($feature_list as  $key => $feature): ?>
                                            <?php $checked = in_array($feature->id, array_column($row->active_features, 'feature_id')) ? 'check text-success' : 'times text-danger'; ?>

                                            <li class="fz-1rm p-5 d-flex gap-10 align-center"> <i class="fas fa-<?= $checked; ?>"></i> <?= __($feature->slug)  ?></li>
                                        <?php endforeach; ?>
                                        <li class="fz-1rm p-5 d-flex gap-10 align-center"> <i class="fas fa-check text-success"></i> <b><?= $row->store_limit; ?></b> <?= __('store_max')  ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="moduleDetails">
                                <!-- Loop through all modules from the full list -->
                                <?php foreach ($all_module_list as $available_module): ?>
                                    <?php
                                    $module_found = false;
                                    $module_features = [];
                                    $module_order_types = [];

                                    foreach ($moduleList as $module) {
                                        if ($module->id == $available_module->id) {
                                            $module_found = true;
                                            $module_features = isset($module->module_features) ? $module->module_features : [];
                                            $module_order_types = isset($module->order_types) ? $module->order_types : [];
                                            break;
                                        }
                                    }
                                    ?>
                                    <p class="<?= $module_found ? 'bb-1' : ''; ?> pb-7 mt-10 mb-7 fz-20">
                                        <i class="fas <?= $module_found ? '' : 'fa-times text-danger'; ?>"></i>
                                        <?= __($available_module->slug); ?>
                                    </p>

                                    <?php if ($module_found): ?>
                                        <!-- Module Features -->
                                        <div class="moduleFeature">
                                            <ul class="d-flex flex-column">
                                                <?php if (!empty($module_features)): ?>
                                                    <?php foreach ($module_features as $feature): ?>
                                                        <li>
                                                            <i class="icofont-long-arrow-right"></i> <?= __($feature->slug); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <!-- Order Types -->
                                        <div class="orderTypes mt-10">
                                            <ul class="d-flex flex-column">
                                                <?php if (!empty($module_order_types)): ?>
                                                    <?php foreach ($module_order_types as $order_type): ?>
                                                        <li>
                                                            <i class="icofont-long-arrow-right"></i> <?= __($order_type->slug); ?>
                                                        </li>
                                                    <?php endforeach; ?>

                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div> <!-- moduleDetails -->
                        </div> <!-- card-details -->
                    </div> <!-- card-body -->
                    <div class="card-footer">
                        <?php if (isset($active_package->package_id) && ($row->id == $active_package->package_id)): ?>
                            <?php if ($active_package->is_payment == 0): ?>
                                <a href="<?= base_url("payment-method/{$u_info['username']}/{$active_package->package_slug}"); ?>" class="btn btn-info btn-block"> <?= __('pay_now'); ?> <i class="icofont-arrow-right ml-5"></i></a>
                            <?php else: ?>
                                <?php if ($active_package->is_expired == 1 || (day_left(_vtoday(_ID()), $active_package->expire_date)['days'] <= 5)): ?>
                                    <a href="<?= base_url("vendor/dashboard/upgrade/{$u_info['username']}/{$row->slug}"); ?>" class="btn btn-info btn-block"> <?= __('renew'); ?> <i class="icofont-arrow-right ml-5"></i></a>
                                <?php else: ?>
                                    <a href="javascript:;" class="btn btn-success btn-block"> <i class="icofont-check mr-5"></i> <?= __('running'); ?> </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= base_url("vendor/dashboard/upgrade/{$u_info['username']}/{$row->slug}"); ?>" class="btn btn-primary btn-block"> <?= __('upgrade'); ?> <i class="icofont-arrow-right ml-5"></i></a>
                        <?php endif; ?>
                    </div>
                </div> <!-- card -->
            </div> <!-- col-md-3 -->
        <?php endif; ?>
    <?php endforeach; ?>
</div>