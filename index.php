<?php
    require_once "./PHP/dataBase.php";

    session_name("EngineerXpoWeb");
    session_start();

    if (isset($_SESSION['logged_in'])) {
        
        // Project user
        if ($_SESSION['user_type'] === "project") {
            header("Location: ./HTML/DashboardProyecto.html");
        }

        // Collaborator user
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="./media/favicon.ico"/>

    <title>Expo Ingenieria</title>

    <link rel="stylesheet" href="./CSS/PaginaInicio.css">
</head>
<body>
    <header>
        <img class="Logo__Expo" src="./media/logo-expo.svg" alt="Logo Expo Ingenieria">
        <img class="Logo__EscNegCie" src="./media/logotec-ings.svg" alt="Logo Escuela de Negocios">
    </header>
    <main>

        <section class="Presentacion__Main">
            <h2>Explora el futuro de la ingeniería</h2>

            <div class="Usuarios">
                <a href="./HTML/LoginUsuarios.html" rel="noopener noreferrer">Eres Docente - Click Aqui!</a>
            </div>

            <div class="Proyectos">
                <a href="./HTML/LoginProyecto.html" rel="noopener noreferrer">Tienes un Proyecto o Quieres Registrarlo - Click Aqui!</a>
            </div>
        </section>

        <section class="Objetivo__Main">
            <!-- <div class="Something">
                <h1>REGISTRA TU PROYECTO!</h1>
            </div> -->
            <div class="Explanation">
                <h1>¿Que es ExpoIngenieria?</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus commodi et dolore nulla sit asperiores quod dolores esse. Consequuntur nostrum, dolore nesciunt iure consequatur voluptatum iste doloremque aut aperiam similique.</p>
                <a class="Registrar__Proyecto" href="#">Registrar Proyecto</a>
            </div>
            
            <div class="Video__Explanation">
                <iframe width="100%" height="80%" src="https://www.youtube.com/embed/JlE4XlMmTJI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </section>
        
    </main>
    <footer>
        <h1>D.R. INSTITUTO TECNOLÓGICO Y DE ESTUDIOS SUPERIORES DE MONTERREY 2022.</h1>
    </footer>
</body>
</html>