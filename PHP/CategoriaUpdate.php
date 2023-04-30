<?php

	require 'dataBase.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: CategoriaCRUD.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $ca_idError = null;
        $ca_nombreError = null;

		// keep track post valuesv 
        $ca_id = $_POST['ca_id'];
		$ca_nombre = $_POST['ca_nombre'];

		/// validate input
		$valid = true;

		if (empty($ca_nombre)) {
			$ca_nombreError = 'Porfavor Ingresa un nombre de edicion';
			$valid = false; 
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE CATEGORIA  set ca_id = ?, ca_nombre = ? WHERE ca_id = ?";
			$q = $pdo->prepare($sql);
			//$acq = ($ac=="S")?1:0;
			$q->execute(array($ca_id,$ca_nombre,$ca_id));
			Database::disconnect();
			header("Location: CategoriaCRUD.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM CATEGORIA where ca_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ca_id 	= $data['ca_id'];
        $ca_nombre 	= $data['ca_nombre'];
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

	    			<form class="form-horizontal" action="updateCategoria.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($ca_idError)?'error':'';?>">

					    <label class="control-label">ID</label>
					    <div class="controls">
					      	<input name="ca_id" type="text" readonly placeholder="id" value="<?php echo !empty($ca_id )?$ca_id :''; ?>">
					      	<?php if (!empty($ca_idError)): ?>
					      		<span class="help-inline"><?php echo $ca_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($ca_nombreError)?'error':'';?>">

					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="ca_nombre" type="text" placeholder="nombre" value="<?php echo !empty($ca_nombre)?$ca_nombre:'';?>">
					      	<?php if (!empty($ca_nombreError)): ?>
					      		<span class="help-inline"><?php echo $ca_nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="CategoriaCRUD.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
 