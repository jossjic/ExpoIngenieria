<?php
	require 'dataBase.php';

    $id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

    if ( $id==null ) {
		header("Location: ../PHP/ProyectosView.php");
	}

    if ( !empty($_POST)) {
		// keep track validation errors
		$NombreError = null;
        $CategoriaError = null;
        $AvanceProyectoError = null;
        $EstadoError = null;

		// keep track post values
		$Nombre = null;
        $Categoria = null;
        $AvanceProyecto = null;
        $Estado = null;

		/// validate input
		$valid = true;

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTOV1 set p_nombre = ?, ca_id = ?, p_avance_proyecto = ? WHERE p_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Nombre,$Categoria,$AvanceProyecto,$id));
			Database::disconnect();
			header("Location: ../PHP/ProyectosView.php");
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM PROYECTOV1 WHERE p_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Nombre = $data['p_nombre'];
        $Categoria = $data['ca_id'];
        $AvanceProyecto = $data['p_avance_proyecto'];
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

        <div class="Admin__Start" type="hidden">
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

        <form method="post" class="Winners__Explorer" type="hidden">
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

        <form class="Info">
            <div class="">
                <h1>Actualizar Proyecto</h1>
            </div>
            
            <form class="Info__Update">
                
                <div class="InfoRead__Atributes">
                    <label for="Nombre">Nombre</label>
                    <input type="text" name="Nombre" id="" placeholder="Nombre">
                </div>

                <div class="InfoRead__Atributes">
                    <label for="Categoria"></label>
                    <select name="Categoria" id="">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM CATEGORIAV1";
                                foreach ($pdo->query($sql) as $row) {
                                    echo "
                                            <option value='" . $row["ca_id"] . "'>'". $row["nombre"] ."'</option>
                                        ";

                                }
                                Database::disconnect();
                            ?>
                    </select>
                </div>

                <div class="InfoRead__Atributes">
                    <label for="AvanceProyecto">Avance Proyecto</label>
                    <select name="AvanceProyecto" id="">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM CATEGORIAV1";
                                foreach ($pdo->query($sql) as $row) {
                                    echo "
                                            <option value='" . $row["ca_id"] . "'>'". $row["nombre"] ."'</option>
                                        ";

                                }
                                Database::disconnect();
                            ?>
                    </select>
                </div>

                <div class="InfoRead__Atributes">
                    <label for="Estado">Estado</label>
                    <select name="Estado" id="">
                            <option value="Registrado">Registrado</option>
                            <option value="Rechazado">Rechazado</option>
                            <option value="Aceptado">Aceptado</option>
                    </select>
                </div>

                <div class="InfoRead__Atributes">
                    <input class="Btn__Red__Delete" type="submit" value="Guardar">

                    <div class='Btn__Green__Delete'>
                        <a href='../PHP/ProyectosRead.php'>Cancelar</a>
                    </div>
                </div>

            </form>
        </form>
    </main> 

</body>
</html>