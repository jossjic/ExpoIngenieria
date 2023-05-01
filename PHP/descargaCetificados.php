<?php 
    require 'database.php'
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DESCARGA CERTIFICADOS</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/galeria.css">
        
	</head>

    <header>
        <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
        <ul>
        <li>
            <a href="#">Layout Proyectos</a>
        </li>
        </ul>
        <nav>
        <ul>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
        </nav>
    </header>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h1>Descarga de reconocimientos</h1>
		   		</div>
                
                <br>
                <br>
                <h2>DOCENTE/JURADO</h2>

                <table >

                    <?php
                        $pdo = Database::connect();
                        $sql = "SELECT co_correo, co_nomina, co_nombre, co_apellido, co_es_jurado 
                                FROM COLABORADOR 
                                ORDER BY co_nombre;";
                        $q = $pdo->query($sql);
                        $filas = $q->fetchAll();
                        Database::disconnect();
                    ?>
                    <thead>
                        <tr>Correo</tr>
                        <tr>Nomina</tr>
                        <tr>Nombre</tr>
                        <tr>Apellido</tr>
                        <tr>Jurado?</tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($filas as $colaborador) { 
                        ?>

                        <td><?php echo $colaborador['co_correo'];?></td>
                        <td><?php echo $colaborador['co_nomina'];?></td>
                        <td><?php echo $colaborador['co_nombre'];?></td>
                        <td><?php echo $colaborador['co_apellido'];?></td>
                        <td><?php echo $colaborador['co_es_jurado'];?></td>
                        <td><a href="generarReconocimientoDJ.php?matricula=<?php echo $colaborador['co_correo']; ?>">Crear reconocimiento</a></td>
                        <br>
                    </tbody>

                </table>
				
			</div>
            <?php
                                     }
            ?>

            <div class="span10 offset1">
                <br>
                    <br>
                    <h2>ALUMNO</h2>

                    <table >

                        <?php
                            $pdo = Database::connect();
                            $sql = "SELECT p.p_id, p.p_nombre, e.ed_id, e.ed_nombre, a.a_matricula, a.a_nombre, a.a_apellido 
                                    FROM PROYECTO p 
                                    NATURAL JOIN CATEGORIA 
                                    NATURAL JOIN EDICION e
                                    NATURAL JOIN nivel n
                                    NATURAL JOIN proyecto_alumno pa 
                                    NATURAL JOIN alumno a 
                                    ORDER BY e.ed_id, p.p_id, a.a_apellido, a.a_nombre ASC";
                            $q = $pdo->query($sql);
                            $filas = $q->fetchAll();
                            Database::disconnect();
                        ?>
                        
                        <tbody>
                            <?php
                            //$edicion = $filas[0]["ed_id"];
                            //$proyecto = $filas[0]["p_id"];
                            $edicion = "";
                            $proyecto = "";
                            //echo "<h2>" . $filas[0]["ed_nombre"] . "</h2>";
                            //echo "<h3>" . $filas[0]["p_nombre"] . "</h3>";
                            ?>
                            <thead>
                            <tr>Matricula</tr>
                            <tr>Nombre</tr>
                            <tr>Apellido</tr>
                        </thead>
                            <?php
                            foreach ($filas as $datos) { 
                                if ($datos["ed_id"] == $edicion) {
                                    if($datos["p_id"] == $proyecto){

                                    }
                                    else
                                    {
                                        $proyecto = $datos["p_id"];
                                        echo "<h3>" . $datos["p_nombre"] . "</h3>";

                                    }
                                }
                                else
                                {
                                    $edicion = $datos["ed_id"];
                                    echo "<h2>" . $datos["ed_nombre"] . "</h2>";
                                    if($datos["p_id"] == $proyecto){

                                    }
                                    else
                                    {
                                        $proyecto = $datos["p_id"];
                                        echo "<h3>" . $datos["p_nombre"] . "</h3>"; 
                                    }
                                } 
                            ?>

                            <td><?php echo $datos['a_matricula'];?></td>
                            <td><?php echo $datos['a_nombre'];?></td>
                            <td><?php echo $datos['a_apellido'];?></td>
                            <td><a href="generarReconocimientoA.php?matricula=<?php echo $datos['a_matricula']; ?>&proyecto=<?php echo $datos['p_id']?>">Crear reconocimiento</a></td>
                            <br>
                        </tbody>

                    </table>
                    
                </div>
                <?php
                                        }
                ?>

	    </div> <!-- /container -->
        <br>
        <br>
        <a href="#">Volver</a>
	</body>
</html>


