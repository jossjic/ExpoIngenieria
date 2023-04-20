<?php
	require 'dataBase.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null) {
		header("Location: ProyectosView.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM PROYECTOV1 WHERE p_id = ?";
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
    <title>Proyectos View</title>

    <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    <link rel="stylesheet" href="../CSS/AdminPages.css">

</head>
<body>

    <header>
        <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
        <ul>
            <li>
                <a href="#">Cerrar Sesion</a>
            </li>
        </ul>
        <nav>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Reconocimientos</a></li>
                <li><a href="#">Eastadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <div class="Admin__Start">
            <div class="Admin__Start__Left">
                <h1>Administrador de Proyectos</h1>
                <table>
                    <tr>
                        <td>Total de Proyectos:</td>
                        <td id="TotalProyectos">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Calificados:</td>
                        <td id="TotalCalificados">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Pendientes:</td>
                        <td id="TotalPendientes">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="Estadisticas__Btn">
                <a class="Admin__Start__Right__Btn" href="../PHP/EstadisticasUsuarios.php">Estadisticas Proyectos</a>
            </div>
        </div>

        <form method="post" class="Winners__Explorer">
            <table>
                <tr>
                    <td>
                        Buscar
                    </td>
                    <td>
                        <select name="ProyectoID" id="ProyectoID">
                            <option value="ID">ID</option>
                            <option value="Nombre">Nombre</option>
                        </select>
                    </td>
                    <td>
                        
                        <input type="search" name="BuscarNombre" class="Text__Search" id="" placeholder="Ingresa el valor">
                        <input type="submit" name="BtnBuscar" class="Search__Btn" id="" value="Buscar">
                        
                    </td>
                    
                </tr>
              </table>
        </form>

        <div class="Info">
            
            <div class="Info__Read">

                <div class="InfoRead__Atributes">
                    <?php
                        echo "<p>" . $data['p_id'] ."</p>";
                    ?>
                </div>

                <div class="InfoRead__Atributes">
                    <?php
                        echo "<p>" . $data['p_nombre'] ."</p>";
                    ?>
                </div>

                <div class="InfoRead__Atributes">
                    <?php
                        echo "<p>" . $data['p_descripcion'] ."</p>";
                    ?>
                </div>

                <div class="InfoRead__Atributes">
                    <?php
                        echo "
                                <p>" . $data['p_categoria'] ."</p>
                                <p>" . $data['p_estado'] ."</p>
                             ";
                    ?>
                </div>
            </div>
        </div>
    </main> 

</body>
</html>