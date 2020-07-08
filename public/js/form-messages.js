// Auto close success message
$(document).ready(function() {
    $("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
        $("#success-alert").slideUp(500);
    });
});

// Auto close error message
$(document).ready(function() {
    $("#error-alert").fadeTo(2500, 500).slideUp(500, function() {
        $("#error-alert").slideUp(500);
    });
});
