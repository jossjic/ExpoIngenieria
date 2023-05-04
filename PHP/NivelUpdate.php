<?php

	require 'dataBase.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: NivelView.php");
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
			header("Location: NivelView.php");
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
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Actualizar Nivel</title>

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

			<h1>Actualizar Nivel</h1>

			<form class="form-horizontal" action="NivelUpdate.php?id=<?php echo $id?>" method="post">


                <table>

                    <tr>
                        <td>
                            <label for="">ID Nivel</label>
                        </td>

                        <td>
							<input name="n_id" class="Text__Input" type="text" readonly placeholder="id" value="<?php echo !empty($n_id )?$n_id :''; ?>">
					      	<?php if (!empty($n_idError)): ?>
					      		<span class="help-inline"><?php echo $n_idError;?></span>
					      	<?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Nombre Nivel</label>
                        </td>
                        <td>
							<input name="n_nombre" class="Text__Input" type="text" placeholder="nombre" value="<?php echo !empty($n_nombre)?$n_nombre:'';?>">
					      	<?php if (!empty($n_nombreError)): ?>
					      		<span class="help-inline"><?php echo $n_nombreError;?></span>
					      	<?php endif;?>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Nivel" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="NivelView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

		</main>
		
	</body>
</html>
