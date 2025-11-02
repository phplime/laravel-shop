 <?php $totalRingingOrder = $this->vendor_m->get_new_orders(_ID(), true); ?>
 <?php $totalOrder = $this->vendor_m->get_new_orders(_ID(), true); ?>

 <a class="nav-link notificationBtn" data-toggle="dropdown" href="javascript:;">
     <i class="far fa-bell"></i>
     <?php if (count($totalRingingOrder) > 0): ?>
         <span class="badge badge-danger navbar-badge"><?= count($totalRingingOrder) ?? 0 ?></span>
     <?php endif; ?>
 </a>
 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

     <a href="<?= base_url("vendor/orders") ?>" class="dropdown-item">
         <i class="icofont-live-support fz-16 text-aqua"></i> <b><?= count($totalOrder) ?? 0 ?></b> <?= __('todays_order'); ?>
     </a>

     <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->
 </div>