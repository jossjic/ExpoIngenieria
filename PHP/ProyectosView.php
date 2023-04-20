<?php
    require 'dataBase.php'
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
                <p>Ultima Modificación</p>
                <div>
                    <p>Acciones</p>
                </div>
            </div>
            <div class="Info__Table">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                foreach ($pdo->query($sql) as $row) {
                                    echo "
                                            <input type='checkbox' name='' id=''>
                                            <p>" . $row['p_id'] ."</p>
                                            <p>" . $row['p_nombre'] ."</p>
                                            <p>" . $row['p_categoria'] ."</p>
                                            <p>" . $row['p_estado'] ."</p>
                                            <p>" . $row['p_fecha_modificacion'] ."</p>
                                            <div class='Btn__Green'>
                                                <a href='../PHP/ProyectosRead.php?id=".trim($row['p_id'])."'>Ver</a>
                                            </div>
                                            <div class='Btn__Blue'>
                                                <a href='../PHP/ProyectosUpdate.php?id=".trim($row['p_id'])."'>Actualizar</a>
                                            </div>
                                            <div class='Btn__Red'>
                                                <a href='../PHP/ProyectosDelete.php?id=".trim($row['p_id'])."'>Eliminar</a>
                                            </div>
                                        ";

                                }
                                Database::disconnect();
                            ?>
            </div>
        </form>
    </main> 

</body>
</html>