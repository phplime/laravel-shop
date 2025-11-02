<div class="vendorContent">
    <div class="profileLeftMenu">
        <?php include "profile/profileMenu.php"; ?>
    </div>
    <div class="profilerightMenu">

        <div class="row">
            <?php foreach ($profile_list as $row) : ?>
                <?php $logoData = getLogo($row['vendor_id']); ?>
                <div class="col-md-4 mb-15">
                    <div class="card">
                        <div class="card-body text-center p-0">
                            <div class="single_profile">
                                <div class="singleProfileTop">
                                    <div class="imgArea p-r <?= imgRation($logoData['logo'] ?? '') ?>">

                                        <img src="<?= __image($logoData['logo_light'], 'thumb'); ?>" alt="shopLogo" class="profile_img logo-light">
                                        <img src="<?= __image($logoData['logo_dark'], 'thumb'); ?>" alt="shopLogo" class="profile_img logo-dark">
                                        <span class="cardIcon" data-toggle="tooltip" title="vCard">
                                            <i class="icofont-id-card"></i>
                                        </span>
                                    </div>
                                    <div class="profileDetails">
                                        <h4 class="fw-bold"><?= !empty($row['name']) ? $row['name'] : $row['username']; ?></h4>
                                        <p><?= !empty($row['dial_code']) ? $row['dial_code'] : ""; ?> <?= !empty($row['phone']) ? $row['phone'] : ""; ?></p>
                                    </div>
                                    <div class="mt-5">
                                        <label class="badge primary-light-active"><i class="icofont-diamond"></i> <?= $row['title']; ?></label>
                                    </div>
                                    <!-- /.mt-5 -->
                                </div>
                                <!-- /.singleProfileTop -->
                                <div class="buttonArea mt-10">
                                    <a href="<?= base_url($row['username']); ?>" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'editmodule_' . _x($row['vendor_id'])]); ?>
                                </div>
                            </div>
                            <?php if ($row['is_primary']) : ?>
                                <label class="is_primary badge-success"><i class="icofont-tack-pin"></i> <?= lang("primary"); ?> <?= active_vendor()->id; ?></label>
                            <?php endif; ?>
                        </div><!-- single_profile -->
                    </div>
                </div>
            <?php endforeach ?>
            <?php $my_total_vendor = $this->db->get_where('vendor_list', ['user_id' => auth('id')])->num_rows(); ?>
            <?php if ($my_total_vendor < $u_info->store_limit): ?>
                <div class="col-lg-4">
                    <div class="card">
                        <form method="POST" action="<?= base_url(" "); ?>" class="form-submit">
                            <?= csrf(); ?>
                            <div class="card-body">
                                <div class="card-content">

                                    <a href="<?= base_url("vendor/profile/onboarding") ?>">
                                        <div class="create_new_card">
                                            <i class="fa fa-plus"></i>
                                            <h4><?= __('create_new_store'); ?></h4>
                                        </div>
                                    </a>

                                </div><!-- card-content -->
                            </div><!-- card-body -->
                        </form><!-- from -->
                    </div><!-- card -->
                </div><!-- col-6 -->
            <?php endif; ?>

        </div><!-- row -->
    </div><!-- row -->
</div><!-- profilerightMenu -->
</div>

<?= __header(__('add_new'), base_url('vendor/profile/update_vendor_info'), 'addmodule'); ?>
<?php foreach ($module_list as $module) : ?>
    <div class="form-group">
        <label><?= __('module_list'); ?> <span class="error">*</span></label>
        <select name="module_id" class="form-control" id="module_id" onchange="changeModule(this.value)">
            <option value=""><?= __('select'); ?></option>
            <?php foreach ($module->module_list as $module_type) : ?>
                <option value="<?= $module_type->slug; ?>"><?= $module_type->title; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <?php foreach ($module->module_list as $modules) : ?>
        <div class="moduleDetails <?= $modules->slug; ?> dis_none mt-10">
            <div class="orderTypesArea">
                <h5><?= __('order_types'); ?></h5>
                <div class="mt-5">
                    <?php foreach ($modules->order_types as $key => $order_type) : ?>
                        <label class="label default-light-active "> <?= $order_type->title; ?> </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="orderTypesArea mt-5">
                <h5><?= __('attributes'); ?></h5>
                <?php foreach ($modules->module_features as $key => $module_feature) : ?>
                    <label class="label badge-soft-primary"> <?= $module_feature->feature_name; ?> </label>
                <?php endforeach; ?>
            </div>
            <!-- /.orderTypesArea -->
        </div>

    <?php endforeach; ?>
    <!-- /.moduleDetails -->
<?php endforeach; ?>
<div class="form-group">
    <label><?= __('username'); ?> <span class="error">*</span></label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
</div>
<div class="form-group">
    <label><?= __('email'); ?> <span class="error">*</span></label>
    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
</div>
<div class="form-group">
    <label><?= __('phone'); ?> <span class="error">*</span></label>
    <div class="ci-input-group input-group-append">
        <div class="input-group">
            <span>
                <span class="fi fi-<?= country($u_info->country_id)->code ?? '' ?> countryIcon"></span> +<?= $u_info->dial_code ?? ''; ?>
            </span>
        </div>
        <input type="hidden" name="dial_code" value="<?= $u_info->dial_code ?? ''; ?>">
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
    </div>

</div>

<?= hidden('id', 0); ?>
<?= __footer(); ?>



<?php foreach ($profile_list as $row) : ?>
    <?= __header(__('add_new'), base_url('vendor/profile/update_vendor_info'), 'editmodule_' . $row['vendor_id']); ?>
    <?php foreach ($module_list as $module) : ?>
        <div class="form-group">
            <label><?= __('module_list'); ?> <span class="error">*</span></label>
            <select name="module_id" class="form-control" id="module_id" onchange="changeModule(this.value)">
                <option value=""><?= __('select'); ?></option>
                <?php foreach ($module->module_list as $module_type) : ?>
                    <option value="<?= $module_type->slug; ?>" <?= __checked($row['module_id'], $module_type->slug, 'selected') ?>><?= $module_type->title; ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php foreach ($module->module_list as $modules) : ?>
            <div class="moduleDetails <?= $modules->slug; ?> dis_none mt-10">
                <div class="orderTypesArea">
                    <h5><?= __('order_types'); ?></h5>
                    <div class="mt-5">
                        <?php foreach ($modules->order_types as $key => $order_type) : ?>
                            <label class="label default-light-active "> <?= $order_type->title; ?> </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="orderTypesArea mt-5">
                    <h5><?= __('attributes'); ?></h5>
                    <?php foreach ($modules->module_features as $key => $module_feature) : ?>
                        <label class="label badge-soft-primary"> <?= $module_feature->feature_name; ?> </label>
                    <?php endforeach; ?>
                </div>
                <!-- /.orderTypesArea -->
            </div>

        <?php endforeach; ?>
        <!-- /.moduleDetails -->
    <?php endforeach; ?>

    <div class="form-group">
        <label><?= __('email'); ?> <span class="error">*</span></label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= __isset($row, 'email'); ?>">
    </div>
    <div class="form-group">
        <label><?= __('phone'); ?> <span class="error">*</span></label>
        <div class="ci-input-group input-group-append">
            <div class="input-group">
                <span>
                    <span class="fi fi-<?= country(__vsettings('country_id'))->code ?? $u_info->country_id ?? 0; ?> countryIcon"></span> +<?= __vsettings('dial_code') ?? $u_info->dial_code ?? ''; ?>

                </span>
            </div>
            <input type="hidden" name="dial_code" value="<?= __vsettings('dial_code') ?? $u_info->dial_code; ?>">
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="<?= __isset($row, 'phone'); ?>">
        </div>

    </div>

    <?= hidden('id', __isset($row, 'vendor_id', 0)); ?>
    <?= __footer(); ?>
<?php endforeach; ?>

<script>
    function changeModule(slug) {
        $('.moduleDetails').slideUp();
        $(`.moduleDetails.${slug}`).slideDown();
    }
</script>