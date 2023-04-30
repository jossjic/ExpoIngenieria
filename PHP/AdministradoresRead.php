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
	if ( $Usuario==null) {
		header("Location: AdministradoresView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ADMIN WHERE adm_correo = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array(trim($Usuario)));
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

        <title>Ver Administrador</title>

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

            <h1>Detalles de la Edicion</h1>

            <form>
                <table>
                    <tr>
                        <td>
                            <label for="">Correo</label>
                        </td>
                        <td>
                            <?php echo $data['adm_correo'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Nombre</label>
                        </td>
                        <td>
                            <?php echo $data['adm_nombre'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Apellido</label>
                        </td>
                        <td>
                            <?php echo $data['adm_apellido'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Contraseña</label>
                        </td>
                        <td>
                            <?php echo $data['adm_pass'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Master</label>
                        </td>
                        <td>
                            <?php echo $data['adm_master'];?>
                        </td>
                    </tr>

                    <tr>
                        <td><a class="Btn-Ancla" href="AdministradoresView.php">Regresar</a></td>
                        <td></td>
                    </tr>
                </table>

            </form>
        </main>

    </body>
</html>