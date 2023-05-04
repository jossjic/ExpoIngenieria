<?php 
    require_once 'dataBase.php';

    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM EDICION ORDER BY ed_id DESC LIMIT 1";
	$q = $pdo->query($sql);
	$edicion = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();

    echo $edicion['ed_id']

?>

