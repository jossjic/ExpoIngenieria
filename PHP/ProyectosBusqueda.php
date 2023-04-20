<?php

    require 'dataBase.php';

    $BuscarNombreError = null;
    $BtnBuscarError = null;
    $ProyectoIDError = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Certificados</title>


  <link rel="stylesheet" href="../CSS/AdminPages.css">
  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
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
                <li><a href="#">Reconocimientos</a></li>
                <li><a href="#">Proyectos</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Eastadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="Admin__Start">
            <div class="Admin__Start__Left">
                <h1>Certificados Expo Ingenieria</h1>
                <table>
                    <tr>
                        <td>Participantes totales:</td>
                        <td id="TotalParticipantes">
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
                        <td>Participantes Activos:</td>
                        <td id="TotalActivos">
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
                        <td>Ganadores:</td>
                        <td id="TotalGanadores">
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
                <a class="Admin__Start__Right__Btn" href="../PHP/EstadisticasUsuarios.php">Estadisticas Usuarios</a>
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

        <form method="post" class="Info">
            <div class="Winners__View__Header">
                <p class="Winners__View__Column-1">&nbsp;</p>
                <p class="Winners__View__Column-2">ID</p>
                <p class="Winners__View__Column-3">Nombre</p>
                <p class="Winners__View__Column-4">Categoria</p>
                <p class="Winners__View__Column-5">Estado</p>
                <p class="Winners__View__Column-6">Ultima Modificación</p>
            </div>
            <div class="Info__Table">
                                <?php
                                    if (!empty($_POST)) {
                                        $BuscarNombre = $_POST['BuscarNombre'];
                                        $BtnBuscar = $_POST['BtnBuscar'];
                                        $ProyectoID = $_POST['ProyectoID'];
                                
                                        $valid = true;
                                
                                        if (trim($ProyectoID) === trim('ID')) {
                                            if ($valid) {
                                                $pdo = Database::connect();
                                                $sql = "SELECT * FROM PROYECTOV1 WHERE p_id = ?";
                                                $q = $pdo->prepare($sql);
                                                $q  ->execute(array($BuscarNombre));
                                                foreach ($q as $row) {
                                                    echo "
                                                        <p><input type='checkbox'></p>
                                                        <p>" . $row['p_id'] . "</p>
                                                        <p>" . $row['p_nombre'] . "</p>
                                                        <p>" . $row['p_categoria'] . "</p>
                                                        <p>" . $row['p_estado'] . "</p>
                                                        <p>" . $row['p_fecha_modificacion'] . "</p>
                                                     ";
                                                }
                                                Database::disconnect();
                                                
                                            }
                                        } elseif (trim($ProyectoID) === trim('Nombre')) {
                                            if ($valid) {
                                                $pdo = Database::connect();
                                                $sql = "SELECT * FROM PROYECTOV1 WHERE p_nombre = ?";
                                                $q = $pdo->prepare($sql);
                                                $q->execute(array($BuscarNombre));
                                                foreach ($q as $row) {
                                                    echo "
                                                        <p><input type='checkbox'></p>
                                                        <p>" . $row['p_id'] . "</p>
                                                        <p>" . $row['p_nombre'] . "</p>
                                                        <p>" . $row['p_tipo'] . "</p>
                                                        <p>" . $row['p_estado'] . "</p>
                                                        <p>" . $row['p_fecha_modificacion'] . "</p>
                                                     ";
                                                }
                                                Database::disconnect();
                                                
                                            }
                                        }
                                
                                    }
                                ?>
            </div>

            <input class="Admin__Submit__Btn" value="Enviar Reconocimientos" type="button"> 
        </form>

    </main>

</body>
</html>

