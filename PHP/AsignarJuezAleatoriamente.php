<?php 
    require_once 'dataBase.php';

    $conexion = Database::connect();
    // Obtener los proyectos y los profesores, y Jurado
    $proyectos = $conexion->query("SELECT * FROM PROYECTOS")->fetchAll(PDO::FETCH_ASSOC);
    $jueces = $conexion->query("SELECT * FROM COLABORADORES WHERE co_es_jurado = true")->fetchAll(PDO::FETCH_ASSOC);
    $totalJuecesProyecto = $proyectos/$jueces;

    // Crear un array vacío para los jueces asignados
    $jueces_asignados = array();

    // Recorrer cada proyecto
    foreach ($proyectos as $proyecto) {
        // Obtener los profesores que no están asociados con este proyecto
        $jueces_disponibles = array_filter($jueces, function ($jueces) use ($proyecto) {
            return $jueces['co_correo'] !== $jueces['profesor_1'] &&
                $jueces['co_correo'] !== $jueces['profesor_2'] &&
                $jueces['co_correo'] !== $proyecto['profesor_3'] &&
                $jueces['co_correo'] !== $proyecto['profesor_4'];
        });

        // Mezclar los profesores de forma aleatoria
        shuffle($profesores_disponibles);

        // Asignar los primeros 4 profesores aleatorios como jueces
        $jueces_asignados[$proyecto['id']] = array_slice($profesores_disponibles, 0, 4);
    }

    // Mostrar los jueces asignados para cada proyecto
    foreach ($jueces_asignados as $proyecto_id => $jueces) {
        echo "Jueces asignados al proyecto $proyecto_id: ";
        foreach ($jueces as $juez) {
            echo $juez['nombre'] . ", ";
        }
        echo "<br>";
    }
?>