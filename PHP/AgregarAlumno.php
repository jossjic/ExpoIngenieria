<?php 
    require_once 'dataBase.php';
    session_name("EngineerXpoWeb");
    session_start();


    if (isset($_POST['student_name']) AND isset($_POST['student_email']) AND isset($_POST['student_matricula']) AND isset($_POST['student_lastname']) ) {
        $student_name = $_POST['student_name'];
        $student_lastname = $_POST['student_lastname'];
        $student_matricula = $_POST['student_matricula'];
        $student_email = $_POST['student_email'];

        echo $student_matricula,$student_email,$student_lastname,$student_name;

        #Revisar si el correo del alumno no existe en la tabla ALUMNO
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT a_correo FROM ALUMNO WHERE a_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($student_email));
        $numRows = $q->rowCount();
        echo $numRows;
        Database::disconnect();

        echo "Aqui";
        #Revisar si el correo del alumno no existe en la tabla ALUMNO
        if ($numRows >= 1) {
            echo "Aqui1";
            #Insertar el correo del alumno en la tabla ProyectoAlumno
            #con el id del proyecto
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO PROYECTO_ALUMNO(a_correo, p_id) VALUES (?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($student_email, $_SESSION['id']));
            echo $q;
            Database::disconnect();
            
            echo "Registro en la tabla Proyecto Alumno";

        } else {
            try {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO ALUMNO(a_matricula,a_nombre,a_apellido,a_correo) VALUES(?,?,?,?);";
                echo $sql;
                echo "Hola";
                $q = $pdo->prepare($sql);
                echo $q;
                $q->execute(array($student_matricula,$student_name,$student_lastname,$student_email));
                echo $q;
                echo "Registro en la tabla Alumno";
            
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO PROYECTO_ALUMNO (a_correo, p_id) VALUES (?, ?)";
                $q = $pdo->prepare($sql);
                $pdo = $q->execute(array( $student_email,$_SESSION['id']));
            
                echo $q;
                echo "Registro en la tabla Proyecto Alumno";
                Database::disconnect();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            
            


        }
    } 


?>