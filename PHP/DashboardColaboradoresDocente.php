<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    $pdo = Database::connect();

    //Fecha Fin Expo Campaña
    $sql = "SELECT ed_fecha_fin 
            FROM COLABORADOR 
            NATURAL JOIN EDICION_COLABORADOR 
            NATURAL JOIN EDICION
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $fecha->execute(array($_SESSION['id']));

    //Proyectos por revisar
    $sql = "SELECT *
            FROM PROYECTO_DOCENTE 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $proyectosCalificar = $q->rowCount();

    //Avisos
    $sql = "SELECT * 
            FROM ANUNCIO 
            WHERE an_grupo = ?
            ORDER BY an_fecha";
    $group = 3; //
    $q = $pdo->prepare($sql);
    $q->execute(array($group));
    $anuncios = $q->fetchAll();

    //Tipo de usuario (Jurado/Profesor)
    $sql = "SELECT co_es_jurado 
            FROM COLABORADOR 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $tipoUsuario = $q->fetchAll();


    Database::disconnect();    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/Dashboards.css">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
                <li><a href="#">Layout de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                    <?php 
                        if ($tipoUsuario == true) {
                            echo "<li><a href='../PHP/DashboardColaboradoresJuez'>Cambiar Vista Jurado</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </header>
        <main>
            <div class="Action__Btn">
                <a href="../PHP/">Calificar Proyectos</a>
            </div>

            <div class="Counter">
                <p>ExpoIngenieria comienza en:</p>
                <h1>
                    <?php echo $fecha ?>
                </h1>
            </div>

            <div class="Info">
                <p>Proyectos por revisar</p>
                <h1>
                    <?php echo $proyectosCalificar;?>
                </h1>
            </div>

            <div class="Messages__Menu">
                <div class="Messages__Tittle">
                    <h1>Avisos</h1>
                </div>
                <div class="Messages">
                    <?php
                        foreach ($anuncios as $row) {
                            echo '<div><h1>'.$row['an_titulo'].'</h1><p>'.$row['an_contenido'].'</p><br></div>';
                        }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>