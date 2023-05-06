<?php
	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
	    header("Location: ../index.php");
	    exit();
	}

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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
  <link rel="icon" type="image/x-icon" href="../media/favicon.ico">
  <title>Admin Usuarios Detalles</title>

  	<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    <link rel="stylesheet" href="../CSS/FormsStructure.css">
    <link rel="stylesheet" href="../CSS/Extra.css">
</head>

		<header>
			<a href="../index.php"
				><img
					class="Logo__Expo"
					src="../media/logo-expo.svg"
					alt="Logotipo de Expo ingenierías"
			/></a>
			<ul style="grid-column: 2/4">
				<li><a href="../PHP/AdminInicio.php">Menu</a></li>
				<li><a href="../PHP/AvisosView.php">Avisos</a></li>
				<li><a href="../PHP/EdicionView.php">Ediciones</a></li>
				<li><a href="../PHP/NivelView.php">Nivel</a></li>
				<li><a href="../PHP/CategoriaView.php">Categorias</a></li>
				<li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
				<li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
				<li><a href="../PHP/AdministradoresView.php">Administradores</a></li>
				<li><a href="../PHP/EvaluacionesView.php">Evaluaciones</a></li>
				<li style="font-weight: 600;">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

		<main>

			<h1>Eliminar Usuario</h1>

			<form class="form-horizontal" action="UsuariosDelete.php" method="post">

				<table>
					<tr>
						<td>
							<input type="hidden" name="correo" value="<?php echo $correo;?>"/>
						</td>
						<td>
							<input type="hidden" name="type" value="<?php echo $type;?>"/>
						</td>
					</tr>

					<tr>
						<td style="text-align: center;">
							<p>¿Estas seguro de que quieres eliminar a este usuario?</p>
						</td>
					</tr>

					<tr>
                        <td class="Btn-Ancla">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Si" id="submit" name="submit">
                        </td>
                    </tr>
					
					<tr>
						<td>
                            <a class="Btn-Ancla" href="UsuariosView.php">Regresar</a>
                        </td>
					</tr>

				</table>

			</form>

		</main>
</html>
