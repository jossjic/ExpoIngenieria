<?php
	require 'dataBase.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: EdicionView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM V2_EDICION where ed_id = ?";
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

        <title>Ver Edicion</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/AdminPages.css">
        <link rel="stylesheet" href="../CSS/FormsStructure.css">
    
	</head>

    <body>
        
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
            <ul>
                <li>
                    <a href="#">Layout Proyectos</a>
                </li>
            </ul>
            <nav>
                <ul>
                    <li><a href="#">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>

            <h1>Detalles de la Edicion</h1>

            <form>
                <table>
                    <tr>
                        <td>
                            <label for="">ID</label>
                        </td>
                        <td>
                            <?php echo $data['ed_id'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Nombre</label>
                        </td>
                        <td>
                            <?php echo $data['ed_nombre'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Fecha Inicio</label>
                        </td>
                        <td>
                            <?php echo $data['ed_fecha_inicio'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Fecha Fin</label>
                        </td>
                        <td>
                            <?php echo $data['ed_fecha_fin'];?>
                        </td>
                    </tr>

                    <tr>
                        <td class="Btn__Blue" colspan="2"><a  href="EdicionView.php">Regresar</a></td>
                        <td></td>
                    </tr>
                </table>

            </form>
        </main>

    </body>
</html>