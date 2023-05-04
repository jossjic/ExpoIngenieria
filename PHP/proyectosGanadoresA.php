<?php 
    require 'dataBase.php'
?>

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
        <title>PROYECTOS GANADORES</title>

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
                <br>
                    <br>
                    <h2>PROYECTOS GANADORES</h2>
                    <br>
                    <br>
                    <table >

                        <?php
                            $pdo = Database::connect();
                            //$sql = "SELECT PROYECTO.p_id, PROYECTO.p_nombre, EDICION.ed_id, EDICION.ed_nombre, ALUMNO.a_matricula, ALUMNO.a_nombre, ALUMNO.a_apellido, ALUMNO.a_correo FROM PROYECTO JOIN CATEGORIA ON PROYECTO.ca_id = CATEGORIA.ca_id JOIN EDICION ON PROYECTO.ed_id = EDICION.ed_id JOIN NIVEL ON PROYECTO.n_id = NIVEL.n_id JOIN PROYECTO_ALUMNO ON PROYECTO.p_id = PROYECTO_ALUMNO.p_id JOIN ALUMNO ON PROYECTO_ALUMNO.a_correo = ALUMNO.a_correo ORDER BY EDICION.ed_id,PROYECTO.p_id,ALUMNO.a_apellido,ALUMNO.a_nombre ASC;";
                            $sql = "SELECT ALL (EVALUACION.ev_criterio_1 + EVALUACION.ev_criterio_2 + EVALUACION.ev_criterio_3 + EVALUACION.ev_criterio_4 + EVALUACION.ev_criterio_5) AS maximo, evaluacion.p_id, proyecto.p_id, proyecto.p_nombre, categoria.ca_nombre, edicion.ed_nombre, PROYECTO.ed_id, PROYECTO.ca_id, PROYECTO.p_descripcion FROM EVALUACION JOIN PROYECTO ON PROYECTO.p_id = EVALUACION.p_id JOIN CATEGORIA ON PROYECTO.ca_id = CATEGORIA.ca_id JOIN EDICION ON PROYECTO.ed_id = EDICION.ed_id ORDER BY PROYECTO.ed_id ASC, CATEGORIA.ca_nombre ASC, maximo DESC;";
                            $q = $pdo->query($sql);
                            $filas = $q->fetchAll();
                            //var_dump($filas);
                            Database::disconnect();
                        ?>
                        
                        <tbody>
                            <?php
                            //$edicion = $filas[0]["ed_id"];
                            //$proyecto = $filas[0]["p_id"];
                            $edicion = "";
                            $categoria = "";
                            $proyecto = "";
                            $total = "";
                            //echo "<h2>" . $filas[0]["ed_nombre"] . "</h2>";
                            //echo "<h3>" . $filas[0]["p_nombre"] . "</h3>";
                            ?>
                            <thead>
                            
                        </thead>
                            <?php
                            foreach ($filas as $datos) {
                                $cadena = "<td>{$datos['p_id']}</td>
                            <td>{$datos['p_nombre']}</td>
                            <td>{$datos['p_descripcion']}</td>
                            <td>{$datos['maximo']}</td>
                            <br>" ;
                            $link = '<a href="generarReconocimientoG.php?proyecto=' . $datos['p_id'] . '">Crear reconocimiento</a>';
                                if ($datos["ed_id"] == $edicion) {
                                    if($datos["ca_id"] == $categoria){

                                        if ($total == $datos["maximo"]){
                                            $total = $datos["maximo"];
                                            echo $cadena;
                                            echo $link;
                                        }
                                        else {
                                            //proyectos no son max misma categoria y periodo
                                            echo $cadena;
                                        }
                                    }
                                    else
                                    {
                                        $categoria = $datos["ca_id"];
                                        echo "<h3>" . $datos["ca_nombre"] . "</h3>";
                                        $total = $datos["maximo"];
                                        echo $cadena;
                                        echo $link;
                                    }
                                }
                                else
                                {
                                    $edicion = $datos["ed_id"];
                                    echo "<h2>" . $datos["ed_nombre"] . "</h2>";
                                    if($datos["ca_id"] == $categoria){

                                    }
                                    else
                                    {
                                        $categoria = $datos["ca_id"];
                                        echo "<h3>" . $datos["ca_nombre"] . "</h3>";
                                        $total = $datos["maximo"];
                                        echo $cadena;
                                        echo $link;
                                    }
                                }  
                            ?>

                        </tbody>

                    </table>
                    
                </div>
                <?php
                $total = $datos["maximo"];
                                        }
                ?>

	    </div> <!-- /container -->
        <br>
        <br>
        <a href="#">Volver</a>
	</body>
</html>
