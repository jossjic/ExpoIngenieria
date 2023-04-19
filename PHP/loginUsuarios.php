<?php

    require 'database.php';

    $CorreoError = null;
    $ContraseñaError = null;
    $TipoUsuarioError = null;

    if (!empty($_POST)) {
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];
        $TipoUsuario = $_POST['tipoUsuario'];

        $valid = true;

        

        if (trim($TipoUsuario) === trim('Jurado')) {
            
            if ($valid) {
                $pdo = Database::connect();
                $sql = "SELECT * FROM JURADOV1 WHERE j_correo = ? AND j_contraseña = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($Correo, $Contraseña));

                

                if ($q->rowCount() == 1) {
                    echo "Bienvenido ";
                } else if ($q->rowCount() == 0) {
                    echo "No ingresó, Usuario no existe.";
                }

                Database::disconnect();
                //header("Location: ../HTML/InicioSesionJurado.html");
                exit(); // se debe incluir un exit() después de una redirección con header()
            }
            
        } elseif (trim($TipoUsuario) === trim('Profesor')) {
            
            if ($valid) {
                $pdo = Database::connect();
                $sql = "SELECT * FROM DOCENTEV1 WHERE d_correo = ? AND d_contraseña = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($Correo, $Contraseña));
                if ($q->rowCount() == 1) {
                    echo "Bienvenido ";
                } else if ($q->rowCount() == 0) {
                    echo "No ingresó, Usuario no existe.";
                }
                Database::disconnect();
                //header("Location: ../HTML/InicioSesionJurado.html");
                //exit(); // se debe incluir un exit() después de una redirección con header()
            }

        }
    }
?>

