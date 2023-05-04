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

    $sql = "SELECT * FROM COLABORADOR NATURAL JOIN EDICION_COLABORADOR WHERE co_es_jurado = true AND ed_id = ?";
    $jueces = $pdo->prepare($sql);
    $jueces->execute(array($edicion['ed_id']));
    $juecescount = $jueces->rowCount();

    $jueces = $jueces->fetchAll(PDO::FETCH_ASSOC);

    Database::disconnect();

    $totalJuecesProyecto = floor($proyectoscount/$juecescount);

    if ($totalJuecesProyecto < 4) {
        $totalJuecesProyecto = 2;
    }

    foreach ($proyectos as $project) {
        
        $judge_keys = array_rand($jueces, $totalJuecesProyecto);
        foreach ($judge_keys as $judge) {

            //Buscar existencia del juez y proyecto asociado
            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTO_DOCENTE WHERE co_correo = ? AND p_id = ?";
            $insertion = $pdo->prepare($sql);
            $insertion->execute(array($jueces[$judge]['co_correo'],$project['p_id']));
            $HayDocente = $insertion->rowCount();
            Database::disconnect();

            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTO_JURADO WHERE co_correo = ? AND p_id = ?";
            $insertion = $pdo->prepare($sql);
            $insertion->execute(array($jueces[$judge]['co_correo'],$project['p_id']));
            $HayJurado = $insertion->rowCount();
            Database::disconnect();

            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTO_JURADO WHERE p_id = ?";
            $insertion = $pdo->prepare($sql);
            $insertion->execute(array($project['p_id']));
            $NoMas = $insertion->rowCount();
            Database::disconnect();

            if ($HayDocente == 0 && $HayJurado == 0 && $NoMas < $totalJuecesProyecto){
                $pdo = Database::connect();
                $sql = "INSERT INTO PROYECTO_JURADO(co_correo,p_id) VALUES(?,?)";
                $insertion = $pdo->prepare($sql);
                $insertion->execute(array($jueces[$judge]['co_correo'],$project['p_id']));
                Database::disconnect();
            }
            
        }
            
    }

    echo $totalJuecesProyecto;
    echo $proyectoscount;
    echo $juecescount;

?>

