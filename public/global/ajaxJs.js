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

    /*----------------------------------------------
    AJAX FILTER & PAGINATION
    ----------------------------------------------*/


    $(document).on("submit", ".ajaxFilterForm", function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action") + "?" + $form.serialize();
        var target = $form.data("target") || ".card-content";

        history.pushState({ target: target }, "", url);
        ajaxFilter(url, target);
    });


    $(document).on("click", ".ui-pagination a", function (e) {
        var $container = $(this).closest("[data-ajax-container]");
        if ($container.length > 0) {
            e.preventDefault();
            var url = $(this).attr("href");
            var target = $container.data("ajax-container");

            history.pushState({ target: target }, "", url);
            ajaxFilter(url, target);
        }
    });

    $(document).on("click", ".ajaxFilterLink", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var target = $(this).data("target") || ".card-content";

        history.pushState({ target: target }, "", url);
        ajaxFilter(url, target);
    });

    window.onpopstate = function (e) {
        if (e.state && e.state.target) {
            ajaxFilter(window.location.href, e.state.target);
        } else {
            // Fallback if no state (initial page load state)
            location.reload();
        }
    };

})(jQuery);
