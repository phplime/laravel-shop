<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $data['page_title'] ?? 'Shop' }}</title>

    {{-- Common Header (CSS & Meta) --}}
    @include('profile.partials.header')

    {{-- Page-specific CSS --}}
    @stack('styles')
    @livewireStyles
</head>

@php
$theme = $vendor->theme ?? 1;
@endphp

<body class="theme-light">

    <div class="main-layout">
        {{-- ── Navbar + Mobile Header ────────────────────── --}}
        @include("profile.theme{$theme}.layouts.navbar")

        {{-- ── Cart Sidebar (Livewire) ────────────── --}}
        @if($theme == 1)
        @livewire('cart.sidebar')
        @endif

        {{-- ── Bootstrap Modal for Item Details ─────────── --}}
        <div class="modal fade" id="itemDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="itemModalContent">
                    {{-- AJAX LOADED CONTENT --}}
                </div>
            </div>
        </div>

        {{-- ── Item Details Modal (Livewire) - REMOVED ────────── --}}
        {{-- @livewire('item-details') --}}


        {{-- ── Main Page Content ────────────────────────── --}}
        @yield('content')

        {{-- ── Footer Navigation (Mobile) ───────────── --}}
        @include("profile.partials.footer")
    </div>



    {{-- Theme Detect & Global Scripts --}}
    <script>
        // Detection from local storage
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            document.body.classList.remove('theme-light', 'theme-dark');
            document.body.classList.add('theme-' + savedTheme);
        })();

        // Bootstrap modal cleanup
        $(document).on('hidden.bs.modal', '#itemDetailsModal', function() {
            $('#itemModalContent').html('');
        });
    </script>

    {{-- Page-specific JS --}}
    @stack('scripts')
</body>

</html>