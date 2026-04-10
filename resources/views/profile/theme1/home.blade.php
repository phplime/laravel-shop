@extends('profile.layouts.app')
@section('content')


<main class="page-wrap">

    <!-- Desktop greeting -->
    <div class="desk-greeting">
        <div>
            <h2>Hi, Sheila 👋</h2>
            <div class="loc"><i class="bi bi-geo-alt-fill"></i> Kenyatta University, Nairobi.</div>
        </div>
    </div>

    <!-- Search -->
    <div class="mob-search-wrap">
        <div class="search-bar">
            <i class="bi bi-search si"></i>
            <input type="text" placeholder="Local and international dishes">
            <i class="bi bi-sliders fi"></i>
        </div>
    </div>

    <!-- Categories -->
    <div class="cats-row">
        @foreach($data['categories'] as $cat)
        <div class="cat-item {{ $loop->first ? 'active' : '' }}" onclick="selectCat(this)">
            <div class="cat-img">
                @if($cat->thumb)
                <img src="{{ __image($cat->thumb, 'thumb') }}" alt="{{ __names($cat, 'category_name') }}" style="width:24px;height:24px;border-radius:50%">
                @else
                🍴
                @endif
            </div>
            <div class="cat-label">{{ __names($cat, 'category_name') }}</div>
        </div>
        @endforeach
    </div>

    <!-- Promo -->
    <div class="promo-wrap">
        <div class="promo-banner">
            <div class="promo-text">
                <div class="pt">Hurry now!!</div>
                <h3>Get your favorite meal<br>for a <span class="hl">50%</span> discount this<br>seasonal period</h3>
                <button class="promo-order-btn">Order now</button>
            </div>
            <div class="promo-chef">
                <img src="https://images.unsplash.com/photo-1583394293214-c6a40ef01808?w=240&h=320&fit=crop&crop=top" alt="Chef">
            </div>
        </div>
    </div>

    <!-- Most Popular -->
    <div class="sec-hd-wrap" style="margin-top:1.5rem">
        <div class="sec-hd">
            <h4>Most popular</h4>
            <a href="#">see all <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>

    <div class="food-grid-wrap">
        <div class="food-grid">

            @foreach($data['items'] as $item)
            <div class="food-card" data-item-id="{{ $item->id }}" data-fetch-item>
                <div class="fc-img">
                    <img src="{{ __image($item->images, 'images') }}" alt="{{ __names($item, 'title') }}">
                </div>
                <div class="fc-body">
                    <div class="fc-kitchen">Kitchen: {{ $vendor->app_name ?? 'Global' }}</div>
                    <div class="fc-name">{{ __names($item, 'title') }}</div>
                    <div class="fc-price">{{ __currency_position($item->price, $item->vendor_id) }}</div>
                    <div class="fc-meta"><span class="star">★</span><span>(5.0)</span><span>{{ rand(100, 2000) }}+ Orders</span></div>
                    <div class="fc-actions" onclick="event.stopPropagation();">
                        <!-- added the button here -->
                        @if(isset($item->is_variants) && $item->is_variants == 1)
                        <button class="order-btn" onclick="$(this).closest('.food-card').click();"><span class="btn-txt"><i class="bi bi-cart2"></i> <?= __('add'); ?></span></button>
                        @else
                        <form action="{{url('cart/add')}}" class="addToCartAreaContainer">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$item->id}}">
                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                            <div class="addToCartArea">
                                <div class="cqty">
                                    <button type="button" class="cq-btn" onclick="decQty(this)">−</button>
                                    <input type="number" name="quantity" value="1" min="1" readonly class="qty-input">
                                    <button type="button" class="cq-btn" onclick="incQty(this)">+</button>
                                </div>
                                <button type="button" class="order-btn" onclick="event.stopPropagation(); addToCart(this);"><span class="btn-txt"><i class="bi bi-cart2"></i> <?= __('add'); ?></span></button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</main><!-- main -->

@push('scripts')
<script>
    let cartCount = `{{ $cartCount ?? 0 }}`;

    /* Category selection */
    function selectCat(el) {
        document.querySelectorAll('.cat-item').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    }

    /* Qty controls */
    function incQty(btn) {
        const input = btn.parentNode.querySelector('input[name="quantity"]') || btn.parentNode.querySelector('input[name="qty"]');
        if (input) {
            input.value = parseInt(input.value) + 1;
            $(input).trigger('change');
        }
    }

    function decQty(btn) {
        const input = btn.parentNode.querySelector('input[name="quantity"]') || btn.parentNode.querySelector('input[name="qty"]');
        if (input) {
            const v = parseInt(input.value);
            if (v > 1) {
                input.value = v - 1;
                $(input).trigger('change');
            }
        }
    }




    /* Bottom nav active state */
    document.querySelectorAll('.bn-item').forEach(item => {
        item.addEventListener('click', function() {
            if (this.getAttribute('onclick')) return;
            document.querySelectorAll('.bn-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });




    // $(document).on('click', '.addToCart', function() {

    //     var id = $(this).data('id');
    //     var type = $(this).data('type') || 'item';
    //     var url = `${base_url}cart/add_to_cart/${id}/${type}`;
    //     $.post(addLangToUrl(url), {
    //         '_token': _csrf
    //     }, function(json) {
    //         cartView(json);
    //         (json);
    //     }, 'json');
    //     return false;
    // });
</script>
@endpush


@endsection