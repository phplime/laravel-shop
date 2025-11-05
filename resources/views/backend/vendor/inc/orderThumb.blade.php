<div class="card-content">
    <div class="table-responsive responsiveTable">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= __('order_id') ?></th>
                    <th><?= __('customer') ?></th>
                    <th><?= __('overview') ?></th>
                    <th><?= __('status') ?></th>
                    <th><?= __('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="#">1</td>
                    <td data-label="<?= __('order_id') ?>">
                        <a href="">#2729472824</a>
                        <div>
                            <small class="text-warning">1 Months ago </small>
                        </div>
                    </td>
                    <td data-label="<?= __('customer') ?>">
                        <div class="customerInfo">
                            <div class="customerInfo d-flex align-center">
                                <span class="customer-avatar">P</span>
                                <div class="customer-text">
                                    <p class="mb-0"><strong>Name:</strong> <span>phplime</span></p>
                                    <p class="mb-0"><strong>Phone:</strong> <span>01745419094</span></p>
                                    <p class="mb-0"><strong>Email:</strong> <span>phplime.envato@gmail.com</span></p>
                                    <small class="text-muted d-block mt-1">Regular</small>
                                </div>
                            </div>
                            <div class=" mt-4">
                                <div class="space-between align-center ml-35">
                                    <div class="flex-1">
                                        <a href="" target="_blank" class="">
                                            <i class="fas fa-map-marker"></i> Rajibpur, Kurigram
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td data-label="<?= __('overview') ?>">
                        <div class="Orderoverview">
                            <div class="orderTypeInfo d-flex align-center mb-5">
                                <span class="f-bold badge badge-success">Cash on delivery</span>
                            </div>
                            <div class="d-flex flex-wrap gap-5 fz-14 ">
                                <p><span><?= __('qty') ?></span> : <b class="dColor">4</b></p> •
                                <p><span><?= __('price') ?></span> :
                                    <b class="dColor">$2347</b>
                                </p>
                            </div>
                            <div class="mt-1">
                                <small class="mute-text fz-12">23 Sep 2025 10:26 am</small>
                            </div>
                        </div>
                    </td>
                    <td data-label="<?= __('status') ?>">
                        <div class="d-flex gap-10 flex-column">
                            <div><?= __getStatus('accept') ?></div>
                            <div>
                                <p class="text-success fz-12"> <i class='fas fa-check'></i> Paid</p>
                                {{-- <p class="text-warning fz-12"> <i class='fas fa-spinner'></i> Unpaid </p> --}}
                            </div>
                        </div>
                    </td>
                    <td data-label="<?= __('action') ?>" class="">
                        <div class="text-center d-flex flex-wrap gap-10 align-center orderListBtn">
                            <a href="{{ url('vendor/order-details/76324724') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            <div class="orderButton">
                                <select name="" class="ci-select text-wrap" onchange="status(event,this.value);">
                                    <option value="" ><?= lang('pending') ?> </option>
                                    <option value="" ><?= lang('accept') ?> </option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div><!-- card-content -->
