(function ($) {
    "use strict";

    var csrf_token = jQuery('meta[name="csrf-token"]').attr("content");
    var base_url = jQuery('meta[name="base_url"]').attr("content");
    let item_deactive = "item_deactive";
    let item_active = "item_activated";

    /*----------------------------------------------
    Nice select
  ----------------------------------------------*/
    $(".niceSelect").niceSelect();

    /*----------------------------------------------
    select2
  ----------------------------------------------*/
    $(".select2").select2({
        width: "resolve",
    });

    /*----------------------------------------------
    count to
  ----------------------------------------------*/

    $(document).ready(function () {
        setTimeout(function () {
            $(".count").countTo({ duration: 3000 });
        }, 500); // wait 2 seconds after load
    });
    /*----------------------------------------------
    summernote
  ----------------------------------------------*/
    $(function () {
        // Summernote
        $(".textarea").summernote({
            minHeight: 150,
        });
    });
    $(".data_textarea").summernote({
        height: 100,
        codemirror: {
            // codemirror options
            theme: "monokai",
            mode: "text/html",
            lineNumbers: true,
            htmlMode: true,
        },
        toolbar: [["font", ["bold", "italic", "underline", "clear"]]],
    });
    /*----------------------------------------------
   Enable tooltip
  ----------------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();

    /*----------------------------------------------
   DATE RANGE
  ----------------------------------------------*/

    $(function () {
        // $('input[name="daterange"]').val('');
        $('input[name="daterange"]').daterangepicker(
            {
                opens: "left",
                setDate: "",
                startDate: moment().startOf("hour").subtract(64, "hour"),
                endDate: moment().startOf("hour"),
                locale: {
                    cancelLabel: "Clear",
                    format: "D MMM YYYY",
                },
                autoUpdateInput: false,
                ranges: {
                    Today: [moment(), moment()],
                    Yesterday: [
                        moment().subtract(1, "days"),
                        moment().subtract(1, "days"),
                    ],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [
                        moment().startOf("month"),
                        moment().endOf("month"),
                    ],
                    "Last Month": [
                        moment().subtract(1, "month").startOf("month"),
                        moment().subtract(1, "month").endOf("month"),
                    ],
                },
            },
            function (start, end, label) {
                console.log(
                    "A new date selection was made: " +
                        start.format("MMMM D, YYYY") +
                        " to " +
                        end.format("MMMM D, YYYY")
                );
            }
        );

        $('input[name="daterange"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(
                    picker.startDate.format("D MMM YYYY") +
                        " - " +
                        picker.endDate.format("D MMM YYYY")
                );
            }
        );
        $('input[name="daterange"]').on(
            "cancel.daterangepicker",
            function (ev, picker) {
                $(this).val("");
            }
        );
    });

    $(function () {
        // Multiple images preview with JavaScript
        var multiImgPreview = function (input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;

                for (let i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function (event) {
                        $($.parseHTML("<img>"))
                            .attr("src", event.target.result)
                            .appendTo(imgPreviewPlaceholder);
                    };

                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $("#images").on("change", function () {
            multiImgPreview(this, "div.imgPreview");
        });
    });

    $(function () {
        $(document).on("click", ".ajaxDelete", function () {
            var url = $(this).attr("href");
            var msg = $(this).data("msg");
            var id = $(this).data("id");
            swal(
                {
                    title: "Are you sure?",
                    text: msg,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes do it!",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                },
                function () {
                    $.get(
                        url,
                        { _token: csrf_token },
                        function (json) {
                            if (json.st == 1) {
                                swal(
                                    {
                                        title: "Success",
                                        text: json.msg,
                                        type: "success",
                                        showCancelButton: false,
                                    },
                                    function () {
                                        $(`#hide_${id}`).slideUp();
                                    }
                                );
                            }
                        },
                        "json"
                    );
                }
            );
            return false;
        });
    });

    $(function () {
        $(document).on("click", ".action_btn", function () {
            var link = $(this).attr("href");
            var msg = $(this).data("msg");
            swal(
                {
                    title: "Are you sure?",
                    text: msg,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "yes",
                    cancelButtonText: "no",
                    closeOnConfirm: false,
                },
                function () {
                    window.location.href = link;
                }
            );
            return false;
        });
    });

    function pushNotify() {
        new Notify({
            status: "success",
            title: "Notify Title",
            text: "Notify text lorem ipsum",
            effect: "fade",
            speed: 500,
            customClass: `custom-notify`,
            customIcon: `<i class="fa fa-home"></i>`,
            showIcon: true,
            showCloseButton: true,
            autoclose: false,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: "right top",
        });
    }

    // new simpleSnackbar(`
    //   <h4>Success</h4>
    //   <p>This is a test message</p>
    //   `, {
    //   icons: {
    //     success: '<i class="fa fa-check"></i>',
    //     danger: '<i class="fa fa-ban"></i>',
    //   },
    //   type: 'danger',
    //   autohide: true,
    //   close: true,
    //   style: "toast",
    //   progress: true,
    // }).show();

    //pushNotify();
    //  Remove space
    $(document).on("keyup", ".remove_space", function () {
        var val = $(this).val();
        if (val == "") {
            return;
        }

        if (val.match(/[^\w]/g)) {
            $(".alert_msg").html("No space allowed").addClass("error");
            var newName = val.replace(/[^\w]/g, "");
            $(this).val(newName);
            return;
        } else {
            $(".alert_msg").html("").removeClass("error");
        }

        return;
    });

    $(document).on("click", ".is_size", function () {
        if ($(this).prop("checked") == true) {
            $(".show_price").slideUp();
        } else {
            $(".show_price").slideDown();
        }
    });
    $(document).on("click", ".isDue", function () {
        if ($(this).prop("checked") == true) {
            $(".showDuePrice").slideDown();
        } else {
            $(".showDuePrice").slideUp();
        }
    });

    $(document).on("submit", ".add_to_cart", function () {
        var url = $(this).attr("action");
        $.post(
            url,
            $(this).serialize(),
            function (json) {
                if (json.st == 1) {
                    $("#show_posItems").html(json.load_data);
                }
            },
            "json"
        );
        return false;
    });

    $(document).on("click", ".remove_item", function () {
        var id = $(this).data("id");
        var url = addLangToUrl(`${base_url}admin/pos/remove_cart_item/${id}`);
        $.post(
            url,
            { _token: csrf_token },
            function (json) {
                if (json.st == 1) {
                    $("#show_posItems").html(json.load_data);
                }
            },
            "json"
        );
        return false;
    });

    $(function () {
        $(document).on("click", ".minus,.add", function () {
            var id = $(this).data("id");
            var price = $(this).data("price");
            var $qty = $(this).closest(".incress_area").find(".qty");
            var $sold_price = $(`.sold_price_${id}`).find(".soldPrice"),
                currentVal = parseInt($qty.val()),
                isAdd = $(this).hasClass("add");
            if (currentVal != 0) {
                !isNaN(currentVal) &&
                    $qty.val(
                        isAdd
                            ? ++currentVal
                            : currentVal > 1
                            ? --currentVal
                            : currentVal
                    );
                var soldPrice = parseFloat($sold_price.val());
                console.log(soldPrice);
                var url = addLangToUrl(
                    `${base_url}admin/pos/update_cart_item/${id}/${currentVal}/${price}/${soldPrice}`
                );
                $.post(
                    url,
                    { _token: csrf_token },
                    function (json) {
                        if (json.st == 1) {
                            $("#show_posItems").html(json.load_data);
                        }
                    },
                    "json"
                );
            }
        });
    });

    $(function () {
        $(document).on("click", ".cartUpdate", function () {
            var id = $(this).data("id");
            var price = parseFloat($(this).data("price"));
            var qty = $(this).data("qty");
            var $sold_price = $(this).closest(".priceGroup").find(".soldPrice");

            var soldPrice = parseFloat($sold_price.val());

            var url = addLangToUrl(
                `${base_url}admin/pos/cart_update_form/${id}/${qty}/${price}/${soldPrice}`
            );
            $.post(
                url,
                { _token: csrf_token },
                function (json) {
                    if (json.st == 1) {
                        $("#show_posItems").html(json.load_data);
                    }
                },
                "json"
            );
        });
    });

    $(document).on("keypress keyup blur", ".number", function (event) {
        $(this).val(
            $(this)
                .val()
                .replace(/[^0-9\.]/g, "")
        );
        if (
            (event.which != 46 || $(this).val().indexOf(".") != -1) &&
            (event.which < 48 || event.which > 57)
        ) {
            event.preventDefault();
        }
    });

    $(document).on("keypress keyup blur", ".only_number", function (event) {
        $(this).val(
            $(this)
                .val()
                .replace(/[^\d].+/, "")
        );
        if (event.which < 48 || event.which > 57) {
            event.preventDefault();
        }
    });

    $(document).on(
        "keypress keyup blur",
        "input[name*=price] .price",
        function (event) {
            var inputValue = $(this).val();
            var containsDot = inputValue.indexOf(".") !== -1;

            if (
                (event.which < 48 || event.which > 57) &&
                (event.which !== 46 || containsDot)
            ) {
                event.preventDefault();
            }

            if (event.which === 46 && containsDot) {
                event.preventDefault();
            }
        }
    );

    /*----------------------------------------------
            Change preferences settings
  ----------------------------------------------*/

    $(function () {
        $(document).on("change", ".setting_option", function () {
            var type = $(this).data("type");
            var value = $(this).data("value");
            var setData = this;
            var url = addLangToUrl(
                `${base_url}admin/settings/setting_status/${type}/${value}`
            );
            $.post(
                url,
                { _token: csrf_token },
                function (json) {
                    if (json.st == 1) {
                        if (value == 1) {
                            MSG(0, item_deactive);
                            $(setData).data("value", 0);
                        } else {
                            MSG(1, item_active);
                            $(setData).data("value", 1);
                        }
                    }
                },
                "json"
            );
            return false;
        });
    });

    $(document).on("submit", ".productVariants", function (e) {
        var url = $(this).attr("action");
        var lang = $(this).data("lang");
        console.log(lang);
        $(this).prop("disabled", true);
        $.post(
            url,
            $(this).serialize(),
            function (json) {
                if (json.st == 1) {
                    $(".variantsLoad_" + lang).html(json.load_data);
                    $("#variantModal_" + lang).modal("hide");
                }
            },
            "json"
        );
        return false;
    });

    /*----------------------------------------------
    PICKUP TIME SLOT
  ----------------------------------------------*/
    $(document).on("click", ".timeCheckeds", function (event) {
        if ($(this).is(":checked")) {
            $(this).parent(".time_slot").addClass("active");
        } else {
            $(this).parent(".time_slot").removeClass("active");
        }
    });

    $(document).on("keyup", "#username", function () {
        if ($(".alert_msg").length == 0) {
            $(this).after('<span class="alert_msg"></span>');
        }

        var val = $(this).val();
        if (val == "") {
            return;
        }
        if (val.match(/\s/g)) {
            $(".alert_msg").html("No space allowed").addClass("error");
            var newName = val.replace(/\s/g, "");
            $(this).val(newName);
        } else {
            $(".alert_msg").html("");
        }
    });

    $(document).on("click", ".resetPassword", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        swal(
            {
                title: are_you_sure,
                text: want_to_reset_password,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: yes,
                cancelButtonText: cancel,
                closeOnConfirm: false,
            },
            function () {
                $.post(
                    url,
                    { _token: csrf_token },
                    function (json) {
                        if (json.st == 1) {
                            swal(
                                {
                                    title: success,
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                },
                                function () {}
                            );
                        }
                    },
                    "json"
                );
            }
        );
        return false;
    });

    $(document).on("input", ".slug", function () {
        const cleanValue = $(this)
            .val()
            .replace(/[^A-Za-z0-9]/g, "");
        $(this).val(cleanValue);
    });
})(jQuery);
