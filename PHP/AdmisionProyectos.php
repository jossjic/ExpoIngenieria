<?php
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in']) || ($_SESSION['user_type'] != "collaborator-teacher" && $_SESSION['user_type'] != "collaborator-teacher-judge")) {
        header("Location: ../index.php");
        exit();
    }

    $id = null;

    if (!empty($_POST)) {

        // keep track post values
        $id   = $_POST['project_id'];
        $action = $_POST['project_action'];

        /// validate input
        $valid = true;

        if (empty($id)) {
            header("Location: AdmisionProyectos.php");
            exit();
        }

        if (empty($action)) {
            header("Location: AdmisionProyectos.php");
            exit();
        }

        if ($action === "accept") {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE PROYECTO SET p_estado = ? WHERE p_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array("Aceptado", $id));
            Database::disconnect();
            header("Location: AdmisionProyectos.php");
            exit();
        }

        elseif ($action === "deny") {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE PROYECTO SET p_estado = ? WHERE p_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array("Rechazado", $id));
            Database::disconnect();
            header("Location: AdmisionProyectos.php");
            exit();
        }
        else {
            header("Location: VerInfoProyecto.php?id=$id");
            exit();
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
        <title>Admisión de Proyectos | EngineerXpoWeb</title>
        

        <link rel="stylesheet" href="../CSS/estructuraProyecto.css">
        <link rel="stylesheet" href="../CSS/admisionProyecto.css">
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
				<li><a href="../PHP/DashboardColaboradoresDocente.php">Dashboard</a></li>
                <li><a href="../PHP/Mapa.php">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main>
			<div class="container">

                <?php
                    $pdo = Database::connect();
                    $sql = 'SELECT * 
                            FROM PROYECTO 
                            NATURAL JOIN CATEGORIA
                            NATURAL JOIN PROYECTO_DOCENTE
                            WHERE p_estado = "Registrado" AND co_correo = \''.$_SESSION['id'].'\'
                            ORDER BY p_nombre';

                    $projects = $pdo->query($sql);
                    Database::disconnect();
                    $number_of_projects = $projects->rowCount();
                ?>

                <?php if ($number_of_projects == 0): ?>
                    <div class="announce"><h2>Sin Proyectos Por Admitir</h2></div>

                <?php else: ?>

                    <form action="AdmisionProyectos.php" method="post" id="project-form-id">
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
                                            echo     '<td>'.$row['ca_nombre'].'</td>';
                                            echo     '<td>'.$row['p_ult_modif'].'</td>';
                                            echo     '<td>';
                                            echo         '<button type="button" class="btn btn-secondary" type="button" onclick="seeProject('.$row['p_id'].')">Ver más</button>';
                                            echo         ' <button type="button" class="btn btn-success" type="button" onclick="acceptProject('.$row['p_id'].')">Aceptar</button> ';
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

			<div class="container">
                <?php
                    $pdo = Database::connect();
                    $sql = 'SELECT * 
                            FROM PROYECTO 
                            NATURAL JOIN CATEGORIA
                            NATURAL JOIN PROYECTO_DOCENTE
                            WHERE p_estado = "Aceptado" AND co_correo = \''.$_SESSION['id'].'\'
                            ORDER BY p_nombre';

                    $projects = $pdo->query($sql);
                    Database::disconnect();
                    $number_of_projects_admitidos = $projects->rowCount();
                ?>

                <?php if ($number_of_projects_admitidos == 0): ?>
                    <div class="announce"><h2>Sin Proyectos Admitidos</h2></div>

                <?php else: ?>

                    <form action="AdmisionProyectos.php" method="post" id="project-form-id">
                        <input type="hidden" name="project_id" value="" id="project-id">
                        <input type="hidden" name="project_action" value="" id="project-action">
                    </form>
                    <fieldset class="project-container">
                        <legend><strong>Proyectos Admitidos</strong></legend>
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
                                            echo     '<td>'.$row['ca_nombre'].'</td>';
                                            echo     '<td>'.$row['p_ult_modif'].'</td>';
                                            echo     '<td>';
                                            echo         '<button type="button" class="btn btn-secondary" type="button" onclick="seeProject('.$row['p_id'].')">Ver más</button>';
                                            echo         ' <button type="button" class="btn btn-success" type="button" onclick="acceptProject('.$row['p_id'].')">Aceptar</button> ';
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

			<div class="container">

                <?php
                    $pdo = Database::connect();
                    $sql = 'SELECT * 
                            FROM PROYECTO 
                            NATURAL JOIN CATEGORIA
                            NATURAL JOIN PROYECTO_DOCENTE
                            WHERE p_estado = "Rechazado" AND co_correo = \''.$_SESSION['id'].'\'
                            ORDER BY p_nombre';

                    $projects = $pdo->query($sql);
                    Database::disconnect();
                    $number_of_projects_rechazados = $projects->rowCount();
                ?>

                <?php if ($number_of_projects_rechazados == 0): ?>
                    <div class="announce"><h2>Sin Proyectos No Admitidos</h2></div>

                <?php else: ?>

                    <form action="AdmisionProyectos.php" method="post" id="project-form-id">
                        <input type="hidden" name="project_id" value="" id="project-id">
                        <input type="hidden" name="project_action" value="" id="project-action">
                    </form>
                    <fieldset class="project-container">
                        <legend><strong>Proyectos No Admitidos</strong></legend>
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
                                            echo     '<td>'.$row['ca_nombre'].'</td>';
                                            echo     '<td>'.$row['p_ult_modif'].'</td>';
                                            echo     '<td>';
                                            echo         '<button type="button" class="btn btn-secondary" type="button" onclick="seeProject('.$row['p_id'].')">Ver más</button>';
                                            echo         ' <button type="button" class="btn btn-success" type="button" onclick="acceptProject('.$row['p_id'].')">Aceptar</button> ';
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
