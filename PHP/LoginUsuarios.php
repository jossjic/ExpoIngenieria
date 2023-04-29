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
        
        $collaborator_email_error = null;
        $collaborator_pass_error = null;
        $login_error = null;
        
        $collaborator_email = $_POST['collaborator_email'];
        $collaborator_pass = $_POST['collaborator_pass'];

        $valid = true;

        if (empty($collaborator_email)) {
            $collaborator_email_error = 'Por favor ingresa tu correo electrónico';
            $valid = false;
        }

        if (empty($collaborator_pass)) {
            $collaborator_pass_error = 'Por favor ingresa tu contraseña';
            $valid = false;
        }


        // Verify credentials
        $pdo = Database::connect();
        $sql = "SELECT * FROM COLABORADOR WHERE co_correo = ? AND co_pass = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($collaborator_email, $collaborator_pass));

        $sql = "SELECT * FROM ADMIN WHERE co_correo = ? AND co_pass = ?";
        $admin = $pdo->prepare($sql);
        $admin->execute(array($collaborator_email, $collaborator_pass)); 
        $isAdmin = $admin->rowCount() == 1;
        Database::disconnect();

        // Credentials are incorrect
        if ($q->rowCount() == 0) {
            $login_error = 'El nombre o contraseña que ingresaste no están asociados a una cuenta';
            $valid = false;
        } else if ($admin->rowCount() == 0){
            $login_error = 'El nombre o contraseña que ingresaste no están asociados a una cuenta';
            $valid = false;
        }

        if ($isAdmin){
            if($valid){
                $collaborator = $admin->fetch(PDO::FETCH_ASSOC);
                $_SESSION['logged_in'] = true;
                $_SESSION['user_type'] = "ADMIN";
                $_SESSION['id'] = $collaborator['co_correo'];
                // Redirect
                header("Location: ../PHP/AdminInicio.php");
                exit();
            }
        } else {

            if ($valid) {
                // Get collaborator data
                $collaborator = $q->fetch(PDO::FETCH_ASSOC);
    
                // Create session variables
                if ($collaborator['co_es_jurado'] == true){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_type'] = "collaborator-judge";
                    $_SESSION['id'] = $collaborator['co_correo'];
                    // Redirect
                    header("Location: ../PHP/DashboardColaboradoresJuez.php");
                    exit();
                } elseif ($collaborator['co_es_jurado'] == false) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_type'] = "collaborator-teacher";
                    $_SESSION['id'] = $collaborator['co_correo'];
                    // Redirect
                    header("Location: ../PHP/DashboardColaboradoresDocente.php");
                    exit();
                }
                
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/ico" href="../media/favicon.ico"/>
        <title>Inicio de sesión de colaborador | Expo ingenierías</title>
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
                <a class="Btns Btn-1" href="../PHP/LoginUsuarios.php">Iniciar sesión</a>
                <a class="Btns Btn-2" href="../PHP/RegistroUsuarios.php">Registrarse</a>
                <form class="Form__Card-1" action="" method="post">
                    <center><b>¡Bienvenido!<br><br>Ingresa las credenciales de tu cuenta</b></center>
                    <table>
                        <tr>
                            <td>Correo</td>
                            <td>
                                <input class="Text__Input" type="email" name="collaborator_email" value="<?php echo !empty($collaborator_email) ? $collaborator_email : ''; ?>" autofocus required>
                                <?php if (!empty($collaborator_email_error)): ?>
                                    <br>
                                    <span class="Error__Message"><?php echo $collaborator_email_error; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Contraseña  </td>
                            <td>
                                <input class="Text__Input" type="password" name="collaborator_pass" value="<?php echo !empty($collaborator_pass) ? $collaborator_pass : ''; ?>" required>
                                <?php if (!empty($collaborator_pass_error)): ?>
                                    <br>
                                    <span class="Error__Message"><?php echo $collaborator_pass_error; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="Td__Iniciar__Sesion" colspan="2">
                                <input class="Btn__Iniciar__Sesion" type="submit" value="Iniciar sesión" name="submit">
                                <?php if (!empty($login_error)): ?>
                                    <br>
                                    <span class="Error__Message"><?php echo $login_error; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>