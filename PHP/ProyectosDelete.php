<?php
require 'dataBase.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

if (!empty($_POST)) {
    // keep track post values
    $id = isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : 0;
    
    if ($id > 0) {
        // delete data
        try {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM PROYECTOV1 WHERE id_p = :id";
            $q = $pdo->prepare($sql);
            $q->bindParam(':id', $id, PDO::PARAM_INT);
            $q->execute();
            Database::disconnect();
            header("Location: ../PHP/ProyectosView.php");
            exit;
        } catch (PDOException $e) {
            echo "Error al eliminar el registro: " . $e->getMessage();
        }
    }
}

// muestra el formulario de confirmación
if ($id > 0) {
    echo "<form method='POST'>";
    echo "<p>¿Está seguro de que desea eliminar el registro $id?</p>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<button type='submit'>Eliminar</button>";
    echo "</form>";
} else {
    echo "ID inválido";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos View</title>

    <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    <link rel="stylesheet" href="../CSS/AdminPages.css">

</head>
<body>

    <header>
        <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
        <ul>
            <li>
                <a href="#">Cerrar Sesion</a>
            </li>
        </ul>
        <nav>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Reconocimientos</a></li>
                <li><a href="#">Eastadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <div class="Admin__Start">
            <div class="Admin__Start__Left">
                <h1>Administrador de Proyectos</h1>
                <table>
                    <tr>
                        <td>Total de Proyectos:</td>
                        <td id="TotalProyectos">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Calificados:</td>
                        <td id="TotalCalificados">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Pendientes:</td>
                        <td id="TotalPendientes">
                            <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM PROYECTOV1";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="Estadisticas__Btn">
                <a class="Admin__Start__Right__Btn" href="../PHP/EstadisticasUsuarios.php">Estadisticas Proyectos</a>
            </div>
        </div>

        <form method="post" class="Winners__Explorer">
            <table>
                <tr>
                    <td>
                        Buscar
                    </td>
                    <td>
                        <select name="ProyectoID" id="ProyectoID">
                            <option value="ID">ID</option>
                            <option value="Nombre">Nombre</option>
                        </select>
                    </td>
                    <td>
                        
                        <input type="search" name="BuscarNombre" class="Text__Search" id="" placeholder="Ingresa el valor">
                        <input type="submit" name="BtnBuscar" class="Search__Btn" id="" value="Buscar">
                        
                    </td>
                    
                </tr>
              </table>
        </form>

        <div class="Info">

            <div class="Name__Read">
                <?php
                    echo "<h1>Eliminar proyecto</h1>";
                ?>
            </div>
            
            <form action="../PHP/ProyectosDelete.php" method="post" class="Info__Read">
                
                <input type="hidden" name="id" value="<?php echo $id;?>"/>

                <div class="InfoRead__Atributes">
                    <p class='Danger__Alert'>Estas seguro de elimanar el proyecto</p>"
                </div>


                <div class="InfoRead__Atributes">
                    <input class="Btn__Red__Delete" type="submit" value="Si">

                    <div class='Btn__Green__Delete'>
                        <a href='../PHP/ProyectosRead.php'>No</a>
                    </div>
                </div>

            </form>
        </div>
    </main> 

</body>
</html>