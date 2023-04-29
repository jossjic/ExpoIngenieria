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

        <title>Avisos View</title>

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
				<li><a href="#">Nivel</a></li>
				<li><a href="#">Categorias</a></li>
				<li><a href="#">Usuarios</a></li>
				<li><a href="#">Proyectos</a></li>
				<li><a href="#">Administradores</a></li>
				<li><a href="#">Evaluaciones</a></li>
				<li style="font-weight: 600; font-size: 1.2em">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

		<main>

			<div class="Admin__Start">
				<div class="Admin__Start__Left">
					<h1>Administrador de Anuncios</h1>
					<table>
						<tr>
							<td>Avisos Totales</td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM ANUNCIOS";
									$q = $pdo->query($sql)->rowCount();
									echo $q;
									Database::disconnect();
								?>
							</td>
						</tr>
					</table>
				</div>

				<div class="Estadisticas__Btn">
					<a class="Admin__Start__Right__Btn" href="../PHP/AvisosCreate.php">Crear Anuncio</a>
				</div>
			</div>

			<form action="../PHP/AvisosBusqueda.php" method="post" class="Winners__Explorer">
				<table>
					<tr>
						<td>
							Buscar
						</td>
						<td>
							<select name="Anuncio" id="Anuncio">
								<option value="Titulo">Titulo</option>
								<option value="Grupo">Grupo</option>
								<option value="Fecha">Fecha</option>
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
					<p>Titulo</p>
					<p>Grupo</p>
					<p>Fecha</p>
					<div>
						<p>Acciones</p>
					</div>
				</div>
				<div class="Info__Table">
							
                                <?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM ANUNCIO ORDER BY an_id";
									foreach ($pdo->query($sql) as $row) {
										echo "
											<p>&nbsp;</p>
                                            <p></p>
                                            <p>ID</p>
                                            <p>Titulo</p>
                                            <p>Grupo</p>
                                            <p>Fecha</p>
                                            <div class='Btn__Green'>
                                                <a href='../PHP/AvisosRead.php?id=".trim($row['an_id'])."'>Ver</a>
                                            </div>
                                            <div class='Btn__Blue'>
                                                <a href='../PHP/AvisosUpdate.php?id=".trim($row['an_id'])."'>Actualizar</a>
                                            </div>
                                            <div class='Btn__Red'>
                                                <a href='../PHP/AvisosDelete.php?id=".trim($row['an_id'])."'>Eliminar</a>
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
