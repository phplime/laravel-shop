@include('frontend.inc.header')
@include('frontend.layouts.top_navbar')

@yield('content')

@include('frontend.common.shopping_cart')
@include('frontend.common.single_itemDetails')

@if (!isset($data['is_footer']))
    @include('frontend.layouts.footer_area')
@endif

@include('frontend.inc.footer')
