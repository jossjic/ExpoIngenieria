<?php

    require 'dataBase.php';

    $id = null;

    if (!empty($_POST)) {

        // keep track post values
        $id   = $_POST['project_id'];
        $action = $_POST['project_action'];

        /// validate input
        $valid = true;

        if (empty($id)) {
            header("Location: admisionProyectos.php");
        }

        if (empty($action)) {
            header("Location: admisionProyectos.php");
        }

        if ($action === "accept") {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE V2_PROYECTO SET p_estado = ? WHERE p_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array("Aceptado", $id));
            Database::disconnect();
            header("Location: admisionProyectos.php");
        }

        elseif ($action === "deny") {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE V2_PROYECTO SET p_estado = ? WHERE p_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array("Rechazado", $id));
            Database::disconnect();
            header("Location: admisionProyectos.php");
        }
        else {
            header("Location: verInfoProyecto.php?id=$id");
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admisión de Proyectos | EngineerXpoWeb</title>

        <link rel="stylesheet" href="../CSS/estructuraProyecto.css">
        <link rel="stylesheet" href="../CSS/admisionProyecto.css">
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    </head>
    <body>
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logotipo de la Escuela de Ingeniería y Ciencias">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Layout de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="#">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="container">
                <!-- <table>
                    <tr>
                        <td class="especial">Buscar</td>
                        <td>
                            <select name="bus" id="bus">
                                <option value="bus_1">Por ID</option>
                                <option value="bus_2">Lorem ipsum 2</option>
                                <option value="bus_3">Lorem ipsum 3</option>
                                <option value="bus_4">Lorem ipsum 4</option>
                            </select>
                        </td>
                        <td>
                            <input type="search" value="Ingrese ID del proyecto" />
                        </td>
                    </tr>
                </table> -->

                <?php
                    $pdo = Database::connect();
                    $sql = 'SELECT * 
                            FROM V2_PROYECTO 
                            NATURAL JOIN 
                            V2_CATEGORIA
                            WHERE p_estado = "Registrado"
                            ORDER BY p_nombre';

                    $projects = $pdo->query($sql);
                    Database::disconnect();
                    $number_of_projects = $projects->rowCount();
                ?>

                <?php if ($number_of_projects == 0): ?>
                    <div class="announce"><h2>Sin proyectos por admitir</h2></div>

                <?php else: ?>

                    <form action="admisionProyectos.php" method="post" id="project-form-id">
                        <input type="hidden" name="project_id" value="" id="project-id">
                        <input type="hidden" name="project_action" value="" id="project-action">
                    </form>
                    <fieldset class="project-container">
                        <legend><strong>Proyectos por admitir</strong></legend>
                        <br>
                        <hr>
                        <div class="rubric-elements">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Ultima Modificación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($projects as $row) {

                                            echo '<tr>';
                                            echo     '<td>'.$row['p_id'].'</td>';
                                            echo     '<td>'.$row['p_nombre'].'</td>';
<<<<<<< HEAD
                                            echo     '<td>'.$row['p_estado'].'</td>';
                                            echo     '<td>14 de octubre de 2022, 16:45 h</td>';
                                            echo     '<td>';
                                            echo         '<button type="button" class="btn btn-secondary" type="button" onclick="seeProject('.$row['p_id'].')">Ver más</button>';
                                            echo         '<button type="button" class="btn btn-success" type="button" onclick="acceptProject('.$row['p_id'].')">Aceptar</button>';
=======
                                            echo     '<td>'.$row['ca_nombre'].'</td>';
                                            echo     '<td>14 de octubre de 2022, 16:45 h</td>';
                                            echo     '<td>';
                                            echo         '<button type="button" class="btn btn-secondary" type="button" onclick="seeProject('.$row['p_id'].')">Ver más</button>';
                                            echo         ' <button type="button" class="btn btn-success" type="button" onclick="acceptProject('.$row['p_id'].')">Aceptar</button> ';
>>>>>>> bf36e1c8bed502d24c1d8cffd7c21d18e02ba1bc
                                            echo         '<button type="button" class="btn btn-danger" type="button" onclick="denyProject('.$row['p_id'].')">Rechazar</button>';
                                            echo     '</td>';
                                            echo '</tr>';
                                            
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>

                <?php endif ?>

            </div>
        </main>

        <!-- <footer>
            <div id=footerPage>
                <img src = "../media/tecc.png" width = "350" height="115">
            </div>
        </footer> -->
    </body>

    <script>
        function acceptProject(projectId) {
            if (document.getElementById("project-id").value === "") {
                document.getElementById("project-id").value = projectId;
                document.getElementById("project-action").value = "accept";
                document.getElementById("project-form-id").submit();
            }
        }
        function denyProject(projectId) {
            if (document.getElementById("project-id").value === "") {
                document.getElementById("project-id").value = projectId;
                document.getElementById("project-action").value = "deny";
                document.getElementById("project-form-id").submit();
            }
        }
        function seeProject(projectId) {
            if (document.getElementById("project-id").value === "") {
                document.getElementById("project-id").value = projectId;
                document.getElementById("project-action").value = "info";
                document.getElementById("project-form-id").submit();
            }
        }
    </script>

</html>
