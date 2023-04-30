<?php

	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in'])) {
		header("Location: ../index.php");
		exit();
	}

	$id = null;

    if (!empty($_POST)) {

        // keep track post values
        $id   = $_POST['project_id'];
        $action = $_POST['project_action'];

        /// validate input
        $valid = true;

        if (empty($id)) {
            header("Location: ProyectosACalificar.php");
            exit();
        }

        if (empty($action)) {
            header("Location: ProyectosACalificar.php");
            exit();
        }

        if ($action === "calificar") {
            header("Location: CalificarProyecto.php?id=$id");
            exit();
        }
        else {
            header("Location: ProyectosACalificar.php");
            exit();
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

		<title>Proyectos a calificar | EngineerXpoWeb</title>

		<link rel="stylesheet" href="../CSS/estructuraProyecto.css">
        <link rel="stylesheet" href="../CSS/admisionProyecto.css">
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">

	</head>
	<body>
		<header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
				<li><a href="../PHP/DashboardColaboradoresJurado.php">Dashboard</a></li>
                <li><a href="../PHP/Mapa.php">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

	    <main>
			<div class="container">

				<?php
					$pdo = Database::connect();
					$sql = 'SELECT * 
							FROM PROYECTO 
							NATURAL JOIN CATEGORIA
							NATURAL JOIN NIVEL
							NATURAL JOIN EDICION
							NATURAL JOIN PROYECTO_JURADO
							WHERE p_estado = "Aceptado" AND co_correo = \''.$_SESSION['id'].'\'
							ORDER BY p_nombre';

					$projects = $pdo->query($sql);
					Database::disconnect();
					$number_of_projects = $projects->rowCount();
				?>

				<?php if ($number_of_projects == 0): ?>
					<div class="announce"><h2>Sin Proyectos Por Calificar</h2></div>

				<?php else: ?>

					<form action="ProyectosACalificar.php" method="post" id="project-form-id">
						<input type="hidden" name="project_id" value="" id="project-id">
						<input type="hidden" name="project_action" value="" id="project-action">
					</form>
					<fieldset class="project-container">
						<legend><strong>Proyectos por calificar</strong></legend>
						<br>
						<hr>
						<div class="rubric-elements">
							<table>
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Categoría</th>
										<th>Ultima Modificación</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($projects as $row) {

											echo '<tr>';
											echo     '<td>'.$row['p_id'].'</td>';
											echo     '<td>'.$row['p_nombre'].'</td>';
											echo     '<td>'.$row['ca_nombre'].'</td>';
											echo     '<td>'.$row['p_ult_modif'].'</td>';
											echo     '<td>';
											echo         '<button type="button" class="btn btn-secondary" type="button" onclick="gradeProject('.$row['p_id'].')">Calificar</button>';
											echo     '</td>';
											echo '</tr>';
											
										}
									?>
								</tbody>
							</table>
						</div>
					</fieldset>

				<?php endif ?>

			</div>
	    </main>

		<script>
        function gradeProject(projectId) {
            if (document.getElementById("project-id").value === "") {
                document.getElementById("project-id").value = projectId;
                document.getElementById("project-action").value = "calificar";
                document.getElementById("project-form-id").submit();
            }
        }
    </script>
	</body>
</html>