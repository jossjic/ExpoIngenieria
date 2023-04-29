<?php 
    require_once 'dataBase.php';
    session_name("EngineerXpoWeb");
    session_start();

    if (isset($_POST['teacher_email'])) {
        $teacher_email = $_POST['teacher_email'];
    
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO PROYECTO_DOCENTE (p_id, co_correo) VALUES (?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id'], $teacher_email));
        Database::disconnect(); 
        header("Location: ../PHP/AdministradorProyecto.php");
        exit();
    }  


?>