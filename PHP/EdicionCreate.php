<?php

	require 'dataBase.php';

		$ed_idError = null;
		$ed_nombreError = null;
		$ed_fecha_inicioError = null;
		$ed_fecha_finError  = null;

	if ( !empty($_POST)) {

        $ed_id = $_POST['ed_id'];
		$ed_nombre = $_POST['ed_nombre'];
		$ed_fecha_inicio  = $_POST['ed_fecha_inicio'];
        $ed_fecha_fin = $_POST['ed_fecha_fin'];

		// validate input
		$valid = true;

		if (empty($ed_nombre)) {
			$ed_nombreError = 'Porfavor Ingresa un nombre de edicion';
			$valid = false; 
		}
		if (empty($ed_fecha_inicio)) {
			$ed_fecha_inicioError = 'Porfavor Ingresa una fecha de inicio';
			$valid = false;
		}
		if (empty($ed_fecha_fin)) {
			$ed_fecha_finError = 'Porfavor Ingresa una fecha de fin';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `V2_EDICION` (`ed_id`,`ed_nombre`, `ed_fecha_inicio`, `ed_fecha_fin`) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($ed_id,$ed_nombre,$ed_fecha_inicio,$ed_fecha_fin));
			Database::disconnect();
			header("Location: EdicionView.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

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
		   			<h3>Registro de Ediciones</h3>
		   		</div>

				<form class="form-horizontal" action="EdicionCreate.php" method="post">


				<div class="control-group <?php echo !empty($ed_nombreError)?'error':'';?>">
						<label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="ed_nombre" type="text"  placeholder="Nombre Edicion" value="">
					      	<?php if (($ed_nombreError != null)) ?>
					      		<span class="help-inline"><?php echo $ed_nombreError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($ed_fecha_inicioError)?'error':'';?>">
						<label class="control-label">Fecha de inicio</label>
					    <div class="controls">
					      	<input name="ed_fecha_inicio" type="date"  placeholder="Tu Nombre" value="">
					      	<?php if (($ed_fecha_inicioError != null)) ?>
					      		<span class="help-inline"><?php echo $ed_fecha_inicioError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($ed_fecha_finError)?'error':'';?>">
						<label class="control-label">Fecha de fin</label>
					    <div class="controls">
					      	<input name="ed_fecha_fin" type="date"  placeholder="Tu Apellido Paterno" value="">
					      	<?php if (($ed_fecha_finError != null)) ?>
					      		<span class="help-inline"><?php echo $ed_fecha_finError;?></span>
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