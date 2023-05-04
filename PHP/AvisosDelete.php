<?php
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }
    
	$id = 0;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM ANUNCIO WHERE an_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: AvisosView.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
		

        <title>Eliminar Anuncio</title>

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
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

        <main>
            <h1>Eliminar Anuncio</h1>

            <form action="../PHP/AvisosDelete.php" method="post">

                <table>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">
                            <p>Estas seguro de eliminar este anuncio</p>
                            <p>No lo podras recuperar</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="Btn-Ancla">
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Si" id="submit" name="submit">
                        </td>
                    </tr>

					<tr>
						<td>
                            <a class="Btn-Ancla" href="AvisosView.php">Regresar</a>
						</td>
					</tr>
                </table>

            </form>

        </main>
	</body>
</html> 