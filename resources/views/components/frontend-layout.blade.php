<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/title-logo.png') }}">
    <title>Shop | {{ isset($data['page_title']) ? $data['page_title'] : '' }}</title>

    @include('frontend.partials.header')

</head>

<body class="theme-light">
    <div class="mainWrapper">
        {{ $slot }}

    </div>
    @include('frontend.partials.footer')


    {{-- Page-specific JS --}}
    @stack('scripts')


</body>

</html>
