<?php 
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }
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
				<li><a href="../PHP/CategoriasView.php">Categorias</a></li>
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

			<div class="Admin__Start">
				<div class="Admin__Start__Left">
					<h1>Administrador de Ediciones</h1>
					<table>
						<tr>
							<td>Ediciones Totales:</td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM EDICION";
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
								<option value="Fecha Inicio">Fecha Inicio</option>
								<option value="Fecha Fin">Fecha Fin</option>
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
					<p>ID</p>
					<p>Nombre</p>
					<p>Fecha Inicio</p>
					<p>Fecha Fin</p>
					<p></p>
					<div>
						<p>Acciones</p>
					</div>
				</div>
				<div class="Info__Table">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM EDICION ORDER BY ed_fecha_inicio";
									foreach ($pdo->query($sql) as $row) {
										echo "
											<p>&nbsp;</p>
											<p>".$row['ed_id']."</p>
											<p>".$row['ed_nombre']."</p>
											<p>".$row['ed_fecha_inicio']."</p>
											<p>".$row['ed_fecha_fin']."</p>
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
											<p></p>
										";
									}
									Database::disconnect();
								?>

								
				</div>
			</form>
		</main>

	</body> 

</html>
