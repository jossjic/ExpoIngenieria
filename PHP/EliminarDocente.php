<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    
    $correo = null;
	if (!empty($_GET['id'])) {
		
        $correo = $_REQUEST['id'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM PROYECTO_DOCENTE WHERE p_id = ? AND co_correo";
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['id'],$correo));
		Database::disconnect();
		header("Location: AdministradorProyecto.php");
		exit();

	} else {
        header("Location: AdministradorProyecto.php");
        exit();
    }
?>