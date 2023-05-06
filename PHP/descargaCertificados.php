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
                            $sql = "SELECT PROYECTO.p_id, PROYECTO.p_nombre, EDICION.ed_id, EDICION.ed_nombre, ALUMNO.a_matricula, ALUMNO.a_nombre, ALUMNO.a_apellido, ALUMNO.a_correo FROM PROYECTO JOIN CATEGORIA ON PROYECTO.ca_id = CATEGORIA.ca_id JOIN EDICION ON PROYECTO.ed_id = EDICION.ed_id JOIN NIVEL ON PROYECTO.n_id = NIVEL.n_id JOIN PROYECTO_ALUMNO ON PROYECTO.p_id = PROYECTO_ALUMNO.p_id JOIN ALUMNO ON PROYECTO_ALUMNO.a_correo = ALUMNO.a_correo ORDER BY EDICION.ed_id,PROYECTO.p_id,ALUMNO.a_apellido,ALUMNO.a_nombre ASC;";
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
        <a href="AdminInicio.php">Volver</a>
	</body>
</html>
