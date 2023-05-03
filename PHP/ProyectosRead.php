<?php
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null) {
		header("Location: ProyectosView.php");
	} else {
		$pdo = Database::connect();

		//PROYECTO
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * 
		        FROM PROYECTO 
		        NATURAL JOIN CATEGORIA
				NATURAL JOIN NIVEL
				NATURAL JOIN EDICION  
		        WHERE p_id = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$project = $q->fetch(PDO::FETCH_ASSOC);

		//DOCENTE PROYECTO
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT *
				FROM COLABORADOR
				NATURAL JOIN PROYECTO_DOCENTE
				WHERE p_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$docente = $q->fetchAll(PDO::FETCH_ASSOC);

		//ALUMNOS
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT *
				FROM ALUMNO
				NATURAL JOIN PROYECTO_ALUMNO
				WHERE p_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$alumno = $q->fetchAll(PDO::FETCH_ASSOC);

		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    <title>Ver Proyectos</title>

    <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

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

        <main class="container my-5">
			<div class="row">
				<div class="col-md-6 text-center">
					<iframe
						width="80%";
						height="50%";
							<?php
							preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_video'], $match);
							$video_id = $match[1];
							$video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
							echo 'src="'.$video_full_link.'" title="YouTube video player" frameborder="0" allow="accelerometer"; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share allowfullscreen';
							?>
					></iframe>
					<iframe
						width="80%";
						height="100%";
							<?php
							preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_poster'], $match);
							$image_id = $match[1];
							$image_full_link = "https://drive.google.com/file/d/".$image_id."/preview";
							echo 'src="'.$image_full_link.'" allow="autoplay"';
							?>
					></iframe>
				</div>
				<div class="col-md-6">
					<?php
						// Aquí va el código PHP para obtener la información del proyecto
						$project_name = $project['p_nombre'];
						$category = $project['ca_nombre'];
						$level = $project['n_nombre'];
						$description = $project['p_descripcion'];
						$edition = $project['ed_nombre'];
						$status = $project['p_estado'];
						$teachers = $docente;
						$students = $alumno;

						// Imprime la información del proyecto
						echo "<h2>$project_name</h2>";
						echo "<h3>Edicion: </h3> <p>$edition</p>";
						echo "<h3>Estado: </h3> <p>$status</p>";
						echo "<h3>Categoría: </h3> <p>$category</p>";
						echo "<h3>Nivel: </h3><p>$level</p>";
						echo "<h3>Descripcion: </h3> <p>$description</p>";
						echo "<h3>Profesores:</h3>";
						echo "<ol>";
						foreach ($teachers as $teacher) {
							echo "<li>".$teacher['co_nombre']." ".$teacher['co_apellido']." ".$teacher['co_correo']."</li>";
						}
						echo "</ol>";
						echo "<h3>Alumnos:</h3>";
						echo "<ol>";
						foreach ($students as $student) {
							echo "<li>".$student['a_nombre']." ".$student['a_apellido']." ".$student['a_correo']."</li>";
						}
						echo "</ol>";
					?>
                    <a href="../PHP/ProyectosView.php" class="btn btn-primary mx-2" style="background-color: #0033A0;">Regresar</a>
				</div>
			</div>
    	</main> 

</body>
</html>