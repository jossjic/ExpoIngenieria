<?php
	require 'dataBase.php';
	$Usuario = null;
	if ( !empty($_GET['id'])) {
		$Usuario = $_REQUEST['id'];
	}
	if ( $Usuario==null) {
		header("Location: AdministradoresView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ADMIN WHERE adm_usu = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Usuario));
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

            <h1>Detalles de la Edicion</h1>

            <form>
                <table>
                    <tr>
                        <td>
                            <label for="">Usuario</label>
                        </td>
                        <td>
                            <?php echo $data['adm_usu'];?>
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
                            <label for="">Correo</label>
                        </td>
                        <td>
                            <?php echo $data['adm_correo'];?>
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
                        <td class="Btn__Blue" colspan="2"><a  href="AdministradoresView.php">Regresar</a></td>
                        <td></td>
                    </tr>
                </table>

            </form>
        </main>

    </body>
</html>