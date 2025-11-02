$(function () {
    /*----------------------------------------------
    Nice select
  ----------------------------------------------*/
    $(".niceSelect").niceSelect();

    /*----------------------------------------------
    select2
  ----------------------------------------------*/
    $(".select2").select2();

    $(document).on("click", ".hideSidebar", function () {
        if ($(".alert_msg").length == 0) {
            $(this).after('<span class="alert_msg"></span>');
        }
        $(".defaultSidebar > .title").text("");
        $(".defaultSidebar > .sidebarContent").html("");
        $(".defaultSidebar, .sidebar-footer").removeClass("active");
        document.body.classList.remove("sidebar-open");
    });
});
