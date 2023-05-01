<?php

	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in'])) {
		header("Location: ../index.php");
		exit();
	}

		$n_idError = null;
		$n_nombreError = null;

	if ( !empty($_POST)) {

        $n_id = $_POST['n_id'];
		$n_nombre = $_POST['n_nombre'];

		// validate input
		$valid = true;

		if (empty($n_nombre)) {
			$n_nombreError = 'Porfavor Ingresa un nombre de nivel';
			$valid = false; 
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `NIVEL` (`n_id`,`n_nombre`) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($n_id,$n_nombre));
			Database::disconnect();
			header("Location: NivelView.php");
			exit();
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nivel Create</title>

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

			<h1>Crear Nivel</h1>

			<form class="form-horizontal" action="NivelCreate.php" method="post">
                <table>

                    <tr>
                        <td>
                            <label>Nombre Nivel</label>
                        </td>
                        <td>
							<input name="n_nombre" type="text"  placeholder="Nombre Nivel" value="">
					      	<?php if (($n_nombreError != null)) ?>
					      		<span class="help-inline"><?php echo $n_nombreError;?></span>
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