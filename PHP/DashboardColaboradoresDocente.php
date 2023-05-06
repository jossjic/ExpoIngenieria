<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    $_SESSION['user_type'] = "collaborator-teacher";

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
    $q->execute(array($_SESSION['id']));
    $fecha = $q->fetch(PDO::FETCH_ASSOC);

    //Proyectos por revisar
    $sql = "SELECT *
            FROM PROYECTO_DOCENTE 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $proyectos_a_admitir = $q->rowCount();

    //Avisos
    $sql = "SELECT * 
            FROM ANUNCIO 
            WHERE an_grupo = ?
            ORDER BY an_fecha";
    $group = 3; //Docentes
    $q = $pdo->prepare($sql);
    $q->execute(array($group));
    $anuncios = $q->fetchAll();

    //Tipo de usuario (Jurado/Profesor)
    $sql = "SELECT co_es_jurado 
            FROM COLABORADOR 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $tipoUsuario = $q->fetch(PDO::FETCH_ASSOC);

    //Nomina (Jurado/Profesor)
    $sql = "SELECT co_nomina 
            FROM COLABORADOR 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $nomina = $q->fetch(PDO::FETCH_ASSOC);


    Database::disconnect();    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
        <title>Dashboard</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/Dashboards.css">
        <script src="../JS/Counter.js"></script>
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
                <li><a href="../PHP/Mapa.php">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <?php 
                        if ($tipoUsuario['co_es_jurado'] == true && $nomina['co_nomina'] != null) {
                            echo "<li><a href='../PHP/DashboardColaboradoresJuez.php'>Cambiar Vista a Jurado</a></li>";
                        }
                    ?>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="Action__Btn">
                <a href="../PHP/AdmisionProyectos.php">Admitir Proyectos</a>
            </div>

            <div class="Counter">
                <p>ExpoIngenieria comienza en:</p>
                <h1 id="countdowndocente">
                    <?php echo $fecha['ed_fecha_fin'] ?>
                </h1>
            </div>

            <div class="Info">
                <p>Proyectos por revisar</p>
                <h1>
                    <?php echo $proyectos_a_admitir;?>
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

        <script src="../JS/CounterDocente.js"></script>
    </body>
</html>