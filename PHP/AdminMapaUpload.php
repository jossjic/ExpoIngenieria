<?php
	
	require_once 'dataBase.php';
	session_name("EngineerXpoWeb");
    session_start();

	$URL = $_POST['url'];
	$URL_Error = null;

	$valid = true;

	if (!empty($_POST)){
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE MAPA SET m_url = ?, WHERE m_id =  1 ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL));
			Database::disconnect();
			header("Location: ../PHP/AdministradorProyecto.php");
			exit();
		}
	}

?>