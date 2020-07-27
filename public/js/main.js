$("#navigator").on("click", function (event) {
    console.log($(event.target).attr("data-enabled"));
    if ($(event.target).attr("data-enabled") === "0") {
        $(event.target).attr("data-enabled", 1);
        $('#navigator_menu').show();
        $('#navigator_background').show();
    } else {
        $(event.target).attr("data-enabled", 0);
        $('#navigator_menu').hide();
        $('#navigator_background').hide();
    }
});