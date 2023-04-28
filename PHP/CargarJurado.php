<?php
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
                // Insertar en la tabla COLABORADOR
                $co_correo = $data[0];
                $co_nomina = $data[1];
                $co_nombre = $data[2];
                $co_apellido = $data[3];
                $co_pass = $data[4];
                $co_es_jurado = ($data[5] === "1") ? 1 : 0;
                
                /*$sql = "INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado)
                        VALUES ('$co_correo', '$co_nomina', '$co_nombre', '$co_apellido', '$co_pass', '$co_es_jurado')";
                $conn->query($sql);*/
    
                // Obtener el ID de la edición
                $ed_nombre = $data[6];
                /*$sql = "SELECT ed_id FROM EDICION WHERE ed_nombre = '$ed_nombre'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $ed_id = $row["ed_id"];*/
    
                // Insertar en la tabla EDICION_COLABORADOR
                /*$sql = "INSERT INTO EDICION_COLABORADOR (ed_id, co_correo)
                        VALUES ('$ed_id', '$co_correo')";
                $conn->query($sql);*/

                echo $co_correo. " " .$co_nomina. " " .$co_nombre. " " .$co_apellido. " " .$co_pass. " " .$co_es_jurado. " " .$ed_nombre ."\n";
            }
            fclose($file);
    
            echo "Archivo cargado exitosamente.";
        } else {
            echo "El archivo debe ser un CSV.";
        }
    }
?>