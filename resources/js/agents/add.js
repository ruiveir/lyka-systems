function checkTypeValidity(event) {
	let typeField = document.querySelector("#tipo");
	let parentAgentField = document.querySelector("#idAgenteAssociado");

	let type = typeField.value;
	let parentAgentId = parentAgentField.value;

	if (type === 'Subagente' && (!parentAgentId || parentAgentId === 0)) {
		parentAgentField.setCustomValidity("Tem que selecionar um agente");
	} else
		parentAgentField.setCustomValidity("");
}

$(() => {
	$("#tipo").on('input', checkTypeValidity);
	$("#idAgenteAssociado").on('input', checkTypeValidity);

	$(".needs-validation").on('submit', event => {
		if (event.currentTarget.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			$("#cancelBtn").removeAttr("onclick");
			let button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
			$("#groupBtn").append(button);
			$("#submitbtn").remove();
		}
		$(".needs-validation").addClass("was-validated");
	});

	if ($("#aux_idAgenteAssociado").val() != "") {
		$("#idAgenteAssociado").val($("#aux_idAgenteAssociado").val());
		$("#div_subagente").show();
		$("#div_execao").show();
	}

	if ($("#tipo").val() == "Agente") {
		$("#div_subagente").hide();
		$("#div_execao").hide();
		$("#idAgenteAssociado").prop("disabled", true);
		$("#idAgenteAssociado").val(null);
		$("#div_infos_agente").show();
		$("#div_infos_subagente").hide();
	} else {
		$("#div_infos_agente").hide();
		$("#div_infos_subagente").show();
	}

	$('#tipo').on('change', () => {
		if ($("#tipo").val() == "Subagente") {
			$("#div_subagente").show();
			$("#div_execao").show();
			$("#div_infos_subagente").show();
			$("#div_infos_agente").hide();
			$("#idAgenteAssociado").prop("disabled", false);
			$("#idAgenteAssociado").val(null);
			$("#idAgenteAssociado").focus();

		} else {
			$('#checkbox_exepcao').prop('checked', false);
			$("#exepcao").val("0");
			$("#div_subagente").hide();
			$("#div_execao").hide();
			$("#div_infos_subagente").hide();
			$("#div_infos_agente").show();
			$("#idAgenteAssociado").prop("disabled", true);
			$("#idAgenteAssociado").val(null);
			$("#idAgenteAssociado").prop("disabled", true);
			$("#idAgenteAssociado").val(null);
			$("#idAgenteAssociado").removeClass("was-validated");
			$("#idAgenteAssociado").removeClass("is-invalid");
			$("#idAgenteAssociado").addClass(":invalid");
		}
	});

	$('#idAgenteAssociado').on('change', () => {
		$("#idAgenteAssociado").removeClass("is-invalid");
		$("#idAgenteAssociado").addClass("invalid");
		$("#agent-type-tab").removeClass("border-danger text-danger");
	});

	var options = [{
			"option": document.getElementById("agent-type-tab")
		},
		{
			"option": document.getElementById("personal-tab")
		},
		{
			"option": document.getElementById("documents-tab")
		},
		{
			"option": document.getElementById("contacts-tab")
		},
		{
			"option": document.getElementById("financas-tab")
		}
	]

	$("#agent-type-tab, #personal-tab, #documents-tab, #contacts-tab, #financas-tab").on('click', () => {
		for (var i = 0; i < options.length; i++) {
			if (this.id === options[i].option.id) {
				$(this).removeClass("bg-white").addClass("bg-primary text-white");
			} else {
				$(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
			}
		}
	});
});
