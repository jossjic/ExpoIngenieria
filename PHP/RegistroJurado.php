<?php 
	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
	    header("Location: ../index.php");
	    exit();
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Registro Jurado</title>

		<link rel="stylesheet" href="../CSS/UploadJurado.css" />
		<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css" />
	</head>
	<body>
		<header>
			<a href="../index.php"
				><img
					class="Logo__Expo"
					src="../media/logo-expo.svg"
					alt="Logotipo de Expo ingenierías"
			/></a>
			<ul style="grid-column: 2/4">
				<li><a href="../PHP/AdminInicio.php">Menu</a></li>
				<li><a href="../PHP/AvisosView.php">Avisos</a></li>
				<li><a href="../PHP/EdicionView.php">Ediciones</a></li>
				<li><a href="../PHP/NivelView.php">Nivel</a></li>
				<li><a href="../PHP/CategoriaView.php">Categorias</a></li>
				<li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
				<li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
				<li><a href="../PHP/AdministradoresView.php">Administradores</a></li>
				<li><a href="../PHP/EvaluacionesView.php">Evaluaciones</a></li>
				<li style="font-weight: 600;">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

		<main>
			<div class="upload">
				<h2>Subir archivo CSV</h2>
				<form
					method="post"
					action="CargarJurado.php"
					enctype="multipart/form-data"
				>
					<input type="file" name="file" />
					<button type="submit">Subir</button>
				</form>
				<br />
				<br />
				<button onclick="asignarJurado()">Asignar Jurado Aleatoriamente</button>
			</div>
			<div class="container">
				<h1>Jurado</h1>
				<table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Correo</th>
							<th>Edicion</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$pdo = Database::connect();
						$sql = "SELECT co_nombre, co_apellido, co_correo, ed_nombre FROM COLABORADOR NATURAL JOIN EDICION_COLABORADOR NATURAL JOIN EDICION WHERE co_es_jurado = true";
						$stmt = $pdo->prepare($sql);
						$stmt->execute();
						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

						foreach ($result as $row) {
							echo "<tr>";
							echo "<td>" . $row['co_nombre'] . "</td>";
							echo "<td>" . $row['co_apellido'] . "</td>";
							echo "<td>" . $row['co_correo'] . "</td>";
							echo "<td>" . $row['ed_nombre'] . "</td>";
							echo "</tr>";
						}
						Database::disconnect();
					?>
					</tbody>
				</table>
			</div>

			<script>
				function asignarJurado() {
					// Crea un objeto XMLHttpRequest
					var xhr = new XMLHttpRequest();

					// Configura la petición HTTP
					xhr.open('GET', '../PHP/AsignarJuezAleatoriamente.php', true);

					// Configura el callback que se llamará cuando se complete la petición
					xhr.onreadystatechange = function() {
						if (xhr.readyState === XMLHttpRequest.DONE) {
						if (xhr.status === 200) {
							// La petición se completó correctamente
							alert('Jurado asignado aleatoriamente');
						} else {
							// La petición falló
							alert('Error al asignar jurado: ' + xhr.status);
						}
						}
					};

					// Envía la petición HTTP
					xhr.send();
				}
			</script>

		</main>
	</body>
</html>
