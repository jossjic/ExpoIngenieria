<?php
	require 'dataBase.php';
	$correo = 0;
	$type = 0;
	if ( !empty($_GET['correo'])&& !empty($_GET['type'])) {
		$correo = $_REQUEST['correo'];
		$type = $_REQUEST['type'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$correo = $_POST['correo'];
		$type = $_POST['type'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($type=='co'){
			$sql = "DELETE FROM COLABORADOR WHERE co_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			$sql = "SELECT * FROM COLABORADOR WHERE co_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			if($q->rowCount()<=0){
				$verif=true;
			}
			else{
				$verif=false;
			}

		}
		else if ($type=='al'){
			$sql = "DELETE FROM ALUMNO WHERE a_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			$sql = "SELECT * FROM ALUMNO WHERE a_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			if($q->rowCount()<=0){
				$verif=true;
			}
			else{
				$verif=false;
			}
		}
		else if ($type=='adm'){
			$sql = "DELETE FROM ADMIN WHERE adm_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			$sql = "SELECT * FROM ADMIN WHERE adm_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			if($q->rowCount()<=0){
				$verif=true;
			}
			else{
				$verif=false;
			}
		}
		else{
			echo "Error en tipo de usuario";
			$verif=false;
		}
		Database::disconnect();
		header("Location: UsuariosView.php?verif=$verif");
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
		  <li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
              <li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
              <li><a href="../PHP/ReconocimientosView.php">Reconocimientos</a></li>
              <li><a href="../PHP/EstadisticasView.php">Estadísticas</a></li>
          </ul>
      </nav>
  </header>

	
  <body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
			    	<h3>Eliminar Usuario</h3>
			    </div>

			    <form class="form-horizontal" action="UsuariosDelete.php" method="post">
		    		<input type="hidden" name="correo" value="<?php echo $correo;?>"/>
					<input type="hidden" name="type" value="<?php echo $type;?>"/>
					<p class="alert alert-error">Estas seguro que quieres eliminar a este usuario?</p>
					<div class="form-actions">
						<div class="Btn_red"><button type="submit">Si</button></div>
						<div class="Btn_blue"><a href="UsuariosView.php">No</a></div>
					</div>
				</form>
			</div>
	  </div> <!-- /container -->
	</body>
	
	<footer>
    <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC">
  </footer>
</html>
