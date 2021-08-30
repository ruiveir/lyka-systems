$(() => {
	// Modal for DELETE
	$('#deleteModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		if (button.data('tipo') == "pessoal") {
			modal.find("form").attr('action', '/documento-pessoal/' + button.data('slug') + '/apagar');
		} else {
			modal.find("form").attr('action', '/documento-academico/' + button.data('slug') + '/apagar');
		}
	});
});
