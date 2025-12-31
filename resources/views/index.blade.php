<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ $page_title ?? '' }}</title>
    <!-- Bootstrap 4 -->
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- font-awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontAwesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontAwesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icofont.css') }}">
    <link rel="stylesheet" href="{{ url('dynamic/commoncss?t=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/default.css?t=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('global/payment.css?t=' . time()) }}">
    <script src="{{ asset('assets/plugins/jquery.main.js') }}"></script>
    <script src="{{ asset('assets/plugins/axios.main.js') }}"></script>
    <script src="{{ asset('global/utilities.js?t=' . time()) }}"></script>

</head>

<body class="body">
    <div id="mainContent">
        @yield('content')
        <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
        @stack('scripts')
    </div>
</body>

</html>