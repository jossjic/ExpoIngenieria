<?php

	require 'dataBase.php';

	$id = null;
	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// keep track validation errors
		$p1Error   = null;
		$p2Error   = null;
		$p3Error   = null;
		$p4Error   = null;
		$p5Error   = null;

		// keep track post values
		$id = $_POST['id'];
		$p1 = $_POST['p_1'];
		$p2 = $_POST['p_2'];
		$p3 = $_POST['p_3'];
		$p4 = $_POST['p_4'];
		$p5 = $_POST['p_5'];

		/// validate input
		$valid = true;

		if (empty($p1)) {
			$p1Error = 'Por favor complete este campo';
			$valid = false;
		}

		if (empty($p2)) {
			$p2Error = 'Por favor complete este campo';
			$valid = false;
		}

		if (empty($p3)) {
			$p3Error = 'Por favor complete este campo';
			$valid = false;
		}

		if (empty($p4)) {
			$p4Error = 'Por favor complete este campo';
			$valid = false;
		}

		if (empty($p5)) {
			$p5Error = 'Por favor complete este campo';
			$valid = false;
		}

		// update data
		if ($valid) {
			$user_id = "A01234569";
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT * 
			        FROM V2_PROYECTO 
			        NATURAL JOIN 
			        V2_CATEGORIA
			        WHERE p_estado = ?
			        ORDER BY p_nombre';

			$q = $pdo->prepare($sql);
			$q->execute(array("Aceptado"));
			$projects = $q->fetchAll();
			$number_of_projects = $q->rowCount();

			/*$q = $pdo->prepare($sql);
			$acq = ($ac=="S")?1:0;
			$q->execute(array($id,$subm,$marc,$acq, $id));
			Database::disconnect();

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE auto  set idauto = ?, nombrec = ?, idmarca =?, ac= ? WHERE idauto = ?";
			$q = $pdo->prepare($sql);
			$acq = ($ac=="S")?1:0;
			$q->execute(array($id,$subm,$marc,$acq, $id));
			Database::disconnect();
			header("Location: index.php");
			*/
		}
	}
	else {
		if ($id == null) {
			// Dependiendo del tipo de usuario es la ruta a la que se enviará
			header("Location: admisionProyectos.php");
		}

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * 
		        FROM V2_PROYECTO 
		        NATURAL JOIN V2_CATEGORIA 
		        WHERE p_id = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$project = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();

		// Aquí irá el chequeo del login del usuario para obtener el registro de su calificacion
		// sobre el proyecto (si no hay una calificacion de este jurado para el proyecto, no
		// se modifica nada del formulario, en caso contrario, se crearan variables con el puntaje de
		// cada uno de los criterios y posteriormente se asignará a los radio buttons)
		//$id = $project['p_id'];
		//$subm = $project['nombrec'];
		//$marc = $project['idmarca'];
		#$ac   = ($project['ac'])?"S":"N";
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

		<title>Proyectos a calificar | EngineerXpoWeb</title>

		<link rel="stylesheet" href="../CSS/estructuraProyecto.css">
		<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
	</head>
	<body>
		<header>
		    <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logotipo de la Escuela de Ingeniería y Ciencias">
		    <ul>
		        <li><a href="#">Inicio</a></li>
		        <li><a href="#">Layout de proyectos</a></li>
		    </ul>
		    <nav>
		        <ul>
		            <li><a href="#">Cerrar Sesion</a></li>
		        </ul>
		    </nav>
		</header>

	    <main>
	    	<div class="container">
		    	<div class="top-page">
		    		<h1>AZKABÁN</h1>
		    		<br>
		    		<dl>
		    			<dt><strong>Descripción</strong></dt>
		    			<dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id venenatis eros. Nam porttitor dolor vel nulla fermentum laoreet eu vitae.</dd>
		    		</dl>
		    		<br>
		    		<dl>
		    			<dt><strong>Autores</strong></dt>
		    			<dd>Jeffrey Hutchinson</dd>
		    			<dd>Ricardo Hall</dd>
		    			<dd>Brett Wang</dd>
		    			<dd>Karina Allison</dd>
		    		</dl>
		    	</div>

				<form>
					<fieldset class="rubric-container">
						<legend><strong>Rúbrica de evaluación</strong></legend>
						<br>
						<hr>
						<div class="rubric-elements">
							<table>
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>Deficiente</th>
										<th>Regular</th>
										<th>Bueno</th>
										<th>Excelente</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Lorem ipsum dolor sit amet</td>
										<td><input type="radio" id="a_1" name="a" value="1"checked></td>
										<td><input type="radio" id="a_2" name="a" value="2"></td>
										<td><input type="radio" id="a_3" name="a" value="3"></td>
										<td><input type="radio" id="a_4" name="a" value="4"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="rubric-elements">
							<table>
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>Deficiente</th>
										<th>Regular</th>
										<th>Bueno</th>
										<th>Excelente</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Lorem ipsum dolor sit amet</td>
										<td><input type="radio" id="b_1" name="b" value="1"checked></td>
										<td><input type="radio" id="b_2" name="b" value="2"></td>
										<td><input type="radio" id="b_3" name="b" value="3"></td>
										<td><input type="radio" id="b_4" name="b" value="4"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="rubric-elements">
							<table>
								<tr>
									<td>Lorem ipsum dolor sit amet</td>
									<td>
										<select class="box_input" name="d" id="d">
											<option value="d_1">Lorem ipsum 1</option>
											<option value="d_2">Lorem ipsum 2</option>
											<option value="d_3">Lorem ipsum 3</option>
											<option value="d_4">Lorem ipsum 4</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<hr>
						<div class="rubric-elements">
							<table>
								<tr>
									<td>Lorem ipsum dolor sit amet</td>
									<td><input class="box_input" type="text" placeholder="Lorem ipsum"></td>
								</tr>
							</table>
						</div>
						<hr>
						<div class="rubric-elements">
							<table>
								<tr>
									<td>Lorem ipsum dolor sit amet</td>
									<td><textarea class="box_input" type="text-area" placeholder="Lorem ipsum"></textarea></td>
								</tr>
							</table>
						</div>
					</fieldset>
				</form>
				<input class="submit-btn" value="Confirmar calificación" type="button"> 
			</div>
	    </main>
	</body>
</html>