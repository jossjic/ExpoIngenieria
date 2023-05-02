const fechafinal = document.getElementById("countdown").textContent;
const fechafinalmilisegundos = new Date(fechafinal);
const timestamp = fechafinalmilisegundos.getTime();
console.log(timestamp);

// Obtenemos la fecha actual
const now = new Date().getTime();

// // Obtenemos la fecha del timestamp en milisegundos
// const timestamp =
// 	document.getElementById("countdown").textContent * 1000;

// Calculamos el tiempo restante en milisegundos
const timeRemaining = timestamp - now;

// Convertimos los milisegundos a días, horas, minutos y segundos
const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
const hours = Math.floor(
	(timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
);
const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

// Actualizamos el contenido del elemento HTML con ID "countdown"
const countdownElement = document.getElementById("countdown");
countdownElement.textContent = `${days}:${hours}:${minutes}:${seconds}`;

// Creamos un intervalo que actualiza el contador cada segundo
const intervalId = setInterval(() => {
	// Obtenemos la fecha actual
	const now = new Date().getTime();

	// Calculamos el tiempo restante en milisegundos
	const timeRemaining = timestamp - now;

	// Convertimos los milisegundos a días, horas, minutos y segundos
	const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
	const hours = Math.floor(
		(timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
	);
	const minutes = Math.floor(
		(timeRemaining % (1000 * 60 * 60)) / (1000 * 60)
	);
	const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

	// Actualizamos el contenido del elemento HTML con ID "countdown"
	countdownElement.textContent = `${days}:${hours}:${minutes}:${seconds}`;

	// Si el tiempo restante es menor o igual a cero, detenemos el intervalo
	if (timeRemaining <= 0) {
		clearInterval(intervalId);
		countdownElement.textContent = "¡Se ha alcanzado la fecha límite!";
	}
}, 1000);
