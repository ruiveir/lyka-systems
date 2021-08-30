$(() => {
    $(".saveEvent").on('click', () => {
        let id = $("#modalCalendar input[name='id']").val();

        let title = $("#modalCalendar input[name='titulo']").val();

        let start = $("#modalCalendar input[name='dataInicio']").val();

        let end = $("#modalCalendar input[name='dataFim']").val();

        let color = $("#modalCalendar input[name='cor']").val();

        let description = $("#modalCalendar textarea[name='descricao']").val();
    });

    /* VALIDAÇÃO DE INPUTS */

    /* Apenas numeros:  .numbersOnly();  */
    $("#startDate").numbersOnly();
    $("#endDate").numbersOnly();

    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $("#titleModal").on('click', () => {
        $(".limpar").each(() => {
            $(".limpar").val("");
            $("#color").val("#6A74C9");
        });
    });
});

function resetForm(form) {
    $(form)[0].reset();
}
