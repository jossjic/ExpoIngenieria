<?php
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM V2_EDICION where ed_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>READ EDICION</title>

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
    <br>
    <br>
	<body>
    	<div class="container">

    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Detalles de Edicion</h3>
		    	</div>
                <br>
	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">ID</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['ed_id'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['ed_nombre'];?>
						    </label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Fecha de inicio</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['ed_fecha_inicio'];?>
						    </label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Fecha de fin</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['ed_fecha_fin'];?>
						    </label>
					    </div>
					</div>
                    <br>
				    <div class="form-actions">
						<a class="btn" href="EdicionCRUD.php">Regresar</a>
					</div>

				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>