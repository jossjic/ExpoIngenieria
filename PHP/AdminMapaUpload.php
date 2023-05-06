<?php	
	require_once 'dataBase.php';
	
	session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
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
			$sql = "INSERT INTO MAPA(m_url) VALUES(?) ";
			$q = $pdo->prepare($sql);
			$q->execute(array($URL));
			Database::disconnect();
			header("Location: ../PHP/MapaProyectos.php");
			exit();
		}
	}

?>