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
	if ( $id==null) {
		header("Location: AvisosView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ANUNCIO WHERE an_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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

        <title>Ver Anuncio</title>

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
				<li style="font-weight: 600; font-size: 1.2em">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

        <main>

            <h1>Detalles del anuncio</h1>

            <form>
                <table>
                    <tr>
                        <td>
                            <label for="">ID</label>
                        </td>
                        <td>
                            <?php echo $data['an_id'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Titulo</label>
                        </td>
                        <td>
                            <?php echo $data['an_titulo'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Contenido</label>
                        </td>
                        <td>
                            <?php echo $data['an_contenido'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Fecha Publicación</label>
                        </td>
                        <td>
                            <?php echo $data['an_fecha'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Administrador que la publico</label>
                        </td>
                        <td>
                            <?php echo $data['adm_correo'];?>
                        </td>
                    </tr>

                    <tr>
                        <td class="Btn__Blue" colspan="2"><a  href="AvisosView.php">Regresar</a></td>
                        <td></td>
                    </tr>
                </table>

            </form>
        </main>

    </body>
</html>