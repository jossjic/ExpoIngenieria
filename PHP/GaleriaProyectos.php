<?php
    require "dataBase.php";

    // GET METHOD
        // guardar el url completo y que el regex se haga al renderizar

        // Regex for Google Drive video
        $str = 'https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing';
        if (preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $str, $match) == 1) {
            $video_id = $match[1];
        }
        $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
        echo $video_full_link;

        // Regex for Google Drive image
        $str = 'https://drive.google.com/file/d/1_YeOir5f72U8WrprQfbxhPWwt2VLGatb/view?usp=sharing';
        if (preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $str, $match) == 1) {
            $image_id = $match[1];
        }
        $image_full_link = "https://drive.google.com/uc?export=view&id=".$image_id;
        echo $image_full_link;
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería</title>

  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/galeria.css">
  <style>
      .oculto {
          display: none;
      }
  </style>
</head>

<body>

  <header>
    <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
    <ul>
      <li>
        <a href="#">Layout Proyectos</a>
      </li>
    </ul>
    <nav>
      <ul>
        <li><a href="#">Cerrar Sesión</a></li>
      </ul>
    </nav>
  </header>
  <div>
  <?php       $pdo = Database::connect();
                                    $sql = "SELECT PROYECTO.p_id, PROYECTO.p_nombre, PROYECTO.p_descripcion, PROYECTO.p_estado, PROYECTO.p_video, PROYECTO.p_poster, CATEGORIA.ca_nombre, EDICION.ed_nombre, NIVEL.n_nombre, ALUMNO.a_nombre, ALUMNO.a_apellido FROM PROYECTO JOIN CATEGORIA ON PROYECTO.ca_id = CATEGORIA.ca_id JOIN EDICION ON PROYECTO.ed_id = EDICION.ed_id JOIN NIVEL ON PROYECTO.n_id = NIVEL.n_id JOIN PROYECTO_ALUMNO ON PROYECTO.p_id = PROYECTO_ALUMNO.p_id JOIN ALUMNO ON PROYECTO_ALUMNO.a_correo = ALUMNO.a_correo ORDER BY PROYECTO.p_nombre;";
                                    $q = $pdo->query($sql);
                                    //var_dump($q);
                                    $filas = $q->fetchAll();
                                    //var_dump($filas);
                                    Database::disconnect();
                                    ?>
    <table>
      <tr>
        <td class="especial">Buscar por nombre</td>
        <td>
          <select name="bus" id="bus"> 
          <option value="todos"></option>
              <?php 
          for ($i = 0; $i < count($filas); $i++) {
          ?>
            <option value="p<?php echo $filas[$i]['p_id']?>"><?php echo $filas[$i]['p_nombre']?></option>
            <?php }?>
          </select>
        </td>
      </tr>
 

    </table>
  </div>


  <div class="main">
   <?php
                                     foreach ($filas as $proyecto) {

                                     
                                    ?>
    <div class="proyecto" id = "p<?php echo $proyecto['p_id'] ?>">
        
      <table class="pro">
        <tr>
          <td>
            <p class="categoria">Nombre</p>
            <p><?php echo $proyecto['p_nombre']; ?></p>
            <p>&nbsp;</p>
            <p class="categoria">Categoria</p>
            <p><?php echo $proyecto['ca_nombre']; ?></p>
            <p>&nbsp;</p>
            <p class="categoria">Avance Proyecto</p>
            <p><?php echo $proyecto['p_estado']; ?></p>

          </td>

          <td>
          <p class="categoria">Video</p>
            <div class="imagenpropatineta">
            <?php
                           preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $proyecto['p_video'], $match);
                            $video_id = $match[1];
                            $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
                               echo '<dd><iframe width="100%" src="'.$video_full_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></dd>';
                              
                        ?>
              <p><?php /*echo $proyecto['p_video']; */?></p>
            </div>
          </td>

          <td>
            <p class="categoria">Poster</p>
            
            <?php
                            preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $proyecto['p_poster'], $match);
                            $image_id = $match[1];
                            $image_full_link = "https://drive.google.com/file/d/".$image_id."/preview";
                            echo '<dd><iframe width="100%" src="'.$image_full_link.'" allow="autoplay"></iframe></dd>';
                        ?>
            <p><?//php echo $proyecto['p_poster']; ?></p>
          </td>

          <td>
            <p class="categoria">Descripción</p>
            <p><?php echo $proyecto['p_descripcion']; ?></p>

          </td>
 
          <td>
            <p class="categoria">Integrantes</p>
            <p><?php 
            //foreach($filas as $proyecto){
              $proyectos = "";
              if ($proyecto["p_id"] == $proyectos) {
              }
                else
                {
                  $proyectos = $proyecto["p_id"];
                  echo "<h3>" . $proyecto["p_nombre"] . "</h3>";
                }
              
              echo '<dd>' .$proyecto['a_nombre'].' '.$proyecto['a_apellido']. '</dd>';
           // }
              
            ?></p>

          </td>

          <td>
            <p class="categoria">Edicion</p>
            <p><?php echo $proyecto['ed_nombre']; ?></p>
            <p>&nbsp;</p>
            <p class="categoria">Nivel</p>
            <p><?php echo $proyecto['n_nombre']; ?></p>
          </td>

        </tr>
      </table>
    </div>

    <?php
                                     }
    ?>
  </div>



  <footer>
    <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC">
  </footer>


</body>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const selectB = document.getElementById('bus');
        selectB.addEventListener("change", () => {
            let opcion = selectB.value;
            console.log(opcion);
            var proyectos = document.querySelectorAll('.proyecto');
            proyectos.forEach(element => {
                element.classList.add("oculto");
                if (opcion == "todos"){
                    element.classList.remove("oculto");
                }
            });
            document.getElementById(opcion).classList.remove("oculto");
        });
    });
</script>


</html>