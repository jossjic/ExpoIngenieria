<?php 
    require_once 'dataBase.php';
    session_name("EngineerXpoWeb");
    session_start();


    if (isset($_POST['student_name']) AND isset($_POST['student_email'])) {
        $student_name = $_POST['student_name'];
        $student_lastname = $_POST['student_lastname'];
        $student_matricula = $_POST['student_matricula'];
        $student_email = $_POST['student_email'];

        #Revisar si el correo del alumno no existe en la tabla ALUMNO
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT a_correo FROM ALUMNO WHERE a_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($student_email));
        $numRows = $q->rowCount();
        Database::disconnect();

        #Revisar si el correo del alumno no existe en la tabla ALUMNO
        if ($numRows == 1) {
            #Insertar el correo del alumno en la tabla ProyectoAlumno
            #con el id del proyecto
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO PROYECTO_ALUMNO(a_correo, p_id) VALUES (?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($student_email, $_SESSION['id']));
            Database::disconnect();

            header("Location: ../PHP/AdministradorProyecto.php");
            exit();
            
        } else {
            #Insertar el nombre completo y correo en la tabla ALUMNO
            #Insertar el correo del alumno en la tabla del ProyectoAlumno 
            #con el id del proyecto
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO ALUMNO(a_matricula,a_nombre,a_apellido,a_correo) VALUES(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($student_matricula,$student_name,$student_lastname,$student_email));

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO PROYECTO_ALUMNO (a_correo, p_id) VALUES (?, ?)";
            $q = $pdo->prepare($sql);
            $pdo = $q->execute(array($_SESSION['id'], $student_email));
            Database::disconnect();

            header("Location: ../PHP/AdministradorProyecto.php");
            exit();


        }
    } 


?>