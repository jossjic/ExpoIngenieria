<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    $pdo = Database::connect();

    
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
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="#">Layout de proyectos</a></li>
            </ul>
            <nav>
                <ul>
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