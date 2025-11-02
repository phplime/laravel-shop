 <div class="card">
     <div class="card-header">
         <h4 class="card-title"><?= __('active_package') ?></h4>
     </div>
     <div class="card-body">
         <ul class="activePackage_list d-flex flex-column gap-10">
            <li>
                <span><?= __('package_name') ?></span> <span> pro</span>
            </li>
            <li>
                <span><?= __('price') ?></span> <span>$40</span>
            </li>
            <li>
                <span><?= __('billing_cycle') ?></span> <span> <span> Yearly</span></span>
            </li>
            <li>
                <span><?= __('last_billing') ?></span> <span>2025-08-14 16:54:09</span>
            </li>
            <li>
                <span><?= __('expire_date') ?></span> <span> 14 Aug 2026 (<b>286 Days left</b>)</span>
            </li>
            <li>
                 <span><?= __('payment_status') ?></span> <span>
                     <label class="label badge-success"><i class="fa fa-check"></i>
                         <?= lang('running') ?></label>
                     {{-- <label class="label badge-danger"> <i class="fa fa-ban"></i>
                         <?= lang('expired') ?></label>
                     <label class="label badge-warning"><i class="fa fa-spinner"></i>
                         <?= lang('pending') ?></label>
                     <label class="label badge-danger"><?= lang('expired') ?></label> --}}
                 </span>
            </li>
            <li>
                <span><?= __('payment_method') ?></span> <span>Stripe</span>
            </li>
            <li>
                <a href="{{ url('subscription-invoice/62374523') }}" target="blank" class="dcolor"><span><?= __('invoice') ?></span> <span> <i class="far fa-file-pdf"></i></span></a>
            </li>
            {{-- <li class="justify-content-center dcolor"><a href="" class="justify-content-center dcolor"><?= __('seemore') ?> <i class="icofont-arrow-right ml-5"></i>
                 </a>
            </li> --}}
         </ul>
     </div>
 </div>
