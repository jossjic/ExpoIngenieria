<?php
    require_once "dataBase.php";

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    // GET METHOD
    $pdo = Database::connect();

    // Project
    $sql = "SELECT * FROM PROYECTO WHERE p_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $project = $q->fetch(PDO::FETCH_ASSOC);

    // Students
    $sql = "SELECT *
            FROM ALUMNO
            NATURAL JOIN PROYECTO_ALUMNO
            WHERE p_id = ? 
            ORDER BY a_apellido";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $students = $q->fetchAll();
    $number_of_students = $q->rowCount();

    // Category
    if ($project['ca_id'] != null) {
        $sql = "SELECT *
                FROM CATEGORIA
                WHERE ca_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($project['ca_id']));
        $category = $q->fetch(PDO::FETCH_ASSOC);
    }

    // Level
    if ($project['n_id'] != null) {
        $sql = "SELECT *
                FROM nivel
                WHERE n_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($project['n_id']));
        $level = $q->fetch(PDO::FETCH_ASSOC);
    }

    // Advertisements
    $sql = "SELECT * 
            FROM ANUNCIO 
            WHERE an_grupo = ?
            ORDER BY an_fecha DESC";
    $group = 1; // Projects
    $q = $pdo->prepare($sql);
    $q->execute(array($group));
    $advertisements = $q->fetchAll();

    //Fecha Fin Expo Campaña
    $sql = "SELECT ed_fecha_fin 
            FROM PROYECTO 
            NATURAL JOIN EDICION
            WHERE p_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $fecha = $q->fetch(PDO::FETCH_ASSOC);

    Database::disconnect();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard proyecto | Expo ingenierías</title>
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/Dashboards.css">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="#">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>
        <main class="Proyect__View">
            <div class="Action__Btn">
                <h1>Estado de tu proyecto</h1>
                <h3><?php echo $project['p_estado']; ?></h3>
            </div>
            <div class="Counter">
                <p>ExpoIngenieria comienza en:</p>
                <h1 id="countdown"><?php echo $fecha['ed_fecha_fin'] ?></h1>
            </div>
            <div class="Info__Other">
                <div class="Info__Tittle">
                    <h2><?php echo $project['p_nombre'] != null ? $project['p_nombre'] : '<i>Sin nombre público asignado</i>'; ?></h2>

                    <div class="Proyect__Edit">
                        <a href="../PHP/AdministradorProyecto.php">Editar</a>
                    </div>
                </div>
                <div class="Info__Menu">
                    <dl>
                        <dt><strong>Última modificación</strong></dt>
                        <dd><?php echo $project['p_ult_modif'] != null ? $project['p_ult_modif'] : '<i>Sin modificar</i>'; ?></dd>
                    </dl>
                    <dl>
                        <dt><strong>Integrantes</strong></dt>
                        <?php
                            if ($number_of_students == 0) {
                                echo '<dd><i>Sin estudiantes asignados</i></dd>';
                            }
                            else {
                                foreach ($students as $row) {
                                    echo '<dd>'.$row['a_nombre'].' '.$row['a_apellido'].'</dd>';
                                }
                            }
                        ?>
                    </dl>
                    <dl>
                        <dt><strong>Descripción</strong></dt>
                        <dd><?php echo $project['p_descripcion'] != null ? $project['p_descripcion'] : '<i>Sin descripción asignada</i>'; ?></dd>
                    </dl>
                    <dl>
                        <dt><strong>Nivel de desarrollo</strong></dt>
                        <dd><?php echo $level['n_nombre'] != null ? $level['n_nombre'] : '<i>Sin nivel de desarrollo asignado</i>'; ?></dd>
                    </dl>
                    <dl>
                        <dt><strong>Área estratégica</strong></dt>
                        <dd><?php echo $category['ca_nombre'] != null ? $category['ca_nombre'] : '<i>Sin área estratégica asignada</i>'; ?></dd>
                    </dl>
                    <dl>
                        <dt><strong>Video</strong></dt>
                        <?php
                            if ($project['p_video'] == null) {
                                echo '<dd><i>Sin url de video asignado</i></dd>';
                            }
                            else {
                                preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_video'], $match);
                                $video_id = $match[1];
                                $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
                                echo '<dd style="width: 100%;"><iframe width="100%" src="'.$video_full_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></dd>';
                            }
                        ?>
                    </dl>
                    <dl>
                        <dt><strong>Póster</strong></dt>
                        <?php
                            if ($project['p_poster'] == null) {
                                echo '<dd><i>Sin url de imagen de póster asignado</i></dd>';
                            }
                            else {
                                preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_poster'], $match);
                                $image_id = $match[1];
                                $image_full_link = "https://drive.google.com/uc?export=view&id=".$image_id;
                                echo '<dd style="width: 100%;"><iframe width="100%" src="'.$image_full_link.'" allow="autoplay"></iframe></dd>';
                            }
                        ?>
                    </dl>
    
                </div>
            </div>

            <div class="Messages__Menu">
                <div class="Messages__Tittle">
                    <h1>Avisos</h1>
                </div>
                <div class="Messages">
                    <?php
                        foreach ($advertisements as $row) {
                            echo '<div><h1>'.$row['an_titulo'].'</h1><p>'.$row['an_contenido'].'</p><br></div>';
                        }
                    ?>
                </div>
            </div>
        </main>
        <script src="../JS/CounterJuez.js"></script>
    </body>
</html>