(function ($) {
    "use strict";

    $(document).on("click", ".submitBtn", function () {
        $(this).prop("disabled", true);
        $(this).addClass("btn-loading");
        $(this).parents("form:first").submit();
    });

    $(function () {
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
    });

    $(function () {
        $(document).on("click", ".hideSidebar", function () {
            if ($(".alert_msg").length == 0) {
                $(this).after('<span class="alert_msg"></span>');
            }
            $(".defaultSidebar > .title").text("");
            $(".defaultSidebar > .sidebarContent").html("");
            $(".defaultSidebar, .sidebar-footer").removeClass("active");
            document.body.classList.remove("sidebar-open");
        });

        $(document).on("click", ".showSidebar", function () {
            var heading = $(".sidebar-modal > .heading").text();
            var content = $(".sidebar-modal > .sidebar-content").html();

            $(".defaultSidebar > .sidebar_header > .title").text(heading);
            $(".defaultSidebar > .sidebarContent").html(content);
            $(".defaultSidebar").addClass("active");

            setTimeout(() => {
                $(".sidebar-footer").addClass("active");
            }, 100);
        });
    });
})(jQuery);
