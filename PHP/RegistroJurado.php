<?php 
	require_once 'dataBase.php';
?>

<!DOCTYPE html>
<html lang="en">
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
			<img
				class="Logo__EscNegCie"
				src="../media/logotec-ings.svg"
				alt="Logo Escuela de Negocios"
			/>
			<ul>
				<li>
					<a href="" rel="noopener noreferrer">Inicio</a>
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
				<button>Asignar Jurado Aleatoriamente</button>
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

		</main>
	</body>
</html>
