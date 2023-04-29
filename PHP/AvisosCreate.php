<?php
        require_once 'dataBase.php';

        session_name("EngineerXpoWeb");
        session_start();

        if (!isset($_SESSION['logged_in'])) {
            header("Location: ../index.php");
            exit();
        }

		$TituloError = null;
		$ContenidoError = null;
		$GrupoError = null;
        $FechaError = null;
        $Adm_UsuError = null;

	if ( !empty($_POST)) {

        $Titulo = $_POST['Titulo'];
		$Contenido = $_POST['Contenido'];
		$Grupo  = $_POST['Grupo'];
        $Fecha = $_POST['Fecha'];
        $Adm_Usu = $_POST['Usuario'];

		// validate input
		$valid = true;

		if (empty($Titulo)) {
			$TItuloError = 'Porfavor ingresa el titulo';
			$valid = false; 
		}
		if (empty($Contenido)) {
			$ContenidoError = 'Porfavor ingresa el contendio del anuncio';
			$valid = false;
		}
		if (empty($Grupo)) {
			$GrupoError = 'Porfavor ingresa el grupo';
			$valid = false;
		}
        if (empty($Fecha)) {
			$FechaError = 'Porfavor ingresa la fecha en que se publicara el anuncio';
			$valid = false;
		}
        if (empty($Adm_Usu)) {
			$Adm_UsuError = 'Porfavor ingresa el usuario que eres';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO ANUNCIO(an_titulo, an_contenido, an_grupo, an_fecha, adm_usu) VALUES(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Usuario,$Correo,$Nombre,$Contraseña));
			Database::disconnect();
			header("Location: AvisosView.php");
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

        <title>Crear Anuncio</title>

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

            <h1>Crear Anuncio</h1>

            <form class="form-horizontal" action="AvisosCreate.php" method="post">
                <table>

                    <tr>
                        <td>
                            <label>Titulo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Titulo" type="text"  placeholder="Titulo" value="">
                            <?php if (($TituloError != null)) ?>
                            <span class="help-inline"><?php echo $TituloError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contenido</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Contenido" type="text"  placeholder="!HOLA¡" value="">
                            <?php if (($ContenidoError != null)) ?>
                            <span class="help-inline"><?php echo $ContenidoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Grupo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Grupo" type="text"  placeholder="Grupo" value="">
                            <?php if (($GrupoError != null)) ?>
                            <span class="help-inline"><?php echo $GrupoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Fecha</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Fecha" type="date"  value="">
                            <?php if (($FechaError != null)) ?>
                            <span class="help-inline"><?php echo $FechaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion" colspan="2">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Publicar Anuncio" id="submit" name="submit">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>

        </main>

    </body>

</html>