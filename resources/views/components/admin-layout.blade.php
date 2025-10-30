<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ isset($data['page_title']) ? $data['page_title'] : '' }}</title>

    @include('backend.partials.header')

</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed theme-dark">
    <div class="wrapper">

        @include('backend.partials.top_menu')
        @include('backend.partials.sidebar')

        <div class="content-wrapper">
            <div class="content">
                {{ $slot }}
            </div><!-- content -->
        </div><!-- content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer><!-- main-footer -->

    </div><!-- wrapper -->

    @include('backend.partials.footer')

    {{-- Page-specific JS --}}
    @stack('scripts')

</body>

</html>
