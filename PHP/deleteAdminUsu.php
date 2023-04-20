<?php
	require 'database.php';
	$id = 0;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM V2_DOCENTE WHERE d_nomina = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: AdminUsuarios.php");
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../media/favicon.ico">
  <title>Admin Usuarios Detalles</title>

  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/AdminPages.css">
</head>
<body>

<header>
      <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
      <ul>
          <li>
              <a href="#">Cerrar Sesion</a>
          </li>
      </ul>
      <nav>
          <ul>
              <li><a href="#">Proyectos</a></li>
              <li><a href="#">Usuarios</a></li>
              <li><a href="#">Reconocimientos</a></li>
              <li><a href="#">Estadísticas</a></li>
          </ul>
      </nav>
  </header>

	
  <body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
			    	<h3>Eliminar un docente</h3>
			    </div>

			    <form class="form-horizontal" action="delete.php" method="post">
		    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-error">Estas seguro que quieres eliminar a este usuario?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Si</button>
						<a class="btn" href="AdminUsuarios.php">No</a>
					</div>
				</form>
			</div>
	  </div> <!-- /container -->
	</body>
	
	<footer>
    <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC">
  </footer>
</html>
