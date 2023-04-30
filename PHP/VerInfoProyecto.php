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
		header("Location: AdmisionProyectos.php");
	} else {
		$pdo = Database::connect();

		//PROYECTO
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * 
		        FROM PROYECTO 
		        NATURAL JOIN CATEGORIA
				NATURAL JOIN NIVEL  
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
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title><?php echo $project['p_nombre'];?> | EngineerXpoWeb</title>

        <link rel="stylesheet" href="../CSS/estructuraProyecto.css">
        <link rel="stylesheet" href="../CSS/admisionProyecto.css">
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    </head>
    <body>
		<header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
				<li><a href="../PHP/DashboardColaboradoresDocente.php">Dashboard</a></li>
                <li><a href="../PHP/Mapa.php">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main class="container my-5">
			<div class="row">
				<div class="col-md-6 text-center">
					<iframe
							<?php
							preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_video'], $match);
							$video_id = $match[1];
							$video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
							echo 'src="'.$video_full_link.'" title="YouTube video player" frameborder="0" allow="accelerometer"; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share allowfullscreen';
							?>
					></iframe>
					<iframe
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
						$teachers = $docente;
						$students = $alumno;

						// Imprime la información del proyecto
						echo "<h2>$project_name</h2>";
						echo "<h3>Categoría: </h3> <p>$category</p>";
						echo "<h3>Nivel: </h3><p>$level</p>";
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
                    <a href="../PHP/AdmisionProyectos.php" class="btn btn-primary mx-2" style="background-color: #0033A0;">Regresar</a>
				</div>
			</div>
    	</main>

    </body>


</html>
