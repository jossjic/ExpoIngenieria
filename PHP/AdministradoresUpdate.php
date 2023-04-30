<?php

    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$Usuario = null;
	if ( !empty($_GET['id'])) {
		$Usuario = $_REQUEST['id'];
	}

	if ( $Usuario==null ) {
		header("Location: AdministradoresView.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $NombreError = null;
		$CorreoError = null;
		$ContraseñaError = null;
        $ApellidoError = null;
        

		// keep track post valuesv 
        $Nombre = $_POST['Nombre'];
		$Correo = $_POST['Correo'];
		$Contraseña  = $_POST['Contraseña'];
        $Apellido = $_POST['Apellido'];
        

		/// validate input
		$valid = true;

		if (empty($Nombre)) {
			$NombreError = 'Porfavor ingresa un nombre';
			$valid = false; 
		}
		if (empty($Correo)) {
			$CorreoError = 'Porfavor ingresa un correo';
			$valid = false;
		}
		if (empty($Contraseña)) {
			$ContraseñaError = 'Porfavor ingresa una contraseña';
			$valid = false;
		}
        if (empty($Apellido)) {
			$ApellidoError = 'Porfavor ingresa una contraseña';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE ADMIN SET adm_nombre = ?, adm_correo = ?, adm_pass = ?,adm_apellido = ? WHERE adm_correo= ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Nombre,$Correo,$Contraseña,$Apellido,$Usuario));
			Database::disconnect();
			header("Location: AdministradoresView.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ADMIN WHERE adm_correo = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Usuario));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Nombre 	= $data['adm_nombre'];
        $Correo 	= $data['adm_correo'];
		$Contraseña = $data['adm_pass'];
		$Apellido = $data['adm_apellido'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title>Actualizar Administrador</title>

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

            <h1>Actualizar</h1>

            <form class="form-horizontal" action="AdministradoresUpdate.php?id=<?php echo $Usuario?>" method="post">


                <table>

                    <tr>
                        <td>
                            <label>Nombre</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($Nombre)?$Nombre:'';?>" required>
                            <?php if (($NombreError != null)) ?>
                            <span class="help-inline"><?php echo $NombreError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Apellido</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Apellido" type="text"  placeholder="Nombre" value="<?php echo !empty($Apellido)?$Apellido:'';?>" required>
                            <?php if (($ApellidoError != null)) ?>
                            <span class="help-inline"><?php echo $ApellidoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Correo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Correo" type="text" pattern="^[^@]+@tec\.mx$" placeholder="Correo" value="<?php echo !empty($Correo)?$Correo:'';?>" required>
                            <?php if (($CorreoError != null)) ?>
                            <span class="help-inline"><?php echo $CorreoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contraseña</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Contraseña" type="text"  placeholder="Contraseña" value="<?php echo !empty($Contraseña)?$Contraseña:'';?>" required>
                            <?php if (($ContraseñaError != null)) ?>
                            <span class="help-inline"><?php echo $ContraseñaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Edicion" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="AdministradoresView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>

    </body>

</html>