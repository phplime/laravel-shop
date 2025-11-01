$(function () {


    // Handle Checkout Customer login / Register open / hide
    $(document).on('click', '.customer__login', function (){
        if($(this).closest('.login').length > 0){
            $('.checkout_registerArea').slideDown();
            $('.checkout_loginArea').slideUp();
        }else{
            $('.checkout_registerArea').slideUp();
            $('.checkout_loginArea').slideDown();
        }
    })


    // Handle Checkout login section open/hide
    $(document).on('click', 'input[name="is_guest_login"]', function (){
        $('.checkout_loginBody').toggleClass('active');

        if($('.checkout_loginBody').closest('.active').length > 0){
            $('.checkout_loginBody').slideUp();
        }else{
            $('.checkout_loginBody').slideDown();
        }
    })


    // Handle Address Others label input show
    $(document).on('click', '.address_label_btn', function (){
        const val = $(this).find('input').val();

        $('.address_label_btn').removeClass('active');
        $(this).addClass('active');

        if(val == 'others'){
            $('.other_labelInput').slideDown();
        }else{
            $('.other_labelInput').slideUp();
        }
    })

    // Handle pickup date time open
    $(document).on('click', '.pickup_check_input', function (){
        const value = $(this).val();
        if(value == 1){
            $('.pickupTime').slideUp();
        }else{
            $('.pickupTime').slideDown();
        }
    })

    // Handle Time slots active
    $(document).on('change', '.single_timeSlots', function (){
        $('.single_timeSlots').removeClass('active');
        $(this).addClass('active');
    })


    // Handle pickup area active
    $(document).on('change', '.single_pickup_area', function(){
        $('.single_pickup_area').removeClass('active');
        $(this).addClass('active');
    })


    // Handle Input only number
    $(document).on("keypress keyup blur", ".only_number", function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    // Handle tab link input checked
    $(document).on('click', '.tabLink', function (){
        let input = $(this).find('input');
        input.prop('checked', true)
    })

    // Handle sm display search input open / hide
    $(document).on("click", ".itemSearch_btn", function (s) {
        s.stopImmediatePropagation();
        $(".topSearchInput").addClass("show");
    });

    $(document).on("click", function (e) {
        const inputBox = $(".items_search_input");
        if (!inputBox.is(e.target) && inputBox.has(e.target).length === 0) {
            $(".topSearchInput").removeClass("show");
        }
    });

    //Single Item View In The Modal
    $(document).on("click", ".itemView", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let id = $(this).data("id");

        // console.log('herer');

        $("#itemDetailsModel").modal("show");
    });

    // Open Shopping Cart
    $(document).on("click", ".openCartBtn", function () {
        $(".shoppingCart_container").addClass("open");
    });

    $(document).on("click", ".cartCloseBtn", function () {
        $(".shoppingCart_container").removeClass("open");
    });
});
