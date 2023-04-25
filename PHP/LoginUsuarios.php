<?php

    require 'dataBase.php';

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

  <title>Colaboradores</title>

  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/FormsStructure.css">

</head>

<body>

  <header>
    <img class="Logo__EscNegCie" src ="../media/logotec-ings.svg">
    <ul>
      <li><a href="../HTML/PaginaInicio.html">Inicio</a></li>
      <li><a href="../PHP/registrarProyecto.php">Registrar proyecto</a></li>
    </ul>
  </header>

  <main> 

      <div class="Card-1">
        <a href="../PHP/LoginUsuarios.php" class="Btns Btn-1">Inicio Sesion</a>
        <a href="../PHP/RegistroUsuarios.php" class="Btns Btn-2">Registro</a>
        <form class="Form__Card-1   " action="../PHP/LoginUsuarios.php" method="post">
          <table >
              <tr>
                  <td>Correo</td>
                  <td><input class="Text__Input" type="Email" name="Correo"></td>
              </tr>
              <tr>
                  <td>Contraseña  </td>
                  <td><input class="Text__Input" type="Password" name="Contraseña"></td>
              </tr>
              <tr>
                  <td colspan="2" class="Td__Iniciar__Sesion" ><input class="Btn__Iniciar__Sesion" type="submit" value="Iniciar Sesion" id="submit" name="submit"></td>
                  <td></td>
              </tr>
          </table>
        </form>
      </div>
      

  </main>

</body>

</html>