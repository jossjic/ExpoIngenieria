<?php
	require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "project") {
	    header("Location: ../index.php");
	    exit();
	}

	$URL = $_POST['url'];
	$URL_Error = null;

	$valid = true;

	if (!empty($_POST)){
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTO SET p_video = ?, p_ult_modif = NOW() WHERE p_id =  ? ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL,$_SESSION['id'],));
			Database::disconnect();
			header("Location: ../PHP/AdministradorProyecto.php");
			exit();
		}
		echo "NO";
	}

?>