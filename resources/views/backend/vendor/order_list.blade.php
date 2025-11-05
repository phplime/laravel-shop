@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0 mr-5 card-title"><?= __('order_list') ?>
                        <a href="" class="btn btn-sm btn-info ml-5"><i
                                class="nav-icon fas fa-shopping-bag mr-5"></i><?= __('todays') ?></a>
                        <a href="" class="btn btn-sm btn-info ml-5"><i
                                class="nav-icon fas fa-shopping-bag mr-5"></i><?= __('all') ?></a>
                    </h5>
                    <div class="card-tools gap-10 d-flex flex-wrap">
                        <a href='javascript:;' class='btn btn ci-outline btn-sm btn-sm '
                            onclick='toggleClass(this,`filterForm`)'> <i class='fa fa-filter'></i> <?= __('filter') ?> <i
                                class="icofont-thin-down ml-5"></i>
                        </a>

                        <div class="btn btn-outline-danger btn-sm hidden">
                            <span class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-file-export"></i> <?= __('export') ?>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item"><i class="fa fa-file-pdf"></i> <?= __('pdf') ?></a>
                                <a href="#" class="dropdown-item"><i class="fa fa-file-excel"></i>
                                    <?= __('xls') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="GET" class="filterForm hidden"
                        onsubmit="_request(event,this, 'GET', `this`);">

                        <div class="filterArea row">
                            <div class="form-group col-md-3">
                                <label><?= __('order_id') ?></label>
                                <input type="text" name="order_id" class="form-control"
                                    placeholder="<?= __('order_id') ?>" value="">
                            </div>

                            <div class="form-group col-md-2">
                                <label><?= __('status') ?></label>
                                <select name="status" id="status" class="form-control">
                                    <option value=""> -- </option>
                                    <option value="1">Pending</option>
                                    <option value="1">Pending</option>
                                    <option value="1">Pending</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label><?= __('order_type') ?></label>
                                <select name="order" id="order" class="form-control">
                                    <option value=""> -- </option>
                                    <option value="dinein">Dinein</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label><?= __('customer') ?></label>
                                <select name="customer" id="customer" class="form-control">
                                    <option value=""> -- </option>
                                    <option value="">phplime</option>
                                    <option value="">phplime</option>
                                    <option value="">phplime</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label><?= __('date') ?></label>
                                <input type="text" name="daterange" class="form-control datetime"
                                    placeholder="<?= __('date') ?>" value="">
                            </div>


                        </div>
                        <div class="form-group d-flex gap-10 flex-wrap align-center mt-10">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>
                                <?= __('search') ?></button>
                            <button class="btn btn-secondary reset" type="button"><i class="fa fa-times"></i>
                                <?= __('clear') ?></button>
                        </div>
                    </form>

                    <!-- filter -->
                    <div class="orderThumb">
                        @include('backend.vendor.inc.orderThumb')
                    </div>
                </div><!-- card-body -->
                <div class="mb-1rm">
                    <div class="row text-center">
                        <div class="ci-paginationArea">
                            <div class="ci-pagination-link">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div>




    {{-- <script>
	<?php if (isset($_page) && $_page == 'all'): ?>
		var redirectUrl = `<?= base_url('vendor/order/all?isAjax=1') ?>`;
	<?php else: ?>
		var redirectUrl = `<?= base_url('vendor/order/order_list?isAjax=1') ?>`;
	<?php endif; ?>

	function status(event, url) {
		event.preventDefault();
		if (url == null || url == undefined || url == 'javascript:;' || url == '#') {
			return;
		}


		getRequest(url).then(function(json) {
			setTimeout(() => {
				MSG(true, '');
				loadData(json.url);
			}, 150);
		}).catch(function(error) {
			console.error('Error:', error);
		});
	}


	function loadData(url) {
		axios.get(url)
			.then(function(response) {
				setTimeout(() => {
					$('#mainContent').html(response.data);
					daterangeInit();
				}, 150);
			})
			.catch(function(error) {
				console.log('Error loading order type settings:', error);
			});
	}



	$(document).on('click', '.reset', function(e) {
		e.preventDefault();
		$(".filterForm")[0].reset();
		loadData(redirectUrl);
		daterangeInit();

	});
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		initOrderList();

	});
</script>

<script>

</script> --}}
@endsection
