<?php

	require 'dataBase.php';

		$ca_idError = null;
		$ca_nombreError = null;

	if ( !empty($_POST)) {

        $ca_id = $_POST['ca_id'];
		$ca_nombre = $_POST['ca_nombre'];

		// validate input
		$valid = true;

		if (empty($ca_nombre)) {
			$ca_nombreError = 'Porfavor Ingresa un nombre de categoria';
			$valid = false; 
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `CATEGORIA` (`ca_id`,`ca_nombre`) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($ca_id,$ca_nombre));
			Database::disconnect();
			header("Location: CategoriaCRUD.php");
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
		   			<h3>Registro de Categorias</h3>
		   		</div>

				<form class="form-horizontal" action="createCategoria.php" method="post">


				<div class="control-group <?php echo !empty($ca_nombreError)?'error':'';?>">
						<label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="ca_nombre" type="text"  placeholder="Nombre Categoria" value="">
					      	<?php if (($ca_nombreError != null)) ?>
					      		<span class="help-inline"><?php echo $ca_nombreError;?></span>
					    </div>
				</div>


					<div>
						<input class="btn btn-primary btn-block" type="submit" value="Agregar categoria" id="submit" name="submit">
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>