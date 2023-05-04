//Mostrar ventana emergente para ingresar el enlace del archivo
function showMapaInput() {
	const modal = document.getElementById("poster-link-modal");
	modal.style.display = "block";
}

//Ocultar ventana emergente para ingresar el enlace del video
function hidePosterLinkInput() {
	const modal = document.getElementById("poster-link-modal");
	modal.style.display = "none";
}

document.querySelector(".close-poster").addEventListener("click", () => {
	document.querySelector(".modal-poster").style.display = "none";
});
