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
    $q->execute(array($_SESSION['id']));
    $fecha = $q->fetch(PDO::FETCH_ASSOC);

    //Proyectos por revisar
    $sql = "SELECT *
            FROM PROYECTO_JURADO 
            WHERE co_correo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    $proyectosCalificar = $q->rowCount();

    //Avisos
    $sql = "SELECT * 
            FROM ANUNCIO 
            WHERE an_grupo = ?
            ORDER BY an_fecha";
    $group = 2; //Jurados
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
                    <?php 
                        if ($tipoUsuario['co_es_jurado'] == true && $nomina['co_nomina'] != null) {
                            echo "<li><a href='../PHP/DashboardColaboradoresDocente.php'>Cambiar Vista a Docente</a></li>";
                            $_SESSION['user_type'] = "collaborator-teacher";
                        }
                    ?>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="Action__Btn">
                <a href="#">Calificar Proyectos</a>
            </div>

            <div class="Counter">
                <p>ExpoIngenieria comienza en:</p>
                <h1>10:24:45:60</h1>
            </div>

            <div class="Info">
                <p>Proyectos por revisar</p>
                <h1>30</h1>
            </div>

            <div class="Messages__Menu">
                <div class="Messages__Tittle">
                    <h1>Avisos</h1>
                </div>
                <div class="Messages">
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>