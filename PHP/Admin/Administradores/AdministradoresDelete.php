<?php
	require 'dataBase.php';
	$Usuario = 0;
	if ( !empty($_GET['id'])) {
		$Usuario = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$Usuario = $_POST['Usuario'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM ADMIN WHERE adm_usu = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Usuario));
		Database::disconnect();
		header("Location: EdicionView.php");
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
            <h1>Eliminar Edición</h1>

            <form action="../PHP/EdicionDelete.php" method="post">

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
                            <a class="Btn__Blue" href="AdministradoresView.php">Regresar</a>
                        </td>
					</tr>
                </table>

            </form>

        </main>
	</body>
</html> 