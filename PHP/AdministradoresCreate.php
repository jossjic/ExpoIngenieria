<?php
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
        header("Location: ../index.php");
        exit();
    }

	$NombreError = null;
	$CorreoError = null;
	$ContraseñaError = null;
    $ApellidoError = null;
    $isMasterError = null;

	if ( !empty($_POST)) {

        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
		$Correo = $_POST['Correo'];
		$Contraseña  = $_POST['Contraseña'];
        $isMaster = $_POST['Master'];

		// validate input
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
			$ApellidoError = 'Porfavor ingresa un apellido';
			$valid = false;
		}
        if (empty($isMaster)) {
			$isMasterError = 'Porfavor ingresa una si es un usuario con todos los permisos';
			$valid = false;
		}

		// insert data
		if ($valid) {
            if (trim($isMaster) == "Si") {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO ADMIN(adm_nombre,adm_apellido,adm_correo,adm_pass,adm_master) VALUES(?, ?, ?, ?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($Nombre,$Apellido,$Correo,$Contraseña,1));
                Database::disconnect();
                header("Location: AdministradoresView.php");
            } 
            else if (trim($isMaster) == "No") {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO ADMIN(adm_nombre,adm_apellido,adm_correo,adm_pass,adm_master) VALUES(?, ?, ?, ?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($Nombre,$Apellido,$Correo,$Contraseña,0));
                Database::disconnect();
                header("Location: AdministradoresView.php");
            }
		}
	}
?>


<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
		

        <title>Crear Administrador</title>

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

            <h1>Crear Administradores</h1>

            <form class="form-horizontal" action="AdministradoresCreate.php" method="post">
                <table>

                    <tr>
                        <td>
                            <label>Nombre</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Nombre" type="text"  placeholder="Nombre Administrador" value="" required>
                            <?php if (($NombreError != null)) ?>
                            <span class="help-inline"><?php echo $NombreError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Apellido</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Apellido" type="text"  placeholder="Nombre de Usuario" value="" required>
                            <?php if (($Apellido != null)) ?>
                            <span class="help-inline"><?php echo $Apellido;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Correo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Correo" type="email"  placeholder="tucorreo@dominio.com" value="" pattern="^[^@]+@tec\.mx$" required>
                            <?php if (($CorreoError != null)) ?>
                            <span class="help-inline"><?php echo $CorreoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contraseña</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Contraseña" type="password"  placeholder="Contraseña" value="" required>
                            <?php if (($ContraseñaError != null)) ?>
                            <span class="help-inline"><?php echo $ContraseñaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Es Master</label>
                        </td>

                        <td>
                            <select class="Text__Input" name="Master" required>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                            <?php if (($isMaster != null)) ?>
                            <span class="help-inline"><?php echo $isMaster;?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Agregar Admin" id="submit" name="submit">
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