$(function () {
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
    $(document).on("click", ".itemView", function (s) {
        s.preventDefault();
        s.stopImmediatePropagation();
        let id = $(this).data("id");

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
