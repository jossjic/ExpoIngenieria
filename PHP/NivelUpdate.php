<?php

	require 'dataBase.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: EdicionCRUD.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $n_idError = null;
        $n_nombreError = null;

		// keep track post valuesv 
        $n_id = $_POST['n_id'];
		$n_nombre = $_POST['n_nombre'];

		/// validate input
		$valid = true;

		if (empty($n_nombre)) {
			$n_nombreError = 'Porfavor Ingresa un nombre de edicion';
			$valid = false; 
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE NIVEL  set n_id = ?, n_nombre = ? WHERE n_id = ?";
			$q = $pdo->prepare($sql);
			//$acq = ($ac=="S")?1:0;
			$q->execute(array($n_id,$n_nombre,$n_id));
			Database::disconnect();
			header("Location: NivelCRUD.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM NIVEL where n_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$n_id 	= $data['n_id'];
        $n_nombre 	= $data['n_nombre'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UPDATE EDICION</title>

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
		    		<h3>Actualizar datos de una categoria</h3>
		    	</div>

	    			<form class="form-horizontal" action="updateNivel.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($n_idError)?'error':'';?>">

					    <label class="control-label">ID</label>
					    <div class="controls">
					      	<input name="n_id" type="text" readonly placeholder="id" value="<?php echo !empty($n_id )?$n_id :''; ?>">
					      	<?php if (!empty($n_idError)): ?>
					      		<span class="help-inline"><?php echo $n_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($n_nombreError)?'error':'';?>">

					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="n_nombre" type="text" placeholder="nombre" value="<?php echo !empty($n_nombre)?$n_nombre:'';?>">
					      	<?php if (!empty($n_nombreError)): ?>
					      		<span class="help-inline"><?php echo $n_nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="NivelCRUD.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
 