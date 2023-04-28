// Seleccionar el formulario y los campos a validar
const form = document.getElementById("student_form");
const nameInput = document.getElementById("student_name");
const lastnameInput = document.getElementById("student_lastname");
const matriculaInput = document.getElementById("student_matricula");
const emailInput = document.getElementById("student_email");

// Función para validar el formulario
function validateForm(event) {
	event.preventDefault(); // Detener el envío del formulario

	let isValid = true; // Bandera de validación

	// Validar el campo de nombre
	if (nameInput.value.trim() === "") {
		isValid = false;
		nameInput.classList.add("error");
	} else {
		nameInput.classList.remove("error");
	}

	// Validar el campo de apellidos
	if (lastnameInput.value.trim() === "") {
		isValid = false;
		lastnameInput.classList.add("error");
	} else {
		lastnameInput.classList.remove("error");
	}

	// Validar el campo de matrícula
	if (matriculaInput.value.trim() === "") {
		isValid = false;
		matriculaInput.classList.add("error");
	} else {
		matriculaInput.classList.remove("error");
	}

	// Validar el campo de correo electrónico
	if (emailInput.value.trim() === "") {
		isValid = false;
		emailInput.classList.add("error");
	} else {
		emailInput.classList.remove("error");
	}

	// Si todos los campos son válidos, enviar el formulario
	if (isValid) {
		form.submit();
	}
}

// Agregar un event listener al formulario para validar cuando se envía
form.addEventListener("submit", validateForm);
