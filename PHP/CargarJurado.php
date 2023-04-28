<?php
    require_once 'dataBase.php';

    if (isset($_FILES["file"])) {
        // Obtener la información del archivo
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileType = $_FILES["file"]["type"];
    
        // Verificar si el archivo es un CSV
        if ($fileType === "text/csv") {
            // Abrir el archivo CSV y leer su contenido
            $file = fopen($fileTmpName, "r");
            $headers = fgetcsv($file, 0, ",");
            while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
                //Conectar base de datos
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                // Verificar si el colaborador existe
                $co_correo = $data[0];
                $sql = "SELECT COUNT(*) FROM COLABORADOR WHERE co_correo = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$co_correo]);
                $exists = $stmt->fetchColumn();
            
                if (!$exists) {
                    // Insertar en la tabla COLABORADOR
                    $co_nomina = $data[1];
                    $co_nombre = $data[2];
                    $co_apellido = $data[3];
                    $co_pass = $data[4];
                    $co_es_jurado = ($data[5] === "1") ? 1 : 0;
                    
                    $sql = "INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$co_correo, $co_nomina, $co_nombre, $co_apellido, $co_pass, $co_es_jurado]);

                    // Obtener el ID de la edición
                    $ed_nombre = $data[6];
                    $sql = "SELECT ed_id FROM EDICION WHERE ed_nombre = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$ed_nombre]);
                    $ed_id = $stmt->fetchColumn();
                
                    // Insertar en la tabla EDICION_COLABORADOR
                    $sql = "INSERT INTO EDICION_COLABORADOR(co_corre,ed_id) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$co_correo,$ed_id]);

                } else {
                    //Revisar que exista el colaborador en la tabla con la EDICION_COLABORADOR que se quiere
                    $sql = "SELECT * FROM EDICION_COLABORADOR WHERE co_correo = ? AND ed_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$co_correo,$ed_id]);
                    $exists = $stmt->fetchColumn();

                    if (!$exists) {
                        $sql = "INSERT INTO EDICION_COLABORADOR(co_correo, ed_id) VALUES(?,?)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$co_correo,$ed_id]);
                    }
                }

                Database::disconnect();
            }
                    
            fclose($file);
    
            echo "Archivo cargado exitosamente.";
        } else {
            echo "El archivo debe ser un CSV.";
        }

    }
?>