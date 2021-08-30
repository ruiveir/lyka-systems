$(() => {
    $("#email").on('change', () => {
        $("#error").remove();
    });

    $("#password").on('change', () => {
        $("#error").remove();
    });
});
