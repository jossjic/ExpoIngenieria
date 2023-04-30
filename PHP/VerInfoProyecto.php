<?php
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: AdmisionProyectos.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * 
		        FROM PROYECTO 
		        NATURAL JOIN CATEGORIA 
		        WHERE p_id = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$project = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/ico" href="../media/favicon.ico"/>

        <title><?php echo $project['p_nombre'];?> | EngineerXpoWeb</title>

        <link rel="stylesheet" href="../CSS/estructuraProyecto.css">
        <link rel="stylesheet" href="../CSS/admisionProyecto.css">
        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    </head>
    <body>
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logotipo de la Escuela de Ingeniería y Ciencias">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Layout de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="#">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main>
        	<div class="container">
    	    	<div class="top-page">
    	    		<h1>AZKABÁN</h1>
    	    		<br>
    	    		<dl>
    	    			<dt><strong>Descripción</strong></dt>
    	    			<dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id venenatis eros. Nam porttitor dolor vel nulla fermentum laoreet eu vitae.</dd>
    	    		</dl>
    	    		<br>
    	    		<dl>
    	    			<dt><strong>Autores</strong></dt>
    	    			<dd>Jeffrey Hutchinson</dd>
    	    			<dd>Ricardo Hall</dd>
    	    			<dd>Brett Wang</dd>
    	    			<dd>Karina Allison</dd>
    	    		</dl>
    	    	</div>

    		</div>
        </main>

    </body>


</html>
