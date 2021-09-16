$(() => {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#code").on('change', () => {
        $("#code").removeClass("is-invalid");
    });

    $('#form').on('submit', event => {
        event.preventDefault();
        if ($("#code").val() == "") {
            $("#code").addClass("is-invalid");
        } else {
            info = {
                code: $("#code").val()
            };
            $.ajax({
                type: "post",
                url: "/restaurar-password/"+userId+"/check-key",
                context: event.currentTarget,
                data: info,
                success: function (data) {
                    $("#form").addClass("was-validated");
                    $("#title > p").text("Apenas necessita de inserir uma password segura e de seguida confirmar a sua escolha.");
                    $("#form").remove();
                    $("#passform").css("display", "block");
                },
                error: function () {
                    $("#code").addClass("is-invalid");
                }
            });
        }
    });

    $("#password").on('change', () => {
        regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if (!regex.test($("#password").val())) {
            $("#password").removeClass("is-valid");
            $("#password").addClass("is-invalid");
        } else {
            $("#password").removeClass("is-invalid");
            $("#password").addClass("is-valid");
        }

        if ($("#password").val() == "") {
            $("#password").removeClass("is-invalid is-valid");
        }
    });

    $("#passwordconf").on('change', () => {
        if ($("#passwordconf").val() == $("#password").val()) {
            $("#passwordconf").removeClass("is-invalid");
            $("#passwordconf").addClass("is-valid");
        } else {
            $("#passwordconf").removeClass("is-valid");
            $("#passwordconf").addClass("is-invalid");
        }

        if ($("#passwordconf").val() == "") {
            $("#passwordconf").removeClass("is-invalid is-valid");
        }
    });

    // Password change form
    $('#passform').on('submit', event => {
        event.preventDefault();
        info = {
            password: $("#password").val(),
            passwordconf: $("#passwordconf").val()
        }

        if (info["password"] != info["passwordconf"]) {
            $("#passwordconf").addClass("is-invalid");
        } else {
            $("#passform").addClass("was-validated");
            $.ajax({
                type: "PUT",
                url: "/restaurar-password/"+userId+"/nova-password",
                context: event.currentTarget,
                data: info,
                success: function (data) {
                    $("#infoModal").modal("show");
                },
                error: function () {
                    console.log("ERROR");
                }
            });
        }
    });
});
