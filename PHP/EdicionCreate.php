<?php

    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$ed_idError = null;
	$ed_nombreError = null;
	$ed_fecha_inicioError = null;
	$ed_fecha_finError  = null;

	if ( !empty($_POST)) {

        $ed_id = $_POST['ed_id'];
		$ed_nombre = $_POST['ed_nombre'];
		$ed_fecha_inicio  = $_POST['ed_fecha_inicio'];
        $ed_fecha_fin = $_POST['ed_fecha_fin'];

		// validate input
		$valid = true;

		if (empty($ed_nombre)) {
			$ed_nombreError = 'Porfavor Ingresa un nombre de edicion';
			$valid = false; 
		}
		if (empty($ed_fecha_inicio)) {
			$ed_fecha_inicioError = 'Porfavor Ingresa una fecha de inicio';
			$valid = false;
		}
		if (empty($ed_fecha_fin)) {
			$ed_fecha_finError = 'Porfavor Ingresa una fecha de fin';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `EDICION` (`ed_nombre`, `ed_fecha_inicio`, `ed_fecha_fin`) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($ed_nombre,$ed_fecha_inicio,$ed_fecha_fin));
			Database::disconnect();
			header("Location: EdicionView.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title>Crear Edicion</title>

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
				<li><a href="../PHP/CategoriasView.php">Categorias</a></li>
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

            <h1>Crear Edicion</h1>

            <form class="form-horizontal" action="EdicionCreate.php" method="post">


                <table>
                    <tr>
                        <td>
                            <label>Nombre</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="ed_nombre" type="text"  placeholder="Nombre Edicion" value="" required>
                            <?php if (($ed_nombreError != null)) ?>
                            <span class="help-inline"><?php echo $ed_nombreError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Fecha de inicio</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="ed_fecha_inicio" type="date"  placeholder="Tu Nombre" value="" required>
                            <?php if (($ed_fecha_inicioError != null)) ?>
                            <span class="help-inline"><?php echo $ed_fecha_inicioError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Fecha de fin</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="ed_fecha_fin" type="date"  placeholder="Tu Apellido Paterno" value="" required>
                            <?php if (($ed_fecha_finError != null)) ?>
                            <span class="help-inline"><?php echo $ed_fecha_finError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Agregar edicion" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="EdicionView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>

    </body>

</html>