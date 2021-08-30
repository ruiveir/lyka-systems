$(() => {
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
