<?php 

    
    require_once "dataBase.php";
     // //Get the last edition able
            $pdo = Database::connect();

             $sql = "SELECT * FROM EDICION ORDER BY ed_id DESC LIMIT 1";
             $q = $pdo->query($sql);
             $last_edition_id = $q->fetch(PDO::FETCH_ASSOC);

             echo $last_edition_id;

            //Insert into Edicion Colaborador with the last edition able on edition table
            // $sql = "INSERT INTO EDICION_COLABORADOR(co_correo,ed_id) VALUES(?,?)";
            //  $q = $pdo->prepare($sql);
            // $q->execute(array($collaborator['co_correo'],$last_edition_id[0]['ed_id']));

            Database::disconnect();
?>