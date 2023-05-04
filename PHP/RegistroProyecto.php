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
        $project_name_code_error = null;
        $project_pass_error = null;
        $project_pass_confirm_error = null;
        
        $project_name_code = $_POST['project_name_code'];
        $project_pass = $_POST['project_pass'];
        $project_pass_confirm = $_POST['project_pass_confirm'];

        $valid = true;
        $edition_available = true;
        $edition_error = null;

        // Empty project name code
        if (empty($project_name_code)) {
            $project_name_code_error = 'Por favor ingresa el nombre clave de tu proyecto';
            $valid = false;
        }

        // Empty project password
        if (empty($project_pass)) {
            $project_pass_error = 'Por favor ingresa la contraseña de tu proyecto';
            $valid = false;
        }

        // Empty project password confirmation
        if (empty($project_pass_confirm)) {
            $project_pass_confirm_error = 'Por favor ingresa la confirmación de contraseña';
            $valid = false;
        }

        // Project password confirmation does not match
        elseif ($project_pass != $project_pass_confirm) {
            $project_pass_confirm_error = 'La confirmación de contraseña no coincide';
            $valid = false;
        }

        // Verify project code name is unique
        $pdo = Database::connect();
        $sql = "SELECT * FROM PROYECTO WHERE p_nombre_clave = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($project_name_code));
        Database::disconnect();

        // Project code name already exists
        if ($q->rowCount() == 1) {
            $project_name_code_error = 'Este nombre clave ya está en uso. Por favor ingresa otro';
            $valid = false;
        }

        // Valid data
        if ($valid) {
            $pdo = Database::connect();            

            //Insert project into PROYECTO_EDICION and create proyect
            date_default_timezone_set('America/Mexico_City');
            $fechaActual = date('Y-m-d H:i:s');
            $sql = "SELECT * FROM EDICION WHERE ed_fecha_inicio <=? AND ed_fecha_fin >=?";
            $q = $pdo->prepare($sql);
            $q->execute(array($fechaActual,$fechaActual));


            if ($q->rowCount() == 1){
                $ed = $q->fetch(PDO::FETCH_ASSOC);
                $sql = "INSERT INTO PROYECTO (p_nombre_clave, p_pass, p_estado, ed_id) VALUES (?, ?, 'Registrado',?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($project_name_code, $project_pass, $ed['ed_id']));

                // Get project data
                $sql = "SELECT * FROM PROYECTO WHERE p_nombre_clave = ? AND p_pass = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($project_name_code, $project_pass));
                Database::disconnect();
                $project = $q->fetch(PDO::FETCH_ASSOC);
            }

            else {
                $edition_error = "El registro de proyectos está inhabilitado mientras inicia la nueva edición de Expo Ingeniería";
                $edition_available = false;
            }

            if ($edition_available) {
                // Create session variables
                $_SESSION['logged_in'] = true;
                $_SESSION['user_type'] = "project";
                $_SESSION['id'] = $project['p_id'];

                // Redirect
                header("Location: ../PHP/DashboardProyecto.php");
                exit();
            }
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
        
        <title>Registro de proyecto | Expo ingenierías</title>
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
                <form class="Form__Card-1" action="" method="POST">
                    <center>
                        <b>Crea un nombre clave y una contraseña para tu proyecto</b>
                        <br><br>
                        <small>(Estas serán tus credenciales para iniciar sesión)</small>
                    </center>
                    <table>
                        <tr>
                            <td>Nombre clave</td>
                            <td><input class="Text__Input" type="text" name="project_name_code" value="<?php echo !empty($project_name_code) ? $project_name_code : ''; ?>" autofocus required></td>
                        </tr>
                        <tr>
                            <td>Contraseña</td>
                            <td><input class="Text__Input" type="password" name="project_pass" value="<?php echo !empty($project_pass) ? $project_pass : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Confirmar contraseña</td>
                            <td><input class="Text__Input" type="password" name="project_pass_confirm" value="<?php echo !empty($project_pass_confirm) ? $project_pass_confirm : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="Td__Registrar" colspan="2">
                                <input class="Btn__Registrar" type="submit" value="Registrar" name="submit">
                                <?php if (!empty($edition_error)): ?>
                                    <br>
                                    <span class="Error__Message"><?php echo $edition_error; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>