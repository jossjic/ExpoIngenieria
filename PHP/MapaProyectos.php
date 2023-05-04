<?php 
    require_once 'dataBase.php';

	session_name("EngineerXpoWeb");
	session_start();

	if (!isset($_SESSION['logged_in'])) {
		header("Location: ../index.php");
		exit();
	}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    <title>Mapa</title>

    <link rel="stylesheet" href="/CSS/Page3.css">
    <link rel="stylesheet" href="/CSS/HeaderFooterStructure.css">
    <script src="../JS/AdminMapa.js"></script>
</head>
<body>
    <header>
        <img class="Logo__EscNegCie" src="/media/logotec-ings.svg" alt="Logo Escuela de Negocios">
        <ul>
            <li><a href="http://" target="_blank" rel="noopener noreferrer">Inicio</a></li>
        </ul>
    </header>

    <main>
        <h1 class="First">Mapa de Proyectos</h1>

        <?php 
            if($_SESSION['user_type'] == "ADMIN"){
                echo "<button class='btn-submit' style='width: 30%;'>Subir Mapa</button>";
            }
        ?>

        <?php
        if ($Mapa['m_url'] == null) {
            echo "Sin Mapa";
        } else {
            preg_match('/^https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view\?usp=sharing$/', $Mapa['m_url'], $match);
            $Mapa_id = $match[1];
            $Mapa_Full_Link = "https://drive.google.com/file/d/".$Mapa_id."/preview";
            ?>
            <iframe
                width="100%"
                height="90%"
                src="<?php echo $Mapa_Full_Link; ?>"
                title="YouTube video player"
                frameborder="0"
                allow="autoplay;"
                allowfullscreen>
            </iframe>
            <?php
        }
        ?>
        
        <?php

            if ($_SESSION['user_type'] == "ADMIN") {
                echo '<div id="poster-link-modal" class="modal-poster">
                <div class="modal-content">
                    <span class="close close-poster" onclick="hidePosterLinkInput()">&times;</span>
                    <h2>Ingresa el enlace del archivo en formato PDF</h2>
                    <p>1. Asegurate de que el archivo sea PDF o IMG y lo compartas desde Google Drive<br>
                       2. Cuando pegues el link del poster compartido desde google drive debe tener el siguiente formato:  <br>
                       https://drive.google.com/file/d/.../view?usp=sharing</p>
                    <form action="../PHP/AdminMapaUpload.php" method="post">
                        <input
                            type="url"
                            name="url"
                            id="url-poster"
                            placeholder="https://example.com"
                            pattern="^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing$"
                            size="50"
                            required
                        />
                        <input type="submit" value="Guardar">
                    </form>
                </div>
            </div>';
                
            }

        ?>
    </main>
    
    <footer>
        <img class="Logo__Tec" src="/media/LogoTec.png" alt="Logo TEC">
    </footer>
</body>
</html>