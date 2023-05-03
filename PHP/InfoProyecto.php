<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    } 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Recuperamos los datos enviados por el formulario
		$nombre_proyecto = $_POST['project_name'];
		$descripcion_proyecto = $_POST['project_description'];
		$categoria_proyecto = $_POST['category'];
		$avance_proyecto = $_POST['level'];
	
		// Validamos que los campos no estén vacíos
		if (empty($nombre_proyecto) || empty($descripcion_proyecto) || empty($categoria_proyecto) || empty($avance_proyecto)) {
			// Mostramos un mensaje de error
			echo 'Por favor, rellena todos los campos.';
		} else {
			// Realizamos la conexión a la base de datos con PDO
			try {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
				// Preparamos la consulta para insertar el proyecto
				$stmt = $pdo->prepare("UPDATE PROYECTO SET p_nombre = :nombre, p_descripcion = :descripcion, ca_id = :categoria, n_id = :avance, p_ult_modif = NOW(), p_estado='Registrado' WHERE p_id = :id");

				// Asignamos los valores a los parámetros de la consulta
				$stmt->bindParam(':nombre', $nombre_proyecto);
				$stmt->bindParam(':descripcion', $descripcion_proyecto);
				$stmt->bindParam(':categoria', $categoria_proyecto);
				$stmt->bindParam(':avance', $avance_proyecto);
                $stmt->bindParam(':id', $_SESSION['id']);
	
				// Ejecutamos la consulta
				$stmt->execute();
            
				// Mostramos un mensaje de éxito
				echo 'El proyecto se ha guardado correctamente.';
                header("Location: ../PHP/AdministradorProyecto.php");
                exit();
                
			} catch (PDOException $e) {
				// Mostramos un mensaje de error en caso de que ocurra un error al conectarnos a la base de datos
				echo 'Error al conectarnos a la base de datos: ' . $e->getMessage();
			}
		}
	}

?>