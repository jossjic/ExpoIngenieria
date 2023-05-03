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
        
        $collaborator_name_error = null;
        $collaborator_lastname_error = null;
        $collaborator_email_error = null;
        $collaborator_payroll_error = null;
        $collaborator_pass_error = null;
        $collaborator_pass_confirm_error = null;

        $collaborator_name = $_POST['collaborator_name'];
        $collaborator_lastname = $_POST['collaborator_lastname'];
        $collaborator_email = $_POST['collaborator_email'];
        $collaborator_payroll = $_POST['collaborator_payroll'];
        $collaborator_pass = $_POST['collaborator_pass'];
        $collaborator_pass_confirm = $_POST['collaborator_pass_confirm'];

        $valid = true;

        // Empty collaborator name
        if (empty($collaborator_name)) {
            $collaborator_name_error = 'Por favor ingresa tu nombre';
            $valid = false;
        }

        // Empty collaborator lastname
        if (empty($collaborator_lastname)) {
            $collaborator_lastname_error = 'Por favor ingresa tu apellido';
            $valid = false;
        }

        // Empty collaborator email
        if (empty($collaborator_email)) {
            $collaborator_email_error = 'Por favor ingresa tu correo electrónico';
            $valid = false;
        }

        // Empty collaborator payroll
        if (empty($collaborator_payroll)) {
            $collaborator_payroll_error = 'Por favor ingresa tu número de nómina';
            $valid = false;
        }

        // Empty collaborator password
        if (empty($collaborator_pass)) {
            $collaborator_pass_error = 'Por favor ingresa tu contraseña';
            $valid = false;
        }

        // Empty collaborator password confirmation
        if (empty($collaborator_pass_confirm)) {
            $collaborator_pass_confirm_error = 'Por favor ingresa la confirmación de contraseña';
            $valid = false;
        }
        
        // Collaborator password confirmation does not match
        elseif ($collaborator_pass != $collaborator_pass_confirm) {
            $collaborator_pass_confirm_error = 'La confirmación de contraseña no coincide';
            $valid = false;
        }

        // Verify collaborator email is unique
        $pdo = Database::connect();
        $sql = "SELECT * FROM COLABORADOR WHERE co_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($collaborator_email));
        Database::disconnect();

        // Collaborator email already exists
        if ($q->rowCount() == 1) {
            $collaborator_email_error = 'Este correo ya está en uso. Por favor ingresa otro';
            $valid = false;
        }

        // Valid data
        if ($valid) {
            $pdo = Database::connect();

            // Create collaborator
            $sql = "INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES (?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($collaborator_email, $collaborator_payroll, $collaborator_name, $collaborator_lastname, $collaborator_pass, 0));

            // Get project data
            $sql = "SELECT * FROM COLABORADOR WHERE co_correo = ? AND co_pass = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($collaborator_email, $collaborator_pass));
            Database::disconnect();
            $collaborator = $q->fetch(PDO::FETCH_ASSOC);
            
            // Create session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = "collaborator";
            $_SESSION['id'] = $collaborator['co_correo'];
            
            // Redirect
            header("Location: ../PHP/DashboardColaboradoresDocente.php");
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
        <title>Registro de colaborador | Expo ingenierías</title>
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
                <form class="Form__Card-1" action="" method="POST">
                    <center><b>Registra tus datos</b></center>
                    <table id="DefaultForm">
                        <tr>
                            <td>Nombre</td>
                            <td><input class="Text__Input" type="text" name="collaborator_name" value="<?php echo !empty($collaborator_name) ? $collaborator_name : ''; ?>" autofocus required></td>
                        </tr>
                        <tr>
                            <td>Apellidos</td>
                            <td><input class="Text__Input" type="text" name="collaborator_lastname" value="<?php echo !empty($collaborator_lastname) ? $collaborator_lastname : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Correo</td>
                            <td><input class="Text__Input" type="email" name="collaborator_email" value="<?php echo !empty($collaborator_email) ? $collaborator_email : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Nomina</td>
                            <td><input class="Text__Input" type="text" name="collaborator_payroll" value="<?php echo !empty($collaborator_payroll) ? $collaborator_payroll : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Contraseña</td>
                            <td><input class="Text__Input" type="password" name="collaborator_pass" value="<?php echo !empty($collaborator_pass) ? $collaborator_pass : ''; ?>" required></td>
                        </tr>
                            <td>Confirmar contraseña</td>
                            <td><input class="Text__Input" type="password" name="collaborator_pass_confirm" value="<?php echo !empty($collaborator_pass_confirm) ? $collaborator_pass_confirm : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="Td__Registrar" colspan="2"><input class="Btn__Registrar" type="submit" value="Registrar" name="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>