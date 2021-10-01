const utils = require('../utils.js');

$(() => {
	$("#formulario-produto").css("display", "none");
	$("#formulario-fases").css("display", "none");

	$(".needs-validation").on('submit', event => {
		if (event.target.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			$("#cancelBtn").removeAttr("onclick");
			button =
				"<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
			$("#groupBtn").append(button);
			$("#submitbtn").remove();
		}
		$(".needs-validation").addClass("was-validated");
	});

	$('#add-fase-button').on('click', onAddNewFase);
	$('#fornecedor-add-button').on('click', onAddFornecedor);
	$('#myTabContent').on('click', '.fornecedor-del-button', onRemoverFornecedor);
	$('#cancel-button').on('click', () => window.history.back());
});


function onAddNewFase(event) {
	numFase++;

	let newTab = utils.template('#template-fase-tab', { numFase });
	let newTabContent = utils.template('#template-fase', { numFase });

	$('#myTab').append(newTab);
	$('#myTabContent').append(newTabContent);
}

//addFornecedor({{$num}},$(this).closest('.list-fornecedores'));
function onAddFornecedor(event) {
	numFornecedor++;

	let numFase = $('.tab-pane:visible').data('num');
	let content = utils.template('#template-fornecedor', { numFase, numFornecedor });

	$('.fornecedor:visible').append(content);
}

//removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'));
function onRemoverFornecedor(event) {
	console.log($(event.currentTarget).closest('.fornecedor-entry'))
	$(event.currentTarget).closest('.fornecedor-entry').remove();
}

function AlteraInputSubAgente(input) {
	var valueInput = input.val();
	if (valueInput) {
		$(".valor-responsabilidade-subagente").css("display", "block");
		$(".valor-responsabilidade-subagente").find(input).first().attr("required", true);
	} else {
		$(".valor-responsabilidade-subagente").css("display", "none");
		$(".valor-responsabilidade-subagente").find(input).first().attr("required", false);
	}
}

function adicionaValorSubAgente(valorAgente, formulario, valorTotal) {
	var inputAgente = formulario.find('.valor-pagar-agente').first();
	var inputSubAgente = formulario.find('.valor-pagar-subagente').first();
	var valorSubAgente = parseFloat(inputSubAgente.text());
	var novoValorAgente = valorTotal - valorSubAgente;
	if (novoValorAgente == 0) {
		inputAgente.text(0);
		inputSubAgente.text(valorAgente);
	} else {
		if (novoValorAgente < 0) {
			inputAgente.text(0);
			inputSubAgente.text(valorTotal);
		} else {
			inputAgente.text(novoValorAgente);
		}
	}
}
