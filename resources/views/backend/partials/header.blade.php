<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ isset($data['page_title']) ? $data['page_title'] : '' }}</title>

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
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/summernote/summernote-bs4.css') }}">
    <!-- Nice selector -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/niceselect/nice-select.css') }}">
    <!-- sweetalert -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert/sweetalert.min.css') }}">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/commoncss.php') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/admin_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('global/admin.main.css') }}">
    <link rel="stylesheet" href="{{ asset('global/admin.responsive.css') }}">

    <!-- Main js cdn -->
    <script src="{{ asset('assets/plugins/jquery.main.js') }}"></script>
    <script src="{{ asset('assets/plugins/axios.main.js') }}"></script>
    <script src="{{ asset('global/utilities.js?t=' . time()) }}"></script>

