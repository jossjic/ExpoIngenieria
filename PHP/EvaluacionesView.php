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
    <title>Evaluaciones View</title>

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
					<h1>Administrador de Evaluaciones</h1>
					<table>
						<tr>
							<td>Total de Evaluaciones</td>
							<td id="TotalProyectos">
								<?php
									$pdo = Database::connect();
									$sql = "SELECT * FROM EVALUACION";
									$q = $pdo->query($sql)->rowCount();
									echo "$q";
									Database::disconnect();
								?>
							</td>
						</tr>
					</table>
				</div>

			</div>

			<form action="../PHP/EvaluacionBusqueda.php" method="post" class="Winners__Explorer">
				<table>
					<tr>
						<td>
							Buscar
						</td>
						<td>
							<select name="EvaluacionID" id="ProyectoID">
								<option value="NombreJurado">Nombre Jurado</option>
                                <option value="NombreProyecto">Nombre Proyecto</option>
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
					<p>Nombre Proyecto</p>
					<p>Nombre Jurado</p>
                    <p>Calificacion</p>
					<p></p>
					<div>
						<p>Acciones</p>
					</div>
				</div>
				<div class="Info__Table">
                                <?php
									$pdo = Database::connect();
									$sql = "SELECT * 
                                            FROM EVALUACION
                                            NATURAL JOIN PROYECTO
                                            NATURAL JOIN COLABORADOR
                                            NATURAL JOIN PROYECTO JURADO 
                                            ORDER BY p_id DESC";
									foreach ($pdo->query($sql) as $row) {
										echo "
											<p>&nbsp;</p>
											<p></p>
											<p>".$row['p_nombre']."</p>
											<p>".$row['co_nombre']."</p>
                                            <p>".($row['ev_criterio_1']+$row['ev_criterio_2']+$row['ev_criterio_3']+$row['ev_criterio_4']+$row['ev_criterio_5'])."</p>
                                            <p></p>
											<div>
												<a href='../PHP/EvaluacionesDelete.php?id=".trim($row['p_id'])."&correo=".$row['co_correo']."'>Eliminar</a>
											</div>
											<div>
												
											</div>
											<div >
												
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