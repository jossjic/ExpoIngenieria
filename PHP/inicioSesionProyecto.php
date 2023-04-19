<?php
    require "database.php";

    $NombreError = null;
    $ContraseñaError = null;

    if (!empty($_POST)) {
        $Nombre = $_POST['Nombre'];
        $Contraseña = $_POST['Contraseña'];

        $valid = true;

        if ($valid) {
            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTOV1 WHERE p_nombre = ? AND d_contraseña = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Nombre, $Contraseña));

            
            if ($q->rowCount() == 1) {
                echo "Bienvenido : $Nombre";

            } else if ($q->rowCount() == 0) {
                echo "No ingresó, Usuario no existe: $Nombre . $Contraseña";
            }

            Database::disconnect();
            //header("Location: ../HTML/InicioSesionJurado.html");
            exit(); // se debe incluir un exit() después de una redirección con header()
        }
    }
?>