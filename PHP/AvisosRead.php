<?php
	require 'dataBase.php';
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
                            <?php echo $data['ad_fecha'];?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Administrador que la publico</label>
                        </td>
                        <td>
                            <?php echo $data['adm_usu'];?>
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