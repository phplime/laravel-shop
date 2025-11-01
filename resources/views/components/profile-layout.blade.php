<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/images/title-logo.png') }}">
    <title>Shop | {{ isset($data['page_title']) ? $data['page_title'] : '' }}</title>

    @include('profile.partials.header')

</head>

<body class="theme-light">
    <div class="mainWrapper">
        @include('profile.partials.top_navbar')

        {{ $slot }}

        @include('profile.partials.footer_area')
    </div>

    @include('profile.common.single_itemDetails')
    @include('profile.common.shopping_cart')

    @include('profile.partials.footer')

    {{-- Page-specific JS --}}
    @stack('scripts')


</body>

</html>
