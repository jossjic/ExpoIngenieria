<?php
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$Usuario = 0;
	if ( !empty($_GET['id'])) {
		$Usuario = $_REQUEST['id'];
	}

    //Revisar si es Mastes
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM ADMIN WHERE adm_correo = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($_SESSION['id']));
    $q = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();

    //Revisar cantidad de Admin's > 1
    $pdo = Database::connect();
	$sql = "SELECT * FROM ADMIN";
	$count = $pdo->query($sql)->rowCount();
	Database::disconnect();

    if ($q['adm_master'] == 1 && $count > 1){
        if ( !empty($_POST)) {
            // keep track post values
            $Usuario = trim($_POST['Usuario']);

            if ($Usuario === $_SESSION['id']) {
                header("Location: AdministradoresView.php");
                exit();
            } else {
                // delete data
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM ADMIN WHERE adm_correo = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($Usuario));
                Database::disconnect();
                header("Location: AdministradoresView.php");
                exit();
            }
        }
    } 
    else if($q['adm_master'] == 0 || $count == 1) {
        header("Location: AdministradoresView.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title>Eliminar Administrador</title>

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
				<li style="font-weight: 600">
					<a href="../PHP/logout.php">Cerrar Sesión</a>
				</li>
			</ul>
		</header>

        <main>
            <h1>Eliminar Administrador</h1>

            <form action="../PHP/AdministradoresDelete.php" method="post">

                <table>
                    <tr>
                        <td>
                            <input type="hidden" name="Usuario" value="<?php echo $Usuario;?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">
                            <p>Estas seguro de eliminar este Administrador</p>
                            <p>Perdera acceso por completo al sistema</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="Td__Iniciar__Sesion">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Si" id="submit" name="submit">
                        </td>
                    </tr>
					
					<tr>
						<td class="Td__Iniciar__Sesion">
                            <a class="Btn-Ancla" href="AdministradoresView.php">Regresar</a>
                        </td>
					</tr>
                </table>

            </form>

        </main>
	</body>
</html> 