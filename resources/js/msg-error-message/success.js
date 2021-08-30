$(() => {
    $("#success-alert").fadeTo(2500, 500).slideUp(500, function () {
        $("#success-alert").slideUp(500);
    });
});
