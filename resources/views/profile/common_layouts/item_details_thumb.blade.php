<link rel="stylesheet" href="{{ asset('global/item.css?t=' . time()) }}">
<div class="singleItemPage {{ isset($page_type) ? $page_type : '' }}">
    <div class="modal-header <?= isset($hideModal) && $hideModal == true ? 'd-none' : ''; ?>">
        <h5 class="modal-title">Item Details</h5>
        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>
    <form action="{{ $url ?? '' }}" method="post" class="add_to_cart {{ $class ?? '' }}" id="{{ $class ?? '' }}">
        @csrf
        <div class="modal-body p-0">
            <div class="singleItem {{ isset($page_type) ? $page_type : '' }}">
                <div class="itemTopHeader">
                    <div class="itemImg ">
                        @php
                        $itemImages = array_filter(explode(',', $row->images));
                        @endphp
                        @if(is_array($itemImages) && sizeof($itemImages) > 1)
                        <div class="itemSlider opacity_height_0">
                            <div class="single_item_slider">
                                <div class="item__slider img bg_loader"
                                    data-src="{{ __image($itemImages[0], 'images') }}"
                                    style="background-image: url('{{ __loader() }}')">

                                </div>
                            </div>
                            <div class="sliderImgThumb">
                                <ul>
                                    <li class="Sliderthumb active" data-img="{{ __image($itemImages[0], 'images') }}">
                                        <img src="{{ __image($itemImages[0], 'thumb') }}" alt="item image">
                                    </li>
                                    @php unset($itemImages[0]); @endphp
                                    @foreach($itemImages as $key => $img)

                                    <li class="Sliderthumb" data-img="{{ __image($img, 'images') }}"><img
                                            src="{{ __image($img, 'thumb') }}" alt="sliderImg"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @else
                        <img data-src="{{ __image($row->images, 'images') }}" src="{{ __loader() }}" alt="item_img "
                            class="img_loader">
                        @endif
                    </div>
                </div><!-- itemHeader -->

                @php
                $item_details = $row->getTranslations()->first();
                @endphp
                <div class="singleItemContent">
                    <div class="itemTopTitle">
                        <h4 class="itemTitle">
                            {{ $item_details->title }}
                            <div class="vegType">
                                {!! __vegType($row, false) !!}
                            </div>
                        </h4>
                        {!! __itemTax($row->id, $row->vendor_id) !!}
                    </div><!-- itemTitle -->
                    <div class="priceArea">
                        {!! __price($row, $row->vendor_id, 'modalPrice') !!}
                    </div>
                </div><!-- singleItemContent -->

                <div class="item_extra_details">
                    <div class="detailsArea">
                        @if(!empty($item_details->description))
                        <p>{{ __names($row, 'description') }}</p>
                        @endif
                    </div>

                    <div class="allergenArea">
                        <p class="capital allergen pt-5px">
                            @if(isset($row->allergen_id) && isJson($row->allergen_id))
                            <span><b>{{ lang('allergens') }}</b>:

                            </span>
                            @endif
                        </p>
                    </div><!-- allergens -->

                    <div class="ItemExtrasArea">


                        @if(isset($extra_list) && $extra_list->isNotEmpty())
                        @foreach($extra_list as $ex_key => $ex)
                        <div class="item_extra_list {{ $ex->is_required == 1 ? 'required required-section' : '' }}"
                            data-limit="{{ $ex->select_limit == 0 ? 1 : $ex->select_limit }}"
                            data-max-select="{{ $ex->select_max_limit == 0 ? 1000 : $ex->select_max_limit }}"
                            data-max-qty="{{ $ex->max_qty == 0 ? 1000 : $ex->max_qty }}">

                            <div class="extraTopHeading mb-5px">
                                <div class="extraHeadingTop">
                                    <h5 class="extrasHeading">{{ __names($ex, 'title') }}
                                        <small>
                                            @if($ex->is_required == 1)
                                            <span class="error">*</span> ({{ __('required') }})
                                            @else
                                            ({{ __('optional') }})
                                            @endif
                                        </small>
                                    </h5>

                                    @if($ex->is_required == 1 && $ex->select_limit > 0)
                                    <small class="text-muted"> <span class="error">*</span>
                                        {{ __('select_minimum') }}
                                        {!! $ex->select_limit == 0 ? '<b>1</b>' : '<b>' . $ex->select_limit . '</b>' !!}
                                        {{ __('options') }}

                                        @if($ex->select_max_limit != 0)
                                        & {{ __('max') }}
                                        {!! $ex->select_max_limit != 0 ? '<b>' . $ex->select_max_limit . '</b>' : '' !!}
                                        {{ __('options') }}
                                        @endif

                                    </small>

                                    @endif
                                </div>
                                <p class="errorMessage"></p>
                            </div>

                            <ul class="extraUl">
                                @foreach($ex->extra_list as $ex_key2 => $extra)
                                @if(!empty($extra))
                                @php
                                $extra_price = __aExtra($extra, 'price');
                                $max_qty = __aExtra($extra, 'max_qty');
                                @endphp
                                @if($ex->is_single_select == 1)
                                <li class="extraLabel" data-section="{{ $ex_key }}">
                                    <label class="custom-checkbox">
                                        <div class="increaseDecrease hidden">
                                            <a href="javascript:;" class="minusExtra">-</a>
                                            <input type="text" name="extra_qty[{{ $extra->id }}]"
                                                class="extraQty prevent-default" value="0" min="0">
                                            <a href="javascript:;" class="plusExtra">+</a>
                                        </div>
                                    </label>
                                    <label class="custom-radio-2 checkBoxArea">
                                        <p>
                                            <span class="checkboxSection">
                                                <input type="radio" name="extras[{{ $ex_key }}]"
                                                    class="extras itemExtras"
                                                    data-name="{{ __names($extra->_extranames, 'addon_name') }}"
                                                    data-id="{{ $extra->id }}" data-item="{{ $extra->item_id }}"
                                                    data-price="{{ $extra_price }}"
                                                    data-max-qty="{{ $max_qty }}"
                                                    value="{{ $extra->id }}">
                                            </span>
                                            <span
                                                class="mr-30">{{ __names($extra->addonLibrary, 'addon_name') }}</span>
                                            &nbsp;
                                        </p>
                                        @if($extra_price != 0)
                                        <span class="left_bold">
                                            {!! __currency_position($extra_price, $row->vendor_id) !!}</span>
                                        @endif
                                    </label>
                                </li>
                                @else
                                <li class="extraLabel" data-section="{{ $ex_key }}">
                                    <label class="custom-checkbox">
                                        <div class="increaseDecrease hidden">
                                            <a href="javascript:;" class="minusExtra">-</a>
                                            <input type="text" name="extra_qty[{{ $extra->id }}]"
                                                class="extraQty prevent-default" value="0" min="0">
                                            <a href="javascript:;" class="plusExtra">+</a>
                                        </div>
                                    </label>
                                    <label class="custom-checkbox checkBoxArea">

                                        <p>
                                            <span class="checkboxSection">
                                                <input type="checkbox" name="extras[{{ $ex_key }}]"
                                                    class="extras itemExtras"
                                                    data-name="{{ __names($extra->addonLibrary, 'addon_name') }}"
                                                    data-id="{{ $extra->id }}" data-item="{{ $extra->item_id }}"
                                                    data-price="{{ $extra_price }}"
                                                    data-max-qty="{{ $max_qty }}"
                                                    value="{{ $extra->id }}">
                                            </span>

                                            <span
                                                class="mr-30">{{ __names($extra->addonLibrary, 'addon_name') }}</span>
                                            &nbsp;
                                        </p>
                                        @if($extra_price != 0)
                                        <span class="left_bold">
                                            {!! __currency_position($extra_price, $row->vendor_id) !!}</span>
                                        @endif
                                    </label>
                                </li>
                                @endif
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>

                </div>

            </div><!-- SingleItem -->
        </div><!-- modal-body -->
        @if(__vsettings('is_disable_cart') == 0 || $page_type == 'single-page')
        @php
        if (isset($shop_info->stock_status) && $shop_info->stock_status == 1):
        if ($item->in_stock > $item->remaining):
        $isActive = 1;
        else:
        $isActive = 0;
        endif;
        else:
        $isActive = 1;
        endif;
        @endphp

        @if(isset($isActive) && $isActive == 1 || $isActive == 0)
        <div class="modal-footer">
            <div class="modalFooterArea">
                <div class="modalIncreateArea">
                    <span class="decrease"> - </span> <input type="number" class="qty prevent-default"
                        name="quantity" value="1" min-value="1" readonly><span class="increase">+</span>
                </div>
                <div class="addToCartbutton">
                    <input type="hidden" name="product_id" value="{{ $row->id }}">
                    <input type="hidden" name="item_price" value="{{ $row->is_variants == 0 ? $row->price : 0 }}">
                    <input type="hidden" name="price" value="{{ $row->is_variants == 0 ? $row->price : 0 }}">
                    <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
                    <button type="button" onclick="addToCart(this)" class="btn btn-primary addToCartBtn add_to_cart_form hidden">
                        {{ !empty(lang('add_to_cart')) ? lang('add_to_cart') : 'Add Cart' }} <span
                            class="displayPrice">{!! __currency_position($row->price, $vendor_id) !!}</span></button>
                </div>
            </div>
        </div>
        @else
        <div class="modal-footer text-right">
            <div class="modalFooterArea text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">{{ lang('close') }}</button>
                <div class="addToCartbutton">
                    <button type="button" class="btn btn-danger">{{ lang('out_of_stock') }} </button>
                </div>
            </div>
        </div>
        @endif <!-- isActive -->
        @endif <!-- $is_cart -->
    </form>

</div>

<script>
    (function($) {
        /**
         * Logic is wrapped in a global function so it can be re-called by Livewire
         * on every modal load.
         */
        window.initItemDetails = function() {
            console.log('--- Item Details Script Initialized ---');
            
            const $ctx = $('.singleItemPage'); // Scopes all jQuery calls
            if (!$ctx.length) {
                console.warn('initItemDetails: .singleItemPage not found in DOM');
                return;
            }

            // --- Helpers ---
            const safeFloat = (v) => parseFloat(v) || 0;
            const safeInt = (v) => parseInt(v) || 0;
            const formatPrice = (p) => typeof window.showPrice === 'function' ? window.showPrice(p) : p.toFixed(2);

            function updateMainPrice() {
                console.log('Calculating price...');
                const $checkedSize = $ctx.find('[name="item_size"]:checked');
                const basePrice = $checkedSize.length ? safeFloat($checkedSize.data('price')) : safeFloat($ctx.find('[name="item_price"]').val());
                const quantity = Math.max(1, safeInt($ctx.find('[name="quantity"]').val()));

                let extrasTotal = 0;
                $ctx.find('.extraLabel').each(function() {
                    const extraInput = $(this).find('input.extras');
                    const qtyInput = $(this).find('.extraQty');
                    if (extraInput.is(':checked')) {
                        extrasTotal += safeFloat(extraInput.data('price')) * safeInt(qtyInput.val() || 1);
                    }
                });

                const total = quantity * (basePrice + extrasTotal);
                $ctx.find('[name="price"]').val(total.toFixed(2));
                $ctx.find('.displayPrice').text(formatPrice(total));
                $ctx.find('.addToCartBtn').toggleClass('hidden', total < 0);
                
                console.log(`Base: ${basePrice}, Qty: ${quantity}, Extras: ${extrasTotal}, Total: ${total}`);
            }

            function syncExtraUI($label) {
                const qtyVal = safeInt($label.find('.extraQty').val());
                const hasQty = qtyVal > 0;
                $label.find('.increaseDecrease').toggleClass('hidden', !hasQty);
                $label.find('.checkBoxArea .checkboxSection').toggleClass('hidden', hasQty);
                $label.find('.extras').prop('checked', hasQty);
            }

            // --- Event Binding ---

            // Sizes
            $ctx.off('change', '[name="item_size"]').on('change', '[name="item_size"]', function() {
                console.log('Size changed to:', $(this).val());
                $ctx.find('.variant-btn').removeClass('active');
                $(this).closest('.variant-btn').addClass('active');
                // Update the hidden base price field just in case
                $ctx.find('[name="item_price"]').val($(this).data('price'));
                updateMainPrice();
            });

            // Extras
            $ctx.off('change', '.itemExtras').on('change', '.itemExtras', function() {
                console.log('Extra toggled:', $(this).val());
                const $label = $(this).closest('.extraLabel');
                const $qty = $label.find('.extraQty');
                
                if ($(this).is(':checked')) {
                    if (safeInt($qty.val()) === 0) $qty.val(1);
                    
                    // Radio behavior
                    if ($(this).attr('type') === 'radio') {
                        const name = $(this).attr('name');
                        $ctx.find(`input[name="${name}"]`).not(this).each(function() {
                            const $otherLabel = $(this).closest('.extraLabel');
                            $otherLabel.find('.extraQty').val(0);
                            syncExtraUI($otherLabel);
                        });
                    }
                } else {
                    $qty.val(0);
                }
                syncExtraUI($label);
                updateMainPrice();
            });

            // Main Quantity
            $ctx.off('click', '.decrease, .increase').on('click', '.decrease, .increase', function(e) {
                e.preventDefault();
                const $qty = $ctx.find('[name="quantity"]');
                const current = safeInt($qty.val());
                const nextVal = $(this).hasClass('increase') ? current + 1 : Math.max(1, current - 1);
                console.log('Main quantity changed:', nextVal);
                $qty.val(nextVal);
                updateMainPrice();
            });

            // Extra Quantity
            $ctx.off('click', '.plusExtra, .minusExtra').on('click', '.plusExtra, .minusExtra', function(e) {
                e.preventDefault();
                const $label = $(this).closest('.extraLabel');
                const $qty = $label.find('.extraQty');
                const $checkbox = $label.find('.extras');
                const $section = $(this).closest('.item_extra_list');

                const curVal = safeInt($qty.val());
                const currentSecQty = Array.from($section.find('.extraQty')).reduce((acc, el) => acc + safeInt(el.value), 0);
                const maxPerExtra = safeInt($checkbox.data('maxQty')) || 999;
                const maxPerSec = safeInt($section.parent().data('maxSecQty')) || 999; // Fallback to 999

                if ($(this).hasClass('plusExtra')) {
                    if (curVal < maxPerExtra && currentSecQty < maxPerSec) {
                        $qty.val(curVal + 1);
                    }
                } else if (curVal > 0) {
                    $qty.val(curVal - 1);
                }
                
                syncExtraUI($label);
                updateMainPrice();
            });

            // Initial UI sync
            $ctx.find('.extraLabel').each(function() { syncExtraUI($(this)); });
            updateMainPrice();
            
            if (typeof window.lazyLoad === 'function') window.lazyLoad();
        };

        // Always try to auto-run on document ready
        $(document).ready(function() {
            window.initItemDetails();
        });
    })(jQuery);
</script>