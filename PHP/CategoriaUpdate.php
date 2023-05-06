<?php

	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
	    header("Location: ../index.php");
	    exit();
	}

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: CategoriaView.php");
		exit();
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
			$sql = "UPDATE CATEGORIA  SET ca_id = ?, ca_nombre = ? WHERE ca_id = ?";
			$q = $pdo->prepare($sql);
			//$acq = ($ac=="S")?1:0;
			$q->execute(array($ca_id,$ca_nombre,$ca_id));
			Database::disconnect();
			header("Location: CategoriaView.php");
			exit();
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
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
		<title>Categoria Update</title>

		<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
		<link rel="stylesheet" href="../CSS/FormsStructure.css">
		<link rel="stylesheet" href="../CSS/Extra.css">

	</head>

	<body>

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

            <h1>Actualizar Categoria</h1>

            <form class="form-horizontal" action="CategoriaUpdate.php?id=<?php echo $id?>" method="post">


                <table>

                    <tr>
                        <td>
                            <label for="">ID</label>
                        </td>

                        <td>
							<input name="ca_id" class="Text__Input" type="text" readonly placeholder="id" value="<?php echo !empty($ca_id )?$ca_id :''; ?>" required>
					      	<?php if (!empty($ca_idError)): ?>
					      		<span class="help-inline"><?php echo $ca_idError;?></span>
					      	<?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Nombre</label>
                        </td>
                        <td>
							<input name="ca_nombre" class="Text__Input" type="text" placeholder="nombre" value="<?php echo !empty($ca_nombre)?$ca_nombre:'';?>" required>
					      	<?php if (!empty($ca_nombreError)): ?>
					      		<span class="help-inline"><?php echo $ca_nombreError;?></span>
					      	<?php endif;?>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Categoria" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="CategoriaView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>
		
	</body>
</html>

 