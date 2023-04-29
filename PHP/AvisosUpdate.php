<?php

    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: AvisosView.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $TituloError = null;
		$ContenidoError = null;
		$GrupoError = null;
    

		// keep track post valuesv 
        $Titulo = $_POST['Titulo'];
		$Contenido = $_POST['Contenido'];
		$Grupo  = $_POST['Grupo'];
        

		/// validate input
		$valid = true;

		if (empty($Titulo)) {
			$TituloError = 'Porfavor ingresa el titulo';
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

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE ANUNCIO SET an_titulo = ?, an_contenido = ?, an_grupo = ? = WHERE an_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Titulo,$Contenido,$Grupo,$id));
			Database::disconnect();
			header("Location: AnuncioView.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ANUNCIO WHERE an_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Titulo 	= $data['an_titulo'];
        $Contenido 	= $data['an_contenido'];
		$Grupo = $data['an_grupo'];
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

        <title>Actualizar Anuncio</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/FormsStructure.css">

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
				<li style="font-weight: 600; font-size: 1.2em">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

        <main>

            <h1>Actualizar Anuncio</h1>

            <form class="form-horizontal" action="AvisosUpdate.php" method="post">


                <table>

                    <tr>
                        <td>
                            <label for="">ID</label>
                        </td>

                        <td>
                            <input name="id" type="text" readonly placeholder="" value="<?php echo !empty($id )?$id :''; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Titulo</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Titulo" type="text"  placeholder="" value="<?php echo !empty($Titulo)?$Titulo:'';?>">
                            <?php if (($TituloError != null)) ?>
                            <span class="help-inline"><?php echo $TituloError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Contenido</label>
                        </td>
                        <td>
                            <input class="Text__Input" name="Contenido" type="text"  placeholder="" value="<?php echo !empty($Contenido)?$Contenido:'';?>">
                            <?php if (($ContenidoError != null)) ?>
                            <span class="help-inline"><?php echo $ContenidoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Grupo</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Grupo" type="text"  placeholder="" value="<?php echo !empty($Grupo)?$Grupo:'';?>">
                            <?php if (($GrupoError != null)) ?>
                            <span class="help-inline"><?php echo $GrupoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Anuncio" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="AvisosView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>

    </body>

</html>