$(() => {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#email").on('change', () => {
        $("#email").removeClass("is-invalid");
    });

    $('#form').on('submit', event => {
        event.preventDefault();
        if ($("#email").val() == "") {
            $("#email").addClass("is-invalid");
        } else {
            info = {
                email: $("#email").val()
            };
            $.ajax({
                type: "post",
                url: "/restaurar-passwords/confirmacao-email",
                context: event.currentTarget,
                data: info,
                success: function (data) {
                    $("#form").addClass("was-validated");
                    $("#infoModal").modal("show");
                },
                error: function () {
                    $("#email").addClass("is-invalid");
                    $(".invalid-feedback").text("Oops, não conseguimos encontrar esse e-mail...");
                }
            });
        }
    });
});
