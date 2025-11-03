<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ $page_title ?? '' }}</title>

    @include('backend.partials.header')
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed theme-light">
    <div class="wrapper">
        @include('backend.admin.layouts.admin_menu')
        @include('backend.admin.layouts.admin_sidebar')

        @yield('content')

        @include('backend.partials.footer')

        @stack('scripts')
    </div>
</body>

</html>
