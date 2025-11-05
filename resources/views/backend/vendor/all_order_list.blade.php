@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="collapsArea mb-1rm">
                <div class="collapse-header collapse-btn d-flex space-between align-center btn-secondary pl-10 pr-10 py-1rm"
                    data-toggle="collapse" data-target="#restaurant1Orders">
                    <div class="collapse-title d-flex  align-center">
                        <h4>phplime</h4>
                        <span class="badge badge-success ml-10">5</span>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="collapse show " id="restaurant1Orders">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="orderThumb">
                                @include('backend.vendor.inc.orderThumb')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
	var redirectUrl = `<?= base_url('vendor/order/all_order_list?isAjax=1') ?>`

	function status(event, url) {
		event.preventDefault();
		if (url == null || url == undefined || url == 'javascript:;' || url == '#') {
			return;
		}

		getRequest(url).then(function(json) {
			setTimeout(() => {
				MSG(true, '');
				loadData(redirectUrl);
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
</script> --}}
@endsection
