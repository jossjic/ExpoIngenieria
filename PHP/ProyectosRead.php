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
		header("Location: ProyectosView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * 
                FROM PROYECTO 
                NATURAL JOIN EDICION
                NATURAL JOIN NIVEL
                NATURAL JOIN CATEGORIA
                WHERE p_id = ?";
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

    <title>Ver Proyectos</title>

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

        <h1>Detalles del proyecto</h1>

        <form>

            <table>
                <tr>
                    <td>
                        <label for="">Nombre</label>
                    </td>
                    <td>
                        <?php echo $data['p_nombre'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Descripcion</label>
                    </td>
                    <td>
                        <?php echo $data['p_descripcion'];?>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsa facere? Ut minus facilis nesciunt debitis ipsa eum a necessitatibus?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus quo impedit voluptas. Accusantium eligendi expedita unde consectetur nemo distinctio porro.
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Video</label>
                    </td>
                    <td>
                        <?php echo $data['p_video'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Poster</label>
                    </td>
                    <td>
                        <?php echo $data['p_poster'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Nivel</label>
                    </td>
                    <td>
                        <?php echo $data['n_nombre'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Categoria</label>
                    </td>
                    <td>
                        <?php echo $data['ca_nombre'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Estado</label>
                    </td>
                    <td>
                        <?php echo $data['p_estado'];?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Edicion</label>
                    </td>
                    <td>
                        <?php echo $data['ed_nombre'];?>
                    </td>
                </tr>

                <tr>
                    <td><a class="Btn-Ancla" href="AvisosView.php">Regresar</a></td>
                    <td></td>
                </tr>

            </table>

        </form>

    </main> 

</body>
</html>