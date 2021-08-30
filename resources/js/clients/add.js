$(() => {
	var options = [{
			"option": document.getElementById("pessoal-tab")
		},
		{
			"option": document.getElementById("documentation-tab")
		},
		{
			"option": document.getElementById("academicos-tab")
		},
		{
			"option": document.getElementById("contacts-tab")
		},
		{
			"option": document.getElementById("financas-tab")
		}
	];

	$("#pessoal-tab, #documentation-tab, #academicos-tab, #contacts-tab, #financas-tab").on('click', event => {
		for (var i = 0; i < options.length; i++) {
			if (event.currentTarget.id === options[i].option.id) {
				$(this).removeClass("bg-white").addClass("bg-primary text-white");
			} else {
				$(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
			}
		}
	});

	$(".needs-validation").on('submit', event => {
		if (event.currentTarget.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			$("#cancelBtn").removeAttr("onclick");
			button =
				"<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
			$("#groupBtn").append(button);
			$("#submitbtn").remove();
		}
		$(".needs-validation").addClass("was-validated");
	});
});
