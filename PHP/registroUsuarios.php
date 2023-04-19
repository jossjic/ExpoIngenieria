<?php

    require 'database.php';

    $NominaError = null;
    $NombreError = null;
    $ApellidoPaternoError = null;
    $ApellidoMaternoError = null;
    $CorreoError = null;
    $ContraseñaError = null;
    $tipoUsuarioError = null;
    $ed_idError = null;

    if (!empty($_POST)) {
        $Nomina = $_POST['Nomina'];
        $Nombre = $_POST['Nombre'];
        $ApellidoPaterno = $_POST['ApellidoPaterno'];
        $ApellidoMaterno = $_POST['ApellidoMaterno'];
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $ed_id = $_POST['ed_id'];

        // validate input
        $valid = true;

        if (empty($Nomina)) {
            $NominaError = 'Por favor ingresa tu Nómina';
            $valid = false;
        }
        if (empty($Nombre)) {
            $NombreError = 'Por favor ingresa tu Nombre';
            $valid = false;
        }
        if (empty($ApellidoPaterno)) {
            $ApellidoPaternoError = 'Por favor ingresa tu Apellido Paterno';
            $valid = false;
        }
        if (empty($ApellidoMaterno)) {
            $ApellidoMaternoError = 'Por favor ingresa tu Apellido Materno';
            $valid = false;
        }
        if (empty($Correo)) {
            $CorreoError = 'Por favor ingresa un Correo Electrónico';
            $valid = false;
        }
        if (empty($Contraseña)) {
            $ContraseñaError = 'Por favor ingresa una Contraseña';
            $valid = false;
        }
        if (empty($tipoUsuario)) {
            $tipoUsuarioError = 'Por favor escoje que tipo de usuario eres';
            $valid = false;
        }
        if (empty($ed_id)) {
            $ed_idError = 'Por favor selecciona una Edición';
            $valid = false;
        }


        // insert data
        if (trim($tipoUsuario) === trim('Jurado')) {
            if (true) {
                $pdo = Database::connect();
                $sql = "INSERT INTO JURADOV1(j_id, j_nombre, j_apellido_paterno, j_apellido_materno, j_correo, j_contraseña, ed_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($Nomina, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Correo, $Contraseña, $ed_id));
                Database::disconnect();
                header("Location: ../HTML/InicioSesionJurado.html");
                exit(); // se debe incluir un exit() después de una redirección con header()
            }
        } elseif (trim($tipoUsuario) === trim('Profesor')) {
            echo($tipoUsuario);
            if (true) {
                $pdo = Database::connect();
                $sql = "INSERT INTO DOCENTEV1(d_nomina, d_nombre, d_apellido_paterno, d_apellido_materno, d_correo, d_contraseña, ed_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($Nomina, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Correo, $Contraseña, $ed_id));
                Database::disconnect();
                header("Location: ../HTML/InicioSesionJurado.html");
                exit(); // se debe incluir un exit() después de una redirección con header()
            }
        } 
    }

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro Usuarios</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/FormsStructure.css">
    </head>
    <body>
        
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" >
            <ul>
                <li>
                    <a href="../HTML/InicioSesionJurado.html">Regresar</a>
                </li>
            </ul>
        </header>

        <main>

            <h1>Registro de Usuarios</h1>

            <form action="../PHP/registroUsuarios.php" method="POST">

                <table id="DefaultForm">
                    <tr>
                        <td><label for="Nombre">Nombre</label></td>
                        <td><input type="text" name="Nombre" class="Text__Input" id="Nombre"></td>
                    </tr>
                    <tr>
                        <td><label for="ApellidoPaterno">Apellido Paterno</label></td>
                        <td><input type="text" name="ApellidoPaterno" class="Text__Input" id="ApellidoPaterno"></td>
                    </tr>
                    <tr>
                        <td><label for="ApellidoMaterno">Apellido Materno</label></td>
                        <td><input type="text" name="ApellidoMaterno" class="Text__Input" id="ApellidoMaterno"></td>
                    </tr>
                    <tr>
                        <td><label for="Correo">Correo</label></td>
                        <td><input type="text" name="Correo" class="Text__Input" id="Correo"></td>
                    </tr>
                    <tr>
                        <td><label for="Contraseña">Contraseña</label></td>
                        <td><input type="text" name="Contraseña" class="Text__Input" id="Contraseña"></td>
                    </tr>

                    <tr>
                        <td>
                            <label for="tipoUsuario">¿Que tipo de usuario vas a ser?</label>
                        </td>
                        <td>
                            <select name="tipoUsuario" id="tipoUsuario">
                                <option selected value="Jurado">Jurado</option>
                                <option value="Profesor">Profesor</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Edicion</label>
                        </td>
                        <td>
                            <select name="ed_id" id="ed_i">
                            <?php
														$pdo = Database::connect();
														$query = 'SELECT * FROM EDICIONV1';
														foreach ($pdo->query($query) as $row) {
															if ($row['ed_id']==$ed_id)
																echo "<option selected value='" . $row['ed_id'] . "'>" . $row['nombre'] . "</option>";
															else
																echo "<option value='" . $row['ed_id'] . "'>" . $row['nombre'] . "</option>";
														}
														Database::disconnect();
													?>
                            </select>
                        </td>
                    </tr>

                    <tr id="ProfesorForm">
                        <td><label for="Nomina">Nomina</label></td>
                        <td><input type="text" name="Nomina" class="Text__Input" id="Nomina"></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="Td__Registrar" ><input class="Btn__Registrar" type="submit" value="Registrar" id="submit" name="submit"></td>
                        <td></td>
                      </tr>
                </table>

            </form>
            

        </main>

        <footer>
            <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo Tec">
        </footer>

    </body>
</html>