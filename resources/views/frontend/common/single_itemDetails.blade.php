<!-- Modal -->
<div class="modal itemDetailsModel fade" id="itemDetailsModel" tabindex="-1" role="dialog"
    aria-labelledby="itemModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="singleItemModal">
                <form action="" method="post">
                    <div class="modal-body p-0">
                        <div class="single_itemContainer">
                            <div class="item_topHeader">
                                <div class="itemImg">
                                    <img src="{{ asset('frontend/images/food3.jpg') }}" alt="">
                                </div>
                                <div class="defaultImage">
                                    <div class="singleImg">
                                        <img src="{{ asset('frontend/images/food1.jpg') }}" alt="">
                                    </div>
                                    <div class="singleImg">
                                        <img src="{{ asset('frontend/images/food2.jpg') }}" alt="">
                                    </div>
                                    <div class="singleImg">
                                        <img src="{{ asset('frontend/images/food3.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="single_itemContent">
                                <div class="headerContent">
                                    <div class="itemName">
                                        <h6>Burger</h6>
                                    </div>
                                    <div class="itemIncress_decreesAction">
                                        <span class="decrease"><i class="fa fa-minus"></i></span>
                                        <input readonly type="text" name="qty" class="item_qty" value="1">
                                        <span class="increase"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                                <!-- Variant Area -->
                                <div class="mt-8 mb-15">
                                    <div class="viewItemTitle mb-8">
                                        <h6>Choose Size :-</h6>
                                    </div>
                                    <div class="singleItemVariant">

                                        <label class="varianBtnArea mb-0">
                                            <input type="radio" name="variant_type" class="variant_type d-none"
                                                value="m" checked>
                                            <div class="variantType">
                                                <h6>M</h6>
                                            </div>
                                        </label>

                                        <label class="varianBtnArea mb-0">
                                            <input type="radio" name="variant_type" class="variant_type d-none"
                                                value="m" checked>
                                            <div class="variantType">
                                                <h6>L</h6>
                                            </div>
                                        </label>

                                        <label class="varianBtnArea mb-0">
                                            <input type="radio" name="variant_type" class="variant_type d-none"
                                                value="m" checked>
                                            <div class="variantType">
                                                <h6>X</h6>
                                            </div>
                                        </label>

                                    </div>
                                </div>
                                <!-- Variant Area -->

                                <!-- Allergens Items Area -->
                                <div class="allergensItems_area">
                                    <div class="viewItemTitle mb-8">
                                        <h6>Allergens :-</h6>
                                    </div>
                                    <ul class="allergensItemsList">
                                        <li>
                                            <img src="{{ asset('frontend/images/food2.jpg') }}" alt="img">
                                            <span>Milk</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/food2.jpg') }}" alt="img">
                                            <span>Milk</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/food2.jpg') }}" alt="img">
                                            <span>Milk</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Allergens Items Area -->

                                <!-- Extra Items Area -->
                                <div class="extraItems_area">
                                    <div class="viewItemTitle mb-8">
                                        <h6>Extra :-</h6>
                                    </div>
                                    <ul class="extraItemsList">

                                        <li class="extraLabel">
                                            <div class="extraIncreaseDecrease d-none">
                                                <span class="extraDecrease"><i class="fa fa-minus"></i></span>
                                                <input readonly type="text" name="extra_qty" value="1"
                                                    class="extraQty">
                                                <span class="extraIncrease"><i class="fa fa-plus"></i></span>
                                            </div>
                                            <label class="extraItem extraItemsBtn">
                                                <input type="checkbox" name="extra" class="extras d-none">
                                                <div class="extraItemContent">
                                                    <img src="{{ asset('frontend/images/food2.jpg') }}" alt="img">
                                                    <div class="flex flex-column space-between">
                                                        <h6 class="name">Burger</h6>
                                                        <span class="price">$50.00</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </li><!-- Extra Item -->

                                        <li class="extraLabel">
                                            <div class="extraIncreaseDecrease d-none">
                                                <span class="extraDecrease"><i class="fa fa-minus"></i></span>
                                                <input readonly type="text" name="extra_qty" value="2"
                                                    class="extraQty">
                                                <span class="extraIncrease"><i class="fa fa-plus"></i></span>
                                            </div>
                                            <label class="extraItem extraItemsBtn">
                                                <input type="checkbox" name="extra" class="extras d-none">
                                                <div class="extraItemContent">
                                                    <img src="{{ asset('frontend/images/food2.jpg') }}"
                                                        alt="img">
                                                    <div class="flex flex-column space-between">
                                                        <h6 class="name">Burger</h6>
                                                        <span class="price">$50.00</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </li><!-- Extra Item -->

                                    </ul>
                                </div>
                                <!-- Extra Items Area -->

                                <div class="mt-8 mb-8">
                                    <div class="viewItemTitle mb-8">
                                        <h6>Description :-</h6>
                                    </div>
                                    <div class="itemDescription">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis praesentium
                                        commodi
                                        facilis!
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="closeModal" data-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer p-10">
                        <div class="singleItem_FooterAction">
                            <h5 class="total_amount">$50.56</h5>
                            <button type="button" class="btn addTo_cart"><i class="icofont-cart-alt"></i>&nbsp;Add
                                To
                                Cart</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(function() {

        // Handel mail checkbox
        $(document).on('change', '.extraItemsBtn', function()
        {
            let parentDiv = $(this).closest('.extraLabel');
            let extraCheckboxInput = parentDiv.find('.extras'); // Find Extra Checkbox
            let increase_decreaseDiv = parentDiv.find('.extraIncreaseDecrease');
            let extraQty = parentDiv.find('.extraQty'); // Find Extra Qty Input

            extraQty.val(1);
            extraCheckboxInput.prop('checked', true);
            increase_decreaseDiv.removeClass('d-none'); //Show Increase && Decrease Div
        });


        // Handel Extra Items Increase
        $(document).on('click', '.extraIncrease', function()
        {
            const parentDiv = $(this).closest('.extraLabel');
            const extraQty = parentDiv.find('.extraQty');
            const currentQty = parseInt(extraQty.val());
            extraQty.val(currentQty + 1);
        })


        // Handel Extra Items Decrease
        $(document).on('click', '.extraDecrease', function()
        {
            const parentDiv = $(this).closest('.extraLabel');
            const extraQty = parentDiv.find('.extraQty');
            const extraCheckboxInput = parentDiv.find('.extras');
            const increase_decreaseDiv = parentDiv.find('.extraIncreaseDecrease');
            const currentQty = parseInt(extraQty.val());

            if (currentQty > 1) {
                extraQty.val(currentQty - 1);
            } else {
                extraQty.val(1);
                extraCheckboxInput.prop('checked', false);
                increase_decreaseDiv.addClass('d-none');
            }
        })

    });
</script>
