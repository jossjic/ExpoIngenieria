<?php 
    require_once 'dataBase.php';

    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM EDICION ORDER BY ed_id DESC LIMIT 1";
	$q = $pdo->query($sql);
	$edicion = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();

    $pdo = Database::connect();
    // Obtener los proyectos y los profesores, y Jurado
    $sql = "SELECT * FROM PROYECTO NATURAL JOIN EDICION WHERE ed_id = ?";
    $proyectos = $pdo->prepare($sql); 
    $proyectos->execute(array($edicion['ed_id']));
    $proyectoscount = $proyectos->rowCount();

    $proyectos = $proyectos->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM COLABORADOR NARTUAL JOIN EDICION COLABORADOR WHERE co_es_jurado = true AND ed_id = ?";
    $jueces = $pdo->prepare($sql);
    $jueces->execute(array($edicion['ed_id']));
    $juecescount = $jueces->rowCount();

    $jueces = $jueces->fetchAll(PDO::FETCH_ASSOC);

    Database::disconnect();

    $totalJuecesProyecto = $proyectoscount/$juecescount;

    foreach ($proyectos as $proyecto) {
        echo $proyecto['p_nombre']."\n";
    }

    foreach ($jueces as $juez) {
        echo $juez['co_nombre']."\n";
    }

    echo $totalJuecesProyecto;

?>

