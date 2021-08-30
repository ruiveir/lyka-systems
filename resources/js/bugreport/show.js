$(() => {
    // Edit report modal
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var id = button.data('id');
        modal.find("form").attr('action', '/relatorio-problema/' + button.data('id'));

        $(".needs-validation").on('submit', event => {
            if (event.currentTarget.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            $(".needs-validation").addClass("was-validated");
        });
    });
});
