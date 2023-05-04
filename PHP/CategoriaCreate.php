<?php

	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in'])) {
		header("Location: ../index.php");
		exit();
	}

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
			header("Location: CategoriaView.php");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
		<title>Categoria Create</title>

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

            <h1>Crear Categoria</h1>

            <form class="form-horizontal" action="CategoriaCreate.php" method="post">
                <table>

                    <tr>
                        <td>
                            <label>Nombre Categoria</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="ca_nombre" type="text"  placeholder="Nombre" value="" required>
                            <?php if (($ca_nombreError != null)) ?>
                            <span class="help-inline"><?php echo $ca_nombreError;?></span>
                        </td>
                    </tr>

					<tr>
                        <td>
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Agregar Categoria" id="submit" name="submit">
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