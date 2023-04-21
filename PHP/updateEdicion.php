<?php

	require 'dataBase.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: index.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $ed_idError = null;
        $ed_nombreError = null;
		$ed_fecha_inicioError = null;
		$ed_fecha_finError  = null;

		// keep track post valuesv 
        $ed_id = $_POST['ed_id'];
		$ed_nombre = $_POST['ed_nombre'];
		$ed_fecha_inicio  = $_POST['ed_fecha_inicio'];
        $ed_fecha_fin = $_POST['ed_fecha_fin'];

		/// validate input
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

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE V2_EDICION  set ed_id = ?, ed_nombre = ?, ed_fecha_inicio =?, ed_fecha_fin= ? WHERE ed_id = ?";
			$q = $pdo->prepare($sql);
			//$acq = ($ac=="S")?1:0;
			$q->execute(array($ed_id,$ed_nombre,$ed_fecha_inicio,$ed_fecha_fin,$ed_id));
			Database::disconnect();
			header("Location: EdicionCRUD.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM V2_EDICION where ed_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ed_id 	= $data['ed_id'];
        $ed_nombre 	= $data['ed_nombre'];
		$ed_fecha_inicio = $data['ed_fecha_inicio'];
		$ed_fecha_fin = $data['ed_fecha_fin'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
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
		    		<h3>Actualizar datos de una edicion</h3>
		    	</div>

	    			<form class="form-horizontal" action="updateEdicion.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($ed_idError)?'error':'';?>">

					    <label class="control-label">ID</label>
					    <div class="controls">
					      	<input name="ed_id" type="text" readonly placeholder="id" value="<?php echo !empty($ed_id )?$ed_id :''; ?>">
					      	<?php if (!empty($ed_idError)): ?>
					      		<span class="help-inline"><?php echo $ed_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($ed_nombreError)?'error':'';?>">

					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="ed_nombre" type="text" placeholder="nombre" value="<?php echo !empty($ed_nombre)?$ed_nombre:'';?>">
					      	<?php if (!empty($ed_nombreError)): ?>
					      		<span class="help-inline"><?php echo $ed_nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                    <div class="control-group <?php echo !empty($ed_fecha_inicioError)?'error':'';?>">

					    <label class="control-label">Fecha Inicio</label>
					    <div class="controls">
					      	<input name="ed_fecha_inicio" type="date" placeholder="fecha inicio" value="<?php echo !empty($ed_fecha_inicio)?$ed_fecha_inicio:'';?>">
					      	<?php if (!empty($ed_fecha_inicioError)): ?>
					      		<span class="help-inline"><?php echo $ed_fecha_inicioError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                        <div class="control-group <?php echo !empty($ed_fecha_finError)?'error':'';?>">

					    <label class="control-label">Fecha fin</label>
					    <div class="controls">
					      	<input name="ed_fecha_fin" type="date" placeholder="fecha fin" value="<?php echo !empty($ed_fecha_fin)?$ed_fecha_fin:'';?>">
					      	<?php if (!empty($ed_fecha_finError)): ?>
					      		<span class="help-inline"><?php echo $ed_fecha_finError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="EdicionCRUD.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
 