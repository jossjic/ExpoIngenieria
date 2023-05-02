<?php 
    require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    } 

    $student_name = $_POST['student_name'];
    $student_lastname = $_POST['student_lastname'];
    $student_matricula = $_POST['student_matricula'];
    $student_email = $_POST['student_email'];

    if (isset($student_email, $student_name, $student_lastname, $student_matricula)) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        try {
            // Check if the email already exists in the PROYECTO_ALUMNO table
            $sql = "SELECT a_matricula FROM PROYECTO_ALUMNO WHERE a_matricula = ? AND p_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_matricula, $_SESSION['id']]);
            $numRows = $stmt->rowCount();
    
            if ($numRows == 1) {
                // The student already exists in the project, redirect to AdministradorProyecto.php
                header("Location: ../PHP/AdministradorProyecto.php");
                exit();
            } else {
                // Check if the email already exists in the ALUMNO table
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT a_correo FROM ALUMNO WHERE a_correo = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$student_email]);
                $numRows = $stmt->rowCount();
    
                if ($numRows == 1) {
                    // The email already exists, insert it in PROYECTO_ALUMNO with the project ID
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO PROYECTO_ALUMNO(a_matricula, p_id) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$student_matricula, $_SESSION['id']]);
                } else {
                    // The email doesn't exist, insert the student data in ALUMNO and then in PROYECTO_ALUMNO
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO ALUMNO(a_matricula, a_nombre, a_apellido, a_correo) VALUES (?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$student_matricula, $student_name, $student_lastname, $student_email]);
                    
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO PROYECTO_ALUMNO(a_matricula, p_id) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$student_matricula, $_SESSION['id']]);
                }
    
                Database::disconnect();
                header("Location: ../PHP/AdministradorProyecto.php");
                exit();
            }
    
        } catch (PDOException $e) {
            // If an error occurs, rollback the transaction and show the error message
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    
    } else {
        echo "Error: No se han proporcionado todos los datos necesarios.";
    }
    
    
     


?>