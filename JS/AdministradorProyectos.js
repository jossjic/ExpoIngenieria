// Mostrar ventana emergente para ingresar el enlace del video
function showVideoLinkInput() {
	const modal = document.getElementById("video-link-modal");
	modal.style.display = "block";
}

//Mostrar ventana emergente para ingresar el enlace del archivo
function showPosterLinkInput() {
	const modal = document.getElementById("poster-link-modal");
	modal.style.display = "block";
}

//Mostrar ventana emergente para ingresar informacion del estudiante
function showStudentFieldInput() {
	const modal = document.getElementById("estudiante-data-modal");
	modal.style.display = "block";
}

//Mostrar ventana emergente para ingresar informacion del profesor
function showTeacherFieldInput() {
	const modal = document.getElementById("docente-data-modal");
	modal.style.display = "block";
}


//==================================================================

// Ocultar ventana emergente para ingresar el enlace del video
function hideVideoLinkInput() {
	const modal = document.getElementById("video-link-modal");
	modal.style.display = "none";
}

//Ocultar ventana emergente para ingresar el enlace del video
function hidePosterLinkInput() {
	const modal = document.getElementById("poster-link-modal");
	modal.style.display = "none";
}

// Ocultar ventana emergente para ingresar el enlace del video
function hideStudentFieldInput() {
	const modal = document.getElementById("estudiante-data-modal");
	modal.style.display = "none";
}

//Ocultar ventana emergente para ingresar el enlace del video
function hideTeacherFieldInput() {
	const modal = document.getElementById("docente-data-modal");
	modal.style.display = "none";
}



//==================================================================

//==================================================================

document.querySelector(".close-poster").addEventListener("click", () => {
	document.querySelector(".modal-poster").style.display = "none";
});

document.querySelector(".close-video").addEventListener("click", () => {
	document.querySelector(".modal-video").style.display = "none";
});

document.querySelector(".close-estudiante").addEventListener("click", () => {
	document.querySelector(".modal-estudiante").style.display = "none";
});

document.querySelector(".close-docente").addEventListener("click", () => {
	document.querySelector(".modal-docente").style.display = "none";
});

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
