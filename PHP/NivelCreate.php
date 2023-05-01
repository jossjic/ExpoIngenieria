<?php

	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in'])) {
		header("Location: ../index.php");
		exit();
	}

		$n_idError = null;
		$n_nombreError = null;

	if ( !empty($_POST)) {

        $n_id = $_POST['n_id'];
		$n_nombre = $_POST['n_nombre'];

		// validate input
		$valid = true;

		if (empty($n_nombre)) {
			$n_nombreError = 'Porfavor Ingresa un nombre de nivel';
			$valid = false; 
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `NIVEL` (`n_id`,`n_nombre`) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($n_id,$n_nombre));
			Database::disconnect();
			header("Location: NivelView.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD EDICION</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/galeria.css">
	</head>

    <header>
        <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
        <ul>
        <li>
            <a href="#">Layout Proyectos</a>
        </li>
        </ul>
        <nav>
        <ul>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
        </nav>
    </header>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Registro de Niveles</h3>
		   		</div>

				<form class="form-horizontal" action="createNivel.php" method="post">


				<div class="control-group <?php echo !empty($n_nombreError)?'error':'';?>">
						<label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="n_nombre" type="text"  placeholder="Nombre Nivel" value="">
					      	<?php if (($n_nombreError != null)) ?>
					      		<span class="help-inline"><?php echo $n_nombreError;?></span>
					    </div>
				</div>


					<div>
						<input class="btn btn-primary btn-block" type="submit" value="Agregar edicion" id="submit" name="submit">
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>