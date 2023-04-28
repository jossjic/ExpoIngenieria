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

// Guardar el enlace del video en la base de datos
function saveVideoLink(event) {
	event.preventDefault();
	const url = document.getElementById("url-video").value;

	// Enviar los datos al servidor utilizando AJAX
	const xhr = new XMLHttpRequest();
	xhr.open("POST", "/save-video-link");
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.onload = function () {
		if (xhr.status === 200) {
			console.log("El enlace del video se ha guardado correctamente");
			hideVideoLinkInput();
		} else {
			console.log("Ocurrió un error al guardar el enlace del video");
		}
	};
	xhr.send(JSON.stringify({ url }));
}

// Guardar el enlace del poster en la base de datos
function savePosterLink(event) {
	event.preventDefault();
	const url = document.getElementById("url-poster").value;

	// Enviar los datos al servidor utilizando AJAX
	const xhr = new XMLHttpRequest();
	xhr.open("POST", "/save-poster-link");
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.onload = function () {
		if (xhr.status === 200) {
			console.log("El enlace del poster se ha guardado correctamente");
			hidePosterLinkInput();
		} else {
			console.log("Ocurrió un error al guardar el enlace del poster");
		}
	};
	xhr.send(JSON.stringify({ url }));
}

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
