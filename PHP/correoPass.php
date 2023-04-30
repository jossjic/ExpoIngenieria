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
			
			$sql = "SELECT * FROM COLABORADOR WHERE co_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
            $info = $q->fetch(PDO::FETCH_ASSOC);

          
	

	
	$para = trim($info['co_correo']);
	$asunto = 'Recuperación contraseña';
	$mensaje =  "
<html>
<head>
<style type='text/css'>
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
body {
	color: #333;
	font-family: 'Open Sans', sans-serif;
	margin: 0px;
	font-size: 16px;
}
.pie {
	font-size:12px;
	color:#999797;
}
.centro {
	font-size:16px;
}
.centro a{
	text-decoration:none;
	color: #0487b8;
}
.centro a:hover{
	text-decoration: underline;
	color: #0487b8;
}
</style>
</head>
<body>
<table width='593' height='324' border='0' align='center'>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='97' valign='top' class='centro'><h3>Recuperación contraseña
    </h3>
   Tu contraseña es:".$info['co_pass']." </td>
  </tr>
  <tr>
    <td height='17' ></td>
  </tr>
  <tr>
    <td height='27' class='pie'>Este email es una notificaci&oacute;n autom&aacute;tica</td>
  </tr>
</table>
</body>
</html>
";
	
// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= "Content-type: text/html\r\n";
$cabeceras .= 'From: ExpoIngeWeb' . "\r\n" . //poner el domn
    'Reply-To: no_contestar@ExpoIngeWeb.com' . "\r\n";

	mail($para, $asunto, $mensaje, $cabeceras);
			//header(dashboard de cada tipo de usuario)

		}

		else if ($type=='al'){
			
			$sql = "SELECT * FROM ALUMNO WHERE a_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			
		}
		else if ($type=='adm'){
			
			$sql = "SELECT * FROM ADMIN WHERE adm_correo = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($correo));
			
		}
		else{
			echo "Error en tipo de usuario";

		}
		Database::disconnect();
		header("Location: UsuariosView.php");
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

			    <form class="form-horizontal" action="correoPass.php" method="post">
		    		<input type="hidden" name="correo" value="<?php echo $correo;?>"/>
					<input type="hidden" name="type" value="<?php echo $type;?>"/>
					<p class="alert alert-error">¿Olvidaste tu contraseña?</p>
					<div class="form-actions">
						<div class="Btn_red"><button type="submit">Pulsa aquí para recuperarla</button></div>
						<div class="Btn_blue"><a href="UsuariosView.php">Regresar</a></div>
					</div>
				</form>
			</div>
	  </div> <!-- /container -->
	</body>
	
	<footer>
    <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC">
  </footer>
</html>
