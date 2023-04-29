<?php

	require 'dataBase.php';

		$NombreError = null;
		$CorreoError = null;
		$ContraseñaError = null;
        $UsuarioError = null;

	if ( !empty($_POST)) {

        $Nombre = $_POST['Nombre'];
		$Correo = $_POST['Correo'];
		$Contraseña  = $_POST['Contraseña'];
        $Usuario = $_POST['Usuario'];

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
        if (empty($Usuario)) {
			$UsuarioError = 'Porfavor ingresa una contraseña';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO ADMIN(adm_usu,adm_correo,adm_nombre,adm_pass) VALUES(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Usuario,$Correo,$Nombre,$Contraseña));
			Database::disconnect();
			header("Location: AdministradoresView.php");
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

        <title>Crear Administrador</title>

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

            <h1>Crear Administradores</h1>

            <form class="form-horizontal" action="AdministradoresCreate.php" method="post">
                <table>

                    <tr>
                        <td>
                            <label>Nombre Administrador</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Nombre" type="text"  placeholder="Nombre Administrador" value="">
                            <?php if (($NombreError != null)) ?>
                            <span class="help-inline"><?php echo $NombreError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Correo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Correo" type="email"  placeholder="tucorreo@dominio.com" value="">
                            <?php if (($CorreoError != null)) ?>
                            <span class="help-inline"><?php echo $CorreoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Nombre de Usuario</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Usuario" type="text"  placeholder="Nombre de Usuario" value="">
                            <?php if (($UsuarioError != null)) ?>
                            <span class="help-inline"><?php echo $UsuarioError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contraseña</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Contraseña" type="password"  placeholder="Contraseña" value="">
                            <?php if (($ContraseñaError != null)) ?>
                            <span class="help-inline"><?php echo $ContraseñaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion" colspan="2">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Agregar edicion" id="submit" name="submit">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>

        </main>

    </body>

</html>