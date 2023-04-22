<?php 
	require 'dataBase.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title>Ediciones</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/AdminPages.css">
	</head>


    <body>
		<header>
			<img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
			<ul>
				<li>
					<a href="#">Cerrar Sesion</a>
				</li>
			</ul>
			<nav>
				<ul>
					<li><a href="#">Menu</a></li>
					<li><a href="#">Usuarios</a></li>
					<li><a href="#">Reconocimientos</a></li>
					<li><a href="#">Eastadísticas</a></li>
				</ul>
			</nav>
		</header>

		<main>

			<div class="Admin__Start">
				<div class="Admin__Start__Left">
					<h1>Administrador de Ediciones</h1>
					<table>
						<tr>
							<td>Ediciones Totales:</td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM EDICIONV1";
									$q = $pdo->query($sql)->rowCount();
									echo "$q";
									Database::disconnect();
								?>
							</td>
						</tr>
					</table>
				</div>

				<div class="Estadisticas__Btn">
					<a class="Admin__Start__Right__Btn" href="../PHP/EdicionCreate.php">Crear Edicion</a>
				</div>
			</div>

			<form action="../PHP/ProyectosBusqueda.php" method="post" class="Winners__Explorer">
				<table>
					<tr>
						<td>
							Buscar
						</td>
						<td>
							<select name="ProyectoID" id="ProyectoID">
								<option value="ID">ID</option>
								<option value="Nombre">Nombre</option>
							</select>
						</td>
						<td>
							
							<input type="search" name="BuscarNombre" class="Text__Search" id="" placeholder="Ingresa el valor">
							<input type="submit" name="BtnBuscar" class="Search__Btn" id="" value="Buscar">
							
						</td>
						
					</tr>
				</table>
			</form>

			<form method="post" class="Info">
				<div class="Info__Header">
					<p>&nbsp;</p>
					<p></p>
					<p>ID</p>
					<p>Nombre</p>
					<p>Estado</p>
					<p></p>
					<div>
						<p>Acciones</p>
					</div>
				</div>
				<div class="Info__Table">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM V2_EDICION ORDER BY ed_nombre";
									foreach ($pdo->query($sql) as $row) {
										echo "
											<p>&nbsp;</p>
											<p></p>
											<p>" . $row['ed_id'] ."</p>
											<p>" . $row['ed_nombre'] ."</p>
											<p>" . $row['ed_estado'] ."</p>
											<p></p>
											<p></p>
											<div class='Btn__Green'>
												<a href='../PHP/EdicionRead.php?id=".trim($row['ed_id'])."'>Ver</a>
											</div>
											<div class='Btn__Blue'>
												<a href='../PHP/EdicionUpdate.php?id=".trim($row['ed_id'])."'>Actualizar</a>
											</div>
											<div class='Btn__Red'>
												<a href='../PHP/EdicionDelete.php?id=".trim($row['ed_id'])."'>Eliminar</a>
											</div>
										";
									}
									Database::disconnect();
								?>

								
				</div>
			</form>
		</main>

	</body> 

</html>
