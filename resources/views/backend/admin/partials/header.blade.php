<!-- Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">
<!-- font-awesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/icofont.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/flag-icon.main.css') }}">
<!-- animate.css -->
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/animate/animate.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/select2.main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/select-2.main.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/summernote/summernote-bs4.css') }}">
<!-- Nice selector -->
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/niceselect/nice-select.css') }}">
<!-- sweetalert -->
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert/sweetalert.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/select2.main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/select-2.main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/notify/notify.main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/datatables/datatables.css') }}">



<!-- style.css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/commoncss.php') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/admin_style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/default.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('global/admin.main.css') }}">
<link rel="stylesheet" href="{{ asset('global/admin.responsive.css') }}">




<script>
    let base_url = `{{ url('/') }}/`;
    let _csrf = `{{ csrf_token() }}`;
    let appLanguage = `{{ app()->getLocale() }}`;
    let activated = `{{ __('activated') }}`;
    let deactivated = `{{ __('deactivated') }}`;
    let item_activated = `{{ __('item_activated') }}`;
    let item_deactivated = `{{ __('item_deactivated') }}`;
</script>


<!-- Main js cdn -->
<script src="{{ asset('assets/plugins/jquery.main.js') }}"></script>
<script src="{{ asset('assets/plugins/axios.main.js') }}"></script>
<script src="{{ asset('global/utilities.js?t=' . time()) }}"></script>
