<?php 
    require_once 'dataBase.php';

    $NombreError = null;
    $ContraseñaError = null;
    $ed_idError = null;

    if (!empty($_POST)) {
        $Nombre = $_POST['Nombre'];
        $Contraseña = $_POST['Contraseña'];
        $ed_id = $_POST['ed_id'];

        $valid = true;

        if ($valid) {
            $pdo = Database::connect();
            $sql = "INSERT INTO PROYECTOV1(p_nombre,d_contraseña,ed_id) VALUES(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Nombre,$Contraseña, $ed_id));
            Database::disconnect();
            header("Location: ../HTML/LoginProyecto.html");
            exit(); // se debe incluir un exit() después de una redirección con header()
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

        <title>Proyecto</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/FormsStructure.css">
    </head>
    <body>
        
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" >
            <ul>
                <li>
                    <a href="../HTML/LoginUsuarios.html">Regresar</a>
                </li>
            </ul>
        </header>

        <main>

            

            <div class="Card-1">
                
                <a class="Btns Btn-1" href="../PHP/LoginProyecto.php">Inicio Sesion</a>
                <a class="Btns Btn-2" href="../PHP/RegistroProyecto.php">Registro</a>
                
                <form class="Form__Card" action="../PHP/RegistroProyecto.php" method="POST">

                    <table>
    
                        <tr>
                            <td><label for="Nombre">Nombre</label></td>
                            <td><input type="text" name="Nombre" class="Text__Input" id="Nombre"></td>
                        </tr>
    
                        <tr>
                            <td><label for="Contraseña">Contraseña</label></td>
                            <td><input type="password" name="Contraseña" class="Text__Input" id="ApellidoPaterno"></td>
                        </tr>
    
                        <tr>
                            <td colspan="2" class="Td__Registrar" ><input class="Btn__Registrar" type="submit" value="Registrar" id="submit" name="submit"></td>
                            <td></td>
                        </tr>
    
                    </table>
    
                </form>
            </div>            

        </main>

        <footer>
            <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo Tec">
        </footer>

    </body>
</html>