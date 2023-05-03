<?php 
    require 'dataBase.php'
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
                        $sql = "SELECT COLABORADOR.co_correo, COLABORADOR.co_nomina, COLABORADOR.co_nombre, COLABORADOR.co_apellido, COLABORADOR.co_es_jurado FROM COLABORADOR ORDER BY COLABORADOR.co_nombre";
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
                            $sql = "SELECT proyecto.p_id, proyecto.p_nombre, edicion.ed_id, edicion.ed_nombre, alumno.a_matricula, alumno.a_nombre, alumno.a_apellido, alumno.a_correo FROM `proyecto` JOIN categoria ON proyecto.ca_id = categoria.ca_id JOIN edicion ON proyecto.ed_id = edicion.ed_id JOIN nivel ON proyecto.n_id = nivel.n_id JOIN proyecto_alumno ON proyecto.p_id = proyecto_alumno.p_id JOIN alumno ON proyecto_alumno.a_correo = alumno.a_correo ORDER BY edicion.ed_id,proyecto.p_id,alumno.a_apellido,alumno.a_nombre ASC;";
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
                            <td><?php echo $datos['a_correo'];?></td>
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


