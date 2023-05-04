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

			<div class="Admin__Start">
				<div class="Admin__Start__Left">
					<h1>Administrador de Anuncios</h1>
					<table>
						<tr>
							<td>Avisos Totales: </td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM ANUNCIO";
									$q = $pdo->query($sql)->rowCount();
									echo $q;
									Database::disconnect();
								?>
							</td>
						</tr>
					</table>
				</div>


					<a class="Estadisticas__Btn" href="../PHP/AvisosCreate.php">Crear Anuncio</a>

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
                                            <p>".$row['an_id']."</p>
                                            <p>".$row['an_titulo']."</p>
                                            <p>".$row['an_grupo']."</p>
                                            <p>".$row['an_fecha']."</p>
                                            
                                                <a class='Btn__Green' href='../PHP/AvisosRead.php?id=".trim($row['an_id'])."'>Ver</a>
                                            
                                            
                                                <a class='Btn__Blue' href='../PHP/AvisosUpdate.php?id=".trim($row['an_id'])."'>Actualizar</a>
                                            
                                            
                                                <a class='Btn__Red' href='../PHP/AvisosDelete.php?id=".trim($row['an_id'])."'>Eliminar</a>
                                           
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
