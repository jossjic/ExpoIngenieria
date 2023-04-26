<?php
    require_once "dataBase.php";

    session_name("EngineerXpoWeb");
    session_start();

    if (isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    // POST METHOD
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $project_private_name_error = null;
        $project_pass_error = null;
        $login_error = null;
        
        $project_private_name = $_POST['project_private_name'];
        $project_pass = $_POST['project_pass'];

        $valid = true;

        if (empty($project_private_name)) {
            $project_private_name_error = 'Por favor ingresa el nombre privado de tu proyecto';
            $valid = false;
        }

        if (empty($project_pass)) {
            $project_pass_error = 'Por favor ingresa la contraseña de tu proyecto';
            $valid = false;
        }

        // Verify credentials
        $pdo = Database::connect();
        $sql = "SELECT * FROM PROYECTO WHERE p_nombre_clave = ? AND p_pass = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($project_private_name, $project_pass));
        Database::disconnect();

        // Credentials are incorrect
        if ($q->rowCount() == 0) {
            $login_error = 'El nombre o contraseña que ingresaste no están asociados a un proyecto';
            $valid = false;
        }

        if ($valid) {
            // Get project data
            $project = $q->fetch(PDO::FETCH_ASSOC);

            // Create session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = "project";
            $_SESSION['id'] = $project['p_id'];

            // Redirect
            header("Location: ../PHP/DashboardProyecto.php");
            exit();
        }
    }

    // GET METHOD
    else {

    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/ico" href="../media/favicon.ico"/>
        <title>Inicio de sesión de proyecto | Expo ingenierías</title>
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/FormsStructure.css">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
            </ul>
            <nav>
                <ul></ul>
            </nav>
        </header>
        <main>
            <div class="Card-1">
                <a class="Btns Btn-1" href="../PHP/LoginProyecto.php">Iniciar sesión</a>
                <a class="Btns Btn-2" href="../PHP/RegistroProyecto.php">Registrarse</a>
                <form class="Form__Card-1" action="" method="post">
                    <center><b>¡Bienvenido!<br><br>Ingresa las credenciales de tu proyecto</b></center>
                    <table>
                        <tr>
                            <td>Nombre privado</td>
                            <td><input class="Text__Input" type="text" name="project_private_name" value="<?php echo !empty($project_private_name) ? $project_private_name : ''; ?>" autofocus required></td>
                        </tr>
                        <tr>
                            <td>Contraseña</td>
                            <td><input class="Text__Input" type="password" name="project_pass" value="<?php echo !empty($project_pass) ? $project_pass : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="Td__Iniciar__Sesion" colspan="2"><input class="Btn__Iniciar__Sesion" type="submit" value="Iniciar sesión" name="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>