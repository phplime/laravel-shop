<link rel="stylesheet" href="{{ asset('global/item.css') }}">
<div class="singleItemPage {{ isset($page_type) ? $page_type : '' }}">
    <div class="modal-header {{ isset($hideModal) && $hideModal == true ? 'd-none' : '' }}">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        {!! __variantPrice($row, $row->vendor_id, 'modalPrice') !!}
                    </div>
                </div><!-- singleItemContent -->

                <div class="item_extra_details">
                    <div class="detailsArea">
                        @if(!empty($item_details->description))
                        <p>{{ __names($row, 'description') }}</p>
                        @endif
                    </div>

                    <div class="allergenArea">
                        <p class="capital allergen pt-5">
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

                            <div class="extraTopHeading mb-5">
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
        @if(__vsettings('is_disable_cart') == 0)
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

        @if(isset($isActive) && $isActive == 1)
        <div class="modal-footer">
            <div class="modalFooterArea">
                <div class="modalIncreateArea">
                    <span class="decrease"> - </span> <input type="number" class="qty prevent-default"
                        name="qty" value="1" min-value="1" readonly><span class="increase">+</span>
                </div>
                <div class="addToCartbutton">
                    <input type="hidden" name="item_id" value="{{ $row->id }}">
                    <input type="hidden" name="item_price" value="{{ $row->is_variants == 0 ? $row->price : 0 }}">
                    <input type="hidden" name="price" value="{{ $row->is_variants == 0 ? $row->price : 0 }}">
                    <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
                    <button type="submit" class="btn btn-primary addToCartBtn add_to_cart_form hidden">
                        {{ !empty(lang('add_to_cart')) ? lang('add_to_cart') : 'Add Cart' }} <span
                            class="displayPrice">{!! _currency_position($row->price, $vendor_id) !!}</span></button>
                </div>
            </div>
        </div>
        @else
        <div class="modal-footer text-right">
            <div class="modalFooterArea text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ lang('close') }}</button>
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
    (function() {
        function initItemDetails() {
            console.log('Item Details Script Loaded');
            // Helper functions
            function safeFloat(v) {
                return parseFloat(v) || 0;
            }

            function safeInt(v) {
                return parseInt(v) || 0;
            }

            function showPrice(price) {
                if (typeof window.showPrice === 'function') return window.showPrice(price);
                return price.toFixed(2);
            }

            // Price calculation functions
            function updateItemPrice() {
                const itemPrice = safeFloat(document.querySelector('[name="item_size"]:checked')?.dataset.price || 0);
                const itemPriceInput = document.querySelector('[name="item_price"]');
                if (itemPriceInput) itemPriceInput.value = itemPrice;

                const variantPriceElements = document.querySelectorAll('.variantPrice');
                variantPriceElements.forEach(el => el.textContent = showPrice(itemPrice));
            }

            function calculateToppingsPrice() {
                let total = 0;
                document.querySelectorAll('.extraLabel').forEach(extraLabel => {
                    const qtyInput = extraLabel.querySelector('[name^="extra_qty["]');
                    const extraInput = extraLabel.querySelector('input[name^="extras["]');
                    if (qtyInput && extraInput) {
                        const qty = safeInt(qtyInput.value);
                        const price = safeFloat(extraInput.dataset.price || 0);
                        total += qty * price;
                    }
                });
                return total;
            }

            function updatePrice() {
                const sizePrice = safeFloat(document.querySelector('[name="item_size"]:checked')?.dataset.price || 0);
                const qtyInput = document.querySelector('[name="qty"]');
                const quantity = Math.max(1, safeInt(qtyInput?.value || 1));
                const toppingsPrice = calculateToppingsPrice();
                const total = quantity * (sizePrice + toppingsPrice);

                const priceInput = document.querySelector('[name="price"]');
                if (priceInput) priceInput.value = total;

                const displayPriceElements = document.querySelectorAll('.displayPrice');
                displayPriceElements.forEach(el => el.textContent = showPrice(total));

                const addToCartBtn = document.querySelector('.addToCartBtn');
                if (addToCartBtn) {
                    if (total > 0) addToCartBtn.classList.remove('hidden');
                    else addToCartBtn.classList.add('hidden');
                }
            }

            function updateExtraPrice(extraLabel) {
                const qtyInput = extraLabel.querySelector('[name^="extra_qty["]');
                const extraInput = extraLabel.querySelector('input[name^="extras["]');
                if (qtyInput && extraInput) {
                    const qty = safeInt(qtyInput.value);
                    const price = safeFloat(extraInput.dataset.price || 0);
                    const extraTotal = qty * price;
                    const extraPriceElement = extraLabel.querySelector('.extraPrice');
                    if (extraPriceElement) extraPriceElement.textContent = showPrice(extraTotal);
                }
            }

            // Initialize UI
            function initExtrasUI() {
                document.querySelectorAll('.extraLabel').forEach(extraLabel => {
                    const qtyInput = extraLabel.querySelector('[name^="extra_qty["]');
                    const extraInput = extraLabel.querySelector('input[name^="extras["]');

                    if (qtyInput && extraInput) {
                        const qty = safeInt(qtyInput.value);
                        const increaseDecrease = extraLabel.querySelector('.increaseDecrease');
                        const checkboxSection = extraLabel.querySelector('.checkboxSection');

                        if (qty === 0) {
                            if (increaseDecrease) increaseDecrease.classList.add('hidden');
                            if (checkboxSection) checkboxSection.classList.remove('hidden');
                            extraInput.checked = false;
                        } else {
                            if (increaseDecrease) increaseDecrease.classList.remove('hidden');
                            if (checkboxSection) checkboxSection.classList.add('hidden');
                            extraInput.checked = true;
                        }
                    }
                });
            }

            // Event delegation
            document.addEventListener('change', function(e) {
                if (e.target.matches('[name="item_size"]')) {
                    document.querySelectorAll('.variant-btn').forEach(btn => btn.classList.remove('active'));
                    e.target.closest('.variant-btn')?.classList.add('active');
                    document.querySelector('.addToCartBtn')?.classList.remove('hidden');
                    updateItemPrice();
                    updatePrice();
                }

                if (e.target.matches('input[name^="extras["]')) {
                    const extraLabel = e.target.closest('.extraLabel');
                    const exqty = extraLabel?.querySelector('[name^="extra_qty["]');
                    const isRadio = e.target.type === 'radio';
                    const isChecked = e.target.checked;

                    if (isRadio && isChecked) {
                        const section = extraLabel?.dataset.section;
                        if (section !== undefined && section !== null) {
                            document.querySelectorAll('input[type="radio"][name^="extras["]').forEach(radio => {
                                const label = radio.closest('.extraLabel');
                                if (label && label.dataset.section == section && radio !== e.target) {
                                    radio.checked = false;
                                    const qtyInput = label.querySelector('[name^="extra_qty["]');
                                    if (qtyInput) qtyInput.value = 0;
                                    const increaseDecrease = label.querySelector('.increaseDecrease');
                                    const checkboxSection = label.querySelector('.checkboxSection');
                                    if (increaseDecrease) increaseDecrease.classList.add('hidden');
                                    if (checkboxSection) checkboxSection.classList.remove('hidden');
                                    updateExtraPrice(label);
                                }
                            });
                        }
                    }

                    if (exqty) {
                        if (isChecked) {
                            exqty.value = Math.max(1, safeInt(exqty.value));
                            const increaseDecrease = extraLabel.querySelector('.increaseDecrease');
                            const checkboxSection = extraLabel.querySelector('.checkboxSection');
                            if (increaseDecrease) increaseDecrease.classList.remove('hidden');
                            if (checkboxSection) checkboxSection.classList.add('hidden');
                        } else {
                            exqty.value = 0;
                            const increaseDecrease = extraLabel.querySelector('.increaseDecrease');
                            const checkboxSection = extraLabel.querySelector('.checkboxSection');
                            if (increaseDecrease) increaseDecrease.classList.add('hidden');
                            if (checkboxSection) checkboxSection.classList.remove('hidden');
                        }
                    }

                    if (extraLabel) {
                        updateExtraPrice(extraLabel);
                        updatePrice();
                    }
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.matches('.plusExtra, .minusExtra')) {
                    e.preventDefault();
                    const extraLabel = e.target.closest('.extraLabel');
                    const exqty = extraLabel?.querySelector('[name^="extra_qty["]');
                    const checkbox = extraLabel?.querySelector('input[name^="extras["]');

                    if (exqty && checkbox) {
                        const isAdd = e.target.classList.contains('plusExtra');
                        const perExtraCap = safeInt(checkbox.dataset.maxQty || 0);
                        const maxPerExtra = perExtraCap === 0 ? Infinity : perExtraCap;

                        const itemExtraList = extraLabel.closest('.item_extra_list');
                        const sectionCapRaw = safeInt(itemExtraList?.dataset.maxQty || 0);
                        const maxPerSection = sectionCapRaw === 0 ? Infinity : sectionCapRaw;

                        const currentVal = safeInt(exqty.value);
                        let currentSectionQty = 0;

                        itemExtraList?.querySelectorAll('[name^="extra_qty["]').forEach(input => {
                            currentSectionQty += safeInt(input.value);
                        });

                        if (isAdd) {
                            if (currentVal < maxPerExtra && currentSectionQty < maxPerSection) {
                                exqty.value = currentVal + 1;
                                checkbox.checked = true;
                            }
                        } else {
                            if (currentVal > 0) {
                                exqty.value = currentVal - 1;
                                if (currentVal - 1 === 0) checkbox.checked = false;
                            }
                        }

                        const newVal = safeInt(exqty.value);
                        const increaseDecrease = extraLabel.querySelector('.increaseDecrease');
                        const checkboxSection = extraLabel.querySelector('.checkboxSection');

                        if (newVal === 0) {
                            if (increaseDecrease) increaseDecrease.classList.add('hidden');
                            if (checkboxSection) checkboxSection.classList.remove('hidden');
                        } else {
                            if (increaseDecrease) increaseDecrease.classList.remove('hidden');
                            if (checkboxSection) checkboxSection.classList.add('hidden');
                        }

                        updateExtraPrice(extraLabel);
                        updatePrice();
                    }
                }

                if (e.target.matches('.modalIncreateArea .increase, .modalIncreateArea .decrease')) {
                    e.preventDefault();
                    const area = e.target.closest('.modalIncreateArea');
                    const qty = area?.querySelector('[name="qty"]');

                    if (qty) {
                        const currentVal = safeInt(qty.value);
                        const isAdd = e.target.classList.contains('increase');

                        if (!isNaN(currentVal)) {
                            if (isAdd) qty.value = currentVal + 1;
                            else qty.value = currentVal > 1 ? currentVal - 1 : currentVal;
                        } else {
                            qty.value = 1;
                        }

                        updatePrice();
                    }
                }
            });

            // Initialize
            if (typeof lazyLoad === 'function') lazyLoad();
            initExtrasUI();
            updatePrice();
            updateItemPrice();
        }

        // Run initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initItemDetails);
        } else {
            initItemDetails();
        }
    })();
</script>