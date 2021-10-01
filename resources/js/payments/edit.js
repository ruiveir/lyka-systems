$(() => {
    $("#editar-pagamento-form").on('submit', event => {
        if (event.currentTarget.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            $("#cancelBtn").removeAttr("onclick");
            button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A registar pagamento...</button>";
            $("#groupBtn").append(button);
            $("#submitbtn").remove();
            var info = new FormData(event.currentTarget);
            $.ajax({
                type: "post",
                enctype: "multipart/form-data",
                url: '/pagamentos/' + idResponsabilidade + '/' + idPagoResp + '/atualizar',
                data: info,
                context: event.currentTarget,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#modal-success").modal("show");
                    $("#anchor-stream").attr("href", "/pagamentos/nota-pagamento/" + data.idPagoResp + "/transferir");
                    $("#anchor-stream").on('click', () => {
                        setTimeout(function () {
                            link = window.location.origin;
                            window.location.assign(link + "/pagamentos");
                        }, 500);
                    });
                },
                error: function () {
                    $("#modal-error").modal("show");
                }
            });
        }
        $(".needs-validation").addClass("was-validated");
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(event.currentTarget);
        modal.find("form").attr('action', '/pagamentos/' + idPagoResp + '/anular');
    });
});