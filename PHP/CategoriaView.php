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
        <title>Categoria View</title>

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
					<h1>Administrador de Categorias</h1>
					<table>
						<tr>
							<td>Categorias Totales: </td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM CATEGORIA";
									$q = $pdo->query($sql)->rowCount();
									echo $q;
									Database::disconnect();
								?>
							</td>
						</tr>
					</table>
				</div>


					<a class="Estadisticas__Btn"href="../PHP/CategoriaCreate.php">Crear Categoria</a>

			</div>

			<form action="../PHP/CategoriaBusqueda.php" method="post" class="Winners__Explorer">
				<table>
					<tr>
						<td>
							Buscar
						</td>
						<td>
							<select name="Categoria" id="Anuncio">
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
					<p></p>
					<p></p>
					<div>
						<p>Acciones</p>
					</div>
				</div>
				<div class="Info__Table">
							
                                <?php
									$pdo = Database::connect();
									$sql = 'SELECT * FROM CATEGORIA ORDER BY ca_nombre';
									foreach ($pdo->query($sql) as $row) {
										echo "
											<p>&nbsp;</p>
                                            <p></p>
                                            <p>".$row['ca_id']."</p>
                                            <p>".$row['ca_nombre']."</p>
                                            <p></p>
                                            <p></p>
                                                <a class='Btn__Green' href='../PHP/CategoriaRead.php?id=".trim($row['ca_id'])."'>Ver</a>

                                                <a class='Btn__Blue' href='../PHP/CategoriaUpdate.php?id=".trim($row['ca_id'])."'>Actualizar</a>

                                                <a class='Btn__Red' href='../PHP/CategoriaDelete.php?id=".trim($row['ca_id'])."'>Eliminar</a>
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