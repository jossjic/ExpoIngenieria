<?php 

	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    <title>Proyectos View</title>

    <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    <link rel="stylesheet" href="../CSS/AdminPages.css">

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
				<li><a href="../PHP/CategoriaView.php">Categorias</a></li>
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

        <div class="Admin__Start">
            <div class="Admin__Start__Left">
                <h1>Administrador de Proyectos</h1>
                <table>
                    <tr>
                        <td>Total Registrados: </td>
                        <td>
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTO WHERE p_estado = 'Registrado'";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Total Aceptados: </td>
                        <td>
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTO WHERE p_estado = 'Aceptado'";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Total Rechazados: </td>
                        <td>
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTO WHERE p_estado = 'Rechazado'";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            
        </div>

        <form action="../PHP/ProyectosBusqueda.php" method="post" class="Winners__Explorer">
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

        <form method="post" class="Info">
            <div class="Info__Header">
                <p>&nbsp;</p>
                <p>ID</p>
                <p>Nombre</p>
                <p>Categoria</p>
                <p>Estado</p>
                <p>Nivel</p>
                <div>
                    <p>Acciones</p>
                </div>
            </div>
            <div class="Info__Table">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * 
                                        FROM PROYECTO
                                        NATURAL JOIN NIVEL
                                        NATURAL JOIN CATEGORIA 
                                        ORDER BY ed_id DESC";
                                foreach ($pdo->query($sql) as $row) {
                                    echo "
                                            <p>&nbsp;</p>
                                            <p>" . $row['p_id'] ."</p>
                                            <p>" . $row['p_nombre'] ."</p>
                                            <p>" . $row['ca_nombre'] ."</p>
                                            <p>" . $row['p_estado'] ."</p>
                                            <p>" . $row['n_nombre'] ."</p>
                                                <a class='Btn__Green' href='../PHP/ProyectosRead.php?id=".trim($row['p_id'])."'>Ver</a>
                                                <a class='Btn__Blue' href='../PHP/ProyectosUpdate.php?id=".trim($row['p_id'])."'>Actualizar</a>
                                                <a class='Btn__Red' href='../PHP/ProyectosDelete.php?id=".trim($row['p_id'])."'>Eliminar</a>
                                            <p></p>
                                        ";

                                }
                                Database::disconnect();
                            ?>
            </div>
        </form>
    </main> 

</body>
</html>