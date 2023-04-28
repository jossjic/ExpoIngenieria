<?php
    if(isset($_FILES["file"])){
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];

    // procesa el archivo aquí
    echo $file_name;
    echo $file_type;
    echo $file_size;
    echo $file_tmp_name;
    
    }
?>