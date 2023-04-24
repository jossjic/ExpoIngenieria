<?php

	require 'dataBase.php';

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
        $FechaError = null;
        $Adm_UsuError = null;
        

		// keep track post valuesv 
        $Titulo = $_POST['Titulo'];
		$Contenido = $_POST['Contenido'];
		$Grupo  = $_POST['Grupo'];
        $Fecha = $_POST['Fecha'];
        $Adm_Usu = $_POST['Usuario'];
        

		/// validate input
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

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE ANUNCIO SET an_titulo = ?, an_contenido = ?, an_grupo = ?, an_fecha = ?, adm_usu = ? = WHERE an_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Titulo,$Contenido,$Grupo,$Fecha,$Adm_Usu,$id));
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
		$Fecha = $data['an_fecha'];
        $Adm_Usu = $data['adm_usu'];
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

            <h1>Actualizar Anuncio</h1>

            <form class="form-horizontal" action="AvisosUpdate.php?id=<?php echo $id?>" method="post">


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
                        <td>
                            <label>Fecha</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Fecha" type="date" readonly placeholder="" value="<?php echo !empty($Fecha)?$Fecha:'';?>">
                            <?php if (($FechaError != null)) ?>
                            <span class="help-inline"><?php echo $FechaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Anuncio" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn__Blue" href="AvisosView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

        </main>

    </body>

</html>