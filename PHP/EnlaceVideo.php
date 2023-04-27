<?php
	
	require_once 'dataBase.php';
	session_name("EngineerXpoWeb");
    session_start();

	$URL = $_POST['url'];
	$URL_Error = null;

	if (!empty($_POST)){
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTO SET p_video = ? WHERE p_id =  ? ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL,$_SESSION['id']));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
			header("Location: ../PHP/DashboardProyecto.php");
			exit();
		}
	}

?>