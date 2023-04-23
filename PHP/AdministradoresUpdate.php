<?php

	require 'dataBase.php';

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
        

		// keep track post valuesv 
        $Nombre = $_POST['Nombre'];
		$Correo = $_POST['Correo'];
		$Contraseña  = $_POST['Contraseña'];
        

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
        if (empty($Usuario)) {
			$UsuarioError = 'Porfavor ingresa una contraseña';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE ADMIN SET adm_nombre = ?, adm_correo = ?, adm_pass =? WHERE adm_usu = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Nombre,$Correo,$Contraseña,$Usuario));
			Database::disconnect();
			header("Location: AdministradoresView.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ADMIN WHERE adm_usu = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Usuario));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Usuario 	= $data['adm_usu'];
        $Nombre 	= $data['adm_nombre'];
		$Contraseña = $data['adm_pass'];
		$Correo = $data['adm_correo'];
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

	</head>

    <body>
        
        <header>
			<img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">

            <ul>

                <li>
                    <a href="#">Menu</a>
                </li>
				<li>
                    <a href="#">Usuarios</a>
                </li>
				<li>
                    <a href="#">Reconocimientos</a>
                </li>
				<li>
                    <a href="#">Eastadísticas</a>
                </li>
				
			</ul>

            <nav>
				<ul>
					<li><a href="#">Cerrar Sesion</a></li>
				</ul>
			</nav>

		</header>

        <main>

            <h1>Actualizar</h1>

            <form class="form-horizontal" action="AdministradorUpdate.php?id=<?php echo $Usuario?>" method="post">


                <table>

                    <tr>
                        <td>
                            <label for="">Usuario</label>
                        </td>

                        <td>
                            <input name="Usuario" type="text" readonly placeholder="Usuario" value="<?php echo !empty($Usuario )?$Usuario :''; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Nombre</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($Nombre)?$Nombre:'';?>">
                            <?php if (($NombreError != null)) ?>
                            <span class="help-inline"><?php echo $NombreError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Correo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Correo" type="text"  placeholder="Correo" value="<?php echo !empty($Correo)?$Correo:'';?>">
                            <?php if (($CorreoError != null)) ?>
                            <span class="help-inline"><?php echo $CorreoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contraseña</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Contraseña" type="text"  placeholder="Contraseña" value="<?php echo !empty($Contraseña)?$Contraseña:'';?>">
                            <?php if (($ContraseñaError != null)) ?>
                            <span class="help-inline"><?php echo $ContraseñaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Edicion" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn__Blue" href="EdicionView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>

    </body>

</html>