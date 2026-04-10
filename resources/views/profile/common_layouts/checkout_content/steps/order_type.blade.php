<div class="ck-card">
    <div class="ck-card-title"><span class="step-badge">1</span><i class="bi bi-bag-heart"></i> Order Type</div>
    <div class="order-types">
        <div class="ot-option selected" data-type="delivery" onclick="CK.selectOrderType(this)">
            <span class="ot-check"><i class="bi bi-check"></i></span>
            <span class="ot-icon">🛵</span><span class="ot-label">Delivery</span><span class="ot-sub">COD available</span>
        </div>
        <div class="ot-option" data-type="dine_in" onclick="CK.selectOrderType(this)">
            <span class="ot-check"><i class="bi bi-check"></i></span>
            <span class="ot-icon">🍽️</span><span class="ot-label">Dine-in</span><span class="ot-sub">At restaurant</span>
        </div>
        <div class="ot-option" data-type="takeaway" onclick="CK.selectOrderType(this)">
            <span class="ot-check"><i class="bi bi-check"></i></span>
            <span class="ot-icon">🥡</span><span class="ot-label">Takeaway</span><span class="ot-sub">Pick it up</span>
        </div>
    </div>
    <input type="hidden" name="order_type" id="orderTypeInput" value="delivery">

    {{-- Dine-in table input --}}
    <div class="extra-section" id="dineSection">
        <div class="form-row" style="margin-top:.75rem">
            <div class="ck-form-group">
                <label class="ck-label">Table Number</label>
                <input type="text" name="table_number" class="ck-input" placeholder="e.g. T-12">
                <div class="field-error" id="err-table_number"></div>
            </div>
            <div class="ck-form-group">
                <label class="ck-label">No. of Guests</label>
                <input type="number" name="guest_count" class="ck-input" min="1" placeholder="e.g. 2">
                <div class="field-error" id="err-guest_count"></div>
            </div>
        </div>
    </div>

    {{-- Delivery address --}}
    <div class="extra-section show" id="deliverySection">
        <div style="margin-top:.75rem">
            <div class="addr-map" onclick="CK.pinLocation()">
                <div class="addr-map-inner">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span id="mapLabel">Tap to pin your location</span>
                </div>
            </div>
            <div class="form-row">
                <div class="ck-form-group">
                    <label class="ck-label">Street / Building</label>
                    <input type="text" name="street" class="ck-input" placeholder="14 Kenyatta Ave">
                    <div class="field-error" id="err-street"></div>
                </div>
                <div class="ck-form-group">
                    <label class="ck-label">Apartment / Floor</label>
                    <input type="text" name="apartment" class="ck-input" placeholder="Apt 3B">
                </div>
            </div>
            <div class="ck-form-group">
                <label class="ck-label">Delivery Instructions</label>
                <input type="text" name="instructions" class="ck-input" placeholder="Leave at door, call when near…">
            </div>
        </div>
    </div>
</div>
