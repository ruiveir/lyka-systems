const bsCustomFileInput = require('bs-custom-file-input');

$(() => {
	bsCustomFileInput.init();

	var table = $('#table-contactos').DataTable({
		"language": {
			"sEmptyTable": "Não foi encontrado nenhum registo",
			"sLoadingRecords": "A carregar...",
			"sProcessing": "A processar...",
			"sLengthMenu": "Mostrar _MENU_ registos",
			"sZeroRecords": "Não foram encontrados resultados",
			"sInfo": "Mostrando _END_ de _TOTAL_ registos",
			"sInfoEmpty": "Mostrando de 0 de 0 registos",
			"sInfoFiltered": "(filtrado de _MAX_ registos no total)",
			"sInfoPostFix": "",
			"sSearch": "Procurar:",
			"sUrl": "",
			"oPaginate": {
				"sFirst": "Primeiro",
				"sPrevious": "Anterior",
				"sNext": "Seguinte",
				"sLast": "Último"
			},
			"oAria": {
				"sSortAscending": ": Ordenar colunas de forma ascendente",
				"sSortDescending": ": Ordenar colunas de forma descendente"
			},
		},
		searching: false,
		paging: false,
	});

	$("#procurar-contactos").on('click', event => {
		event.preventDefault();
		$(".custom-inputs").remove();
		$('#div-table-contactos').addClass("d-none");
		$("#form-contact").removeClass("was-validated");
		$('#modalContacts').modal('show');
		$("#user-type").prepend("<option disabled hidden selected>Escolher tipo de utilizador</option>");
	});

	$("#user-type").on('change', () => {
		$("#form-contact").removeClass("was-validated");
		value = $("#user-type").find(":selected").val();
		switch (value) {
			case "clientes":
				$(".custom-inputs").remove();
				input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do cliente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do cliente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
				$("#contactos-form-row").append(input);
				break;

			case "agentes":
				$(".custom-inputs").remove();
				input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do agente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do agente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
				$("#contactos-form-row").append(input);
				break;

			case "universidades":
				$(".custom-inputs").remove();
				input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome da universidade <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
				$("#contactos-form-row").append(input);
				break;

			case "fornecedores":
				$(".custom-inputs").remove();
				input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome do fornecedor <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
				$("#contactos-form-row").append(input);
				break;

			default:
				$(".custom-inputs").remove();
				break;
		}
	});

	$('#form-contact').on('submit', event => {
		if (event.currentTarget.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			button = "<button class='btn btn-primary' type='submit' disabled id='spin-button'><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A procurar contacto...</button>";
			$("#groupBtn").append(button);
			$("#submitbtn").addClass("d-none");

			info = {
				user: $("#user-type").find(":selected").val(),
				name: $("#name").val(),
				surname: $("#surname").val()
			};

			$.ajax({
				type: "post",
				url: "/procurar-contacto",
				context: event.currentTarget,
				data: info,
				success: function (data) {
					$("#submitbtn").removeClass("d-none");
					$("#spin-button").remove();
					table.clear().draw();
					user = $("#user-type").find(":selected").val();
					switch (user) {
						case 'clientes':
							for (var i = 0; i < data.length; i++) {
								table.row.add([
									data[i].nome + ' ' + data[i].apelido,
									data[i].email,
									data[i].telefone1
								]).draw();
								$('#div-table-contactos').removeClass("d-none");
							}
							break;

						case 'agentes':
							for (var i = 0; i < data.length; i++) {
								table.row.add([
									data[i].nome + ' ' + data[i].apelido,
									data[i].email,
									data[i].telefone1
								]).draw();
								$('#div-table-contactos').removeClass("d-none");
							}
							break;

						case 'universidades':
							for (var i = 0; i < data.length; i++) {
								table.row.add([
									data[i].nome,
									data[i].email,
									data[i].telefone
								]).draw();
								$('#div-table-contactos').removeClass("d-none");
							}
							break;

						case 'fornecedores':
							for (var i = 0; i < data.length; i++) {
								table.row.add([
									data[i].nome,
									"N/A",
									data[i].contacto
								]).draw();
								$('#div-table-contactos').removeClass("d-none");
							}
							break;
					}
				},
				error: error => {
					if (error.status == 404) {
						$("#submitbtn").removeClass("d-none");
						$("#spin-button").remove();
						table.clear().draw();
						$('#div-table-contactos').removeClass("d-none");
					}
				}
			});
		}
		$("#form-contact").addClass("was-validated");
	});

	if (document.referrer.indexOf(window.location.host) != -1) {
		$("#previousButton").removeClass("bg-gray-400");
		$("#previousButton").addClass("bg-gray-600");
	}

	$("#previousButton").on('click', event => {
		if (document.referrer.indexOf(window.location.host) != -1) {
			history.go(-1);
		} else {
			event.preventDefault();
			return false;
		}
	});

	$("#forwardButton").on('click', () => {
		window.history.forward();
	});
});
