<?php
    require_once "dataBase.php";

    // Combinar con el HTML
    // Checar si el usuario ya está autenticado redirigirlo a su panel correspondiente


    $NombreError = null;
    $ContraseñaError = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $project_name = $_POST['Nombre'];
        $project_pass = $_POST['Contraseña'];

        $valid = true;

        if ($valid) {
            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTO WHERE p_nombre = ? AND p_pass = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($project_name, $project_pass));
            
            if ($q->rowCount() == 1) {
                
                session_name("EngineerXpoWeb");
                session_start();

                $project = $q->fetch(PDO::FETCH_ASSOC);
                
                $_SESSION['user_type'] = "project";
                $_SESSION['id'] = $project['p_id'];
                $_SESSION['name'] = $project['p_nombre'];

                header("Location: ../HTML/DashboardProyecto.html");

            } else if ($q->rowCount() == 0) {
                echo "No ingresó, Usuario no existe: $project_name . $project_pass";
            }

            Database::disconnect();
            //header("Location: ../HTML/InicioSesionJurado.html");
            exit(); // se debe incluir un exit() después de una redirección con header()
        }
    }
?>