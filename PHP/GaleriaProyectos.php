<?php
    require 'dataBase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

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
                                    $sql = "SELECT v2_proyecto.p_id, v2_proyecto.p_nombre, v2_proyecto.p_descripcion, v2_proyecto.p_avance_proyecto, v2_categoria.ca_nombre FROM `v2_proyecto` INNER JOIN v2_categoria ON v2_proyecto.ca_id = v2_categoria.ca_id ORDER BY v2_proyecto.p_nombre;";
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
            
            <p class="categoria">Avance Proyecto</p>
            <p><?php echo $proyecto['p_avance_proyecto']; ?></p>

          </td>

          <td>
            <div class="imagenpropatineta">
              <button class="btn"><img class="btn" src="../media/play.png"></button>
            </div>
          </td>

          <td>
            <p class="categoria">Poster</p>
            <img class="proimg" src="../media/poster.png">

          </td>

          <td>
            <p class="categoria">Descripción</p>
            <p><?php echo $proyecto['p_descripcion']; ?></p>

          </td>

          <td>
            <p class="categoria">Integrantes</p>
            <ul>
              <li>Victor Manuel Peréz</li>
              <li>Juan Lara</li>
              <li>Victor Rivas</li>
            </ul>

          </td>

          <td>
            <p class="categoria">UF</p>
            <p>Diseño de sistemas embebidos avanzados</p>
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