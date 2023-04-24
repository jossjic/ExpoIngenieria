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

    <link rel="stylesheet" href="./CSS/Page1.css">
</head>
<body>
    <header>
        <img class="Logo__Expo" src="./media/logo-expo.svg" alt="Logo Expo Ingenieria">
        <img class="Logo__EscNegCie" src="./media/logotec-ings.svg" alt="Logo Escuela de Negocios">
    </header>
    <main>

        <h2>Explora el futuro de la ingeniería</h2>

        <div class="Usuarios">
            <a href="./HTML/LoginUsuarios.html" rel="noopener noreferrer">USUARIOS</a>
        </div>

        <div class="Proyectos">
            <a href="./HTML/LoginProyecto.html" rel="noopener noreferrer">PROYECTOS</a>
        </div>
        
    </main>
    <footer>
        <h1>D.R. INSTITUTO TECNOLÓGICO Y DE ESTUDIOS SUPERIORES DE MONTERREY 2022.</h1>
    </footer>
</body>
</html>