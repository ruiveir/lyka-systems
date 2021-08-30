$(() => {
	var clones = $('#clonar').clone();
	$('#clonar').remove();

	function addCampo(closest) {
		var num = parseInt(closest.find('.num').first().text());
		var clone = clones.clone();
		closest.find('.num').first().text(num + 1);
		clone.attr('id', 'documento-campo' + num);
		$('#label1', clone).text("Nome do campo n.º" + num);
		$('#label1', clone).attr('for', 'nome-campo' + num);
		$('#input1', clone).attr('name', 'nome-campo' + num);
		$('#input1', clone).attr('id', 'nome-campo' + num);
		$('#label2', clone).text("Valor do campo n.º" + num);
		$('#label2', clone).attr('for', 'valor-campo' + num);
		$('#input2', clone).attr('name', 'valor-campo' + num);
		$('#input2', clone).attr('id', 'valor-campo' + num);
		$('#button', clone).on('click', event => {
			event.preventDefault();
			$('#nome-campo' + num).val(null);
			$('#valor-campo' + num).val(null);
			$("#nome-campo" + num).attr("required", false);
			$("#valor-campo" + num).attr("required", false);
			$(event.currentTarget).closest("#documento-campo" + num).css("display", "none");
		});
		$('#button', clone).attr('id', 'javascript-button');
		$('#a_button', clone).text('Remover campo n.º' + num);
		closest.find('.list-clones').first().append(clone);
	}

	//Preview do Passporte+++++++++++++++
	$('#passport_preview_file').on('click', event => {
		event.preventDefault();
		$('#img_doc').trigger('click');
	});

	$('#doc_preview').on('click', event => {
		event.preventDefault();
		$('#img_doc').trigger('click');
	});

	function readPassaPortImgURL(input) {
		if (input.files && input.files[0]) {
			var iddocumento = new FileReader();
			iddocumento.onload = () => {
				iddocumento.fileName = img_doc.name;
				$('#name_doc_file').text(input.files[0].name);
			}

			iddocumento.readAsDataURL(input.files[0]);
		}
	}

	$("#img_doc").on('change', event => {
		readPassaPortImgURL(event.currentTarget);
		$('#passport_preview_file').hide();
		$('#doc_preview').show();

	});
});
