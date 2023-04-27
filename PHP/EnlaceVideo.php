<?php
	
	require_once 'dataBase.php';
	session_name("EngineerXpoWeb");
    session_start();

	$id = null;

	if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
	} else {
	  // Manejar el caso en el que no se proporcionó un valor válido para el parámetro `id`
	  // por ejemplo, redirigir a una página de error o mostrar un mensaje de error al usuario
	  // y luego salir del script para evitar posibles problemas de seguridad.
		header("Location: ../PHP/DashboardProyecto.php");
		exit();
	}

	$URL = $_POST['url'];
	$URL_Error = null;

	if (!empty($_POST)){
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTO SET p_video = ? WHERE p_id =  ? ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL,$id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
			header("Location: ../PHP/DashboardProyecto.php");
			exit();
		}
	}

?>