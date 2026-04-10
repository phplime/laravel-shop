<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ $page_title ?? '' }}</title>

    @include('backend.components.header',['role'=>'admin'])
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed  <?= __settings('theme') == 'dark' ? 'theme-dark dark' : 'theme-light light'; ?>">
    <div id="mainContent">
        <div class="wrapper">
            @include('backend.admin.layouts.admin_menu')
            @include('backend.admin.layouts.admin_sidebar')

            @yield('content')


            @include('backend.components.footer',['role'=>'admin'])

        </div>
    </div>
</body>

</html>