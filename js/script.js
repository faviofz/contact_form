window.onload = function () {
	const form = document.getElementById("myform");
	const submit = document.getElementById("submit");
	form.addEventListener("input", function () {
		const nombre = document.getElementById("nombre");
		const email = document.getElementById("email");

		if (nombre.value != "" && email.value != "") {
			submit.removeAttribute("disabled");
			submit.setAttribute("style", "opacity: 1");
		} else {
			submit.setAttribute("disabled", true);
			submit.setAttribute("style", "opacity: 0.5");
		}
	});

	form.onsubmit = function () {
		return validate(form);
	};
};

function validate(form) {
	fail = validateForename(form.nombre.value);
	fail += validateEmail(form.email.value);

	if (fail == "") return true;
	else {
		alert(fail);
		return false;
	}
}

function validateForename(field) {
	if (field == "") return "El nombre no fue ingresado.\n";
	else if (!/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/.test(field)) {
		return "El nombre contiene carácteres no válidos.\n";
	} else {
		return "";
	}
}

function validateEmail(field) {
	if (field == "") return "El email no fue ingresado.\n";
	else if (
		!(field.indexOf(".") > 0 && field.indexOf("@") > 0) ||
		/[^a-zA-Z0-9.@_-]/.test(field)
	)
		return "El email no es válido.\n";
	return "";
}
