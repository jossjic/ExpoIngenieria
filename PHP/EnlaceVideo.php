<?php
	
	require_once 'dataBase.php';
	session_name("EngineerXpoWeb");
    session_start();

	$URL = $_POST['url'];
	$URL_Error = null;

	echo "$URL";
	echo $_SESSION['id'];

	$valid = true;

	if (!empty($_POST)){
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTO SET p_video = ? WHERE p_id =  ? ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL,$_SESSION['id']));
			Database::disconnect();
			header("Location: ../PHP/DashboardProyecto.php");
			exit();
		}
	}

?>