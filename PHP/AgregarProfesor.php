<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "project") {
        header("Location: ../index.php");
        exit();
    } 

    if (isset($_POST['teacher_email'])) {
        $teacher_email = $_POST['teacher_email'];
        $p_id = $_SESSION['id'];
    
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Verificar si el docente ya está registrado en la tabla PROYECTO_DOCENTE con el mismo p_id
        $sql = "SELECT COUNT(*) as count FROM PROYECTO_DOCENTE WHERE p_id = ? AND co_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($p_id, $teacher_email));
        $data = $q->fetch(PDO::FETCH_ASSOC);
    
        if ($data['count'] > 0) {
            // El docente ya está registrado en el proyecto, mostrar mensaje de error
            echo "El docente ya está registrado en el proyecto";
            header("Location: ../PHP/AdministradorProyecto.php");
            exit();
        } else {
            // El docente no está registrado en el proyecto, realizar la inserción en la tabla PROYECTO_DOCENTE
            $sql = "INSERT INTO PROYECTO_DOCENTE (p_id, co_correo) VALUES (?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($p_id, $teacher_email));
            Database::disconnect(); 
            header("Location: ../PHP/AdministradorProyecto.php");
            exit();
        }
    }
     


?>