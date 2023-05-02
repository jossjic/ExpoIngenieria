<?php
	require_once 'dataBase.php';

  session_name("EngineerXpoWeb");
  session_start();

  if (!isset($_SESSION['logged_in'])) {
      header("Location: ../index.php");
      exit();
  }

    $correo = null;
    $type = null;
	if ( !empty($_GET['correo'])||!empty($_GET['type'])) {
		$correo = $_REQUEST['correo'];
    $type = $_REQUEST['type'];
	}

    if ( $correo==null || $type==null ) {
		header("Location: ../PHP/UsuariosView.php");
	}

    if ( !empty($_POST)) {
		// keep track validation errors
		    $nombreError = null;
        $apellidoError = null;
        $correoError = null;
        $esJuradoError = null;
        $nomMatError = null;
    



		// keep track post values
		    $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $nomMat = $_POST['nomMat'];
        if (isset($_POST['esJurado'])){
          if (strtolower(trim($_POST['esJurado']))=='s') {
            $esJurado = true;
          }
          else if(strtolower(trim($_POST['esJurado']))=='n') {
            $esJurado = false;
          }
          else{
            $esJurado = null;}
        }

		/// validate input
		$valid = true;
      if ($type == 'co') {
        if (empty($nombre)) {
          $nombreError = 'Por favor ingresa un nombre';
          $valid = false; 
        }
          
              if (empty($apellido)) {
            $apellidoError = 'Por favor ingresa un apellido';
            $valid = false;
          }
      
              if (empty($correo)) {
            $correoError = 'Por favor ingresa un correo';
            $valid = false;
          }
      
      
              if (!isset($esJurado)) {
            $esJuradoError = 'Por favor ingresa un estado de jurado';
            $valid = false;
          }  
      }

      else if($type == 'al'){
        if (empty($nombre)) {
          $nombreError = 'Por favor ingresa un nombre';
          $valid = false; 
        }
          
              if (empty($apellido)) {
            $apellidoError = 'Por favor ingresa un apellido';
            $valid = false;
          }
      
              if (empty($correo)) {
            $correoError = 'Por favor ingresa un correo';
            $valid = false;
          }
      
      
              if (empty($esJurado)) {
            $esJuradoError = 'Por favor ingresa un estado de jurado';
            $valid = false;
          }  

          if (empty($nomMat)) {
            $nomMatError = 'Por favor ingresa una matricula';
            $valid = false;
          }
      }
        

		// update data
		if ($valid) {
      if ($type == 'co') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE COLABORADOR SET co_nombre = ?, co_apellido = ?, co_correo = ?, co_nomina = ?, co_es_jurado = ? WHERE co_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nombre,$apellido,$correo,$nomMat,$esJurado,$correo));
        Database::disconnect();
        echo '<script>alert("Colaborador Actualizado");</script>';
        header("Location: ../PHP/UsuariosView.php");
        exit();
      }

      else if ($type == 'al') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE ALUMNO SET a_nombre = ?, a_apellido = ?, a_correo = ?, a_matricula = ? WHERE a_correo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nombre,$apellido,$correo,$nomMat,$correo));
        Database::disconnect();
        echo '<script>alert("Alumno Actualizado");</script>';
        header("Location: ../PHP/UsuariosView.php");
        exit();
      }
    
     
	}
}
	else {
    if ($type=='co'){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM COLABORADOR WHERE co_correo = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($correo));
      $data = $q->fetch(PDO::FETCH_ASSOC);
          $nombre = $data['co_nombre'];
          $apellido = $data['co_apellido'];
          $correo = $data['co_correo'];
          $nomMat = $data['co_nomina'];
          $esJurado = $data['co_es_jurado'];
      Database::disconnect();
    }

    if ($type=='al'){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM ALUMNO WHERE a_correo = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($correo));
      $data = $q->fetch(PDO::FETCH_ASSOC);
      $nombre = $data['a_nombre'];
      $apellido = $data['a_apellido'];
      $correo = $data['a_correo'];
      $nomMat = $data['a_matricula'];
        
      Database::disconnect();
    }
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    <title>Usuarios Update</title>

    <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
    <link rel="stylesheet" href="../CSS/FormsStructure.css">
    <link rel="stylesheet" href="../CSS/Extra.css">

</head>
<body>

        <header>
			<a href="../index.php"
				><img
					class="Logo__Expo"
					src="../media/logo-expo.svg"
					alt="Logotipo de Expo ingenierías"
			/></a>
			<ul style="grid-column: 2/4">
				<li><a href="../PHP/AdminInicio.php">Menu</a></li>
				<li><a href="../PHP/AvisosView.php">Avisos</a></li>
				<li><a href="../PHP/EdicionView.php">Ediciones</a></li>
				<li><a href="../PHP/NivelView.php">Nivel</a></li>
				<li><a href="../PHP/CategoriasView.php">Categorias</a></li>
				<li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
				<li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
				<li><a href="../PHP/AdministradoresView.php">Administradores</a></li>
				<li><a href="../PHP/EvaluacionesView.php">Evaluaciones</a></li>
				<li style="font-weight: 600;">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

        <main>

            <h1>Actualizar</h1>

            <form class="form-horizontal" action="UsuariosUpdate.php?correo=<?php echo $correo; ?>&type=<?php echo $type; ?>" method="post">


                <table>
                  <?php
                  if ($type=='co'){
                    echo '
                    <tr>
                    <td>
                        <label for="">Nombre</label>
                    </td>
  
                    <td>
                        <input class="Text__Input" name="nombre" type="text"  placeholder="" value='.(!empty($nombre)?$nombre:"").'>
                        '; 
                        
                    if (!empty($nombreError)){
                        echo '<span class="help-inline">'.$nombreError.'</span>';
                    }
                    echo '
                    </td>
                </tr>';
  
                echo '
                <tr>
                <td>
                    <label for="">Apellido</label>
                </td>

                <td>
                    <input class="Text__Input" name="apellido" type="text"  placeholder="" value='.(!empty($apellido)?$apellido:"").'>
                    ';

                if (!empty($apellidoError)){
                    echo '<span class="help-inline">'.$apellidoError.'</span>';
                }
                echo '
                </td>
            </tr>';

            echo '
                <tr>
                <td>
                    <label for="">Correo</label>
                </td>

                <td>
                    <input class="Text__Input" name="correo" type="text"  placeholder="" value='.(!empty($correo)?$correo:"").'>
                    ';

                if (!empty($correoError)){
                    echo '<span class="help-inline">'.$correoError.'</span>';
                }
                echo '
                </td>
            </tr>';

            echo '
                <tr>
                <td>
                    <label for="">Nomina</label>
                </td>

                <td>
                    <input class="Text__Input" name="nomMat" type="text"  placeholder="" value='.(!empty($nomMat)?$nomMat:"").'>
                    ';


                    echo '<span class="help-inline">Si no introduce o no le aparece una nomina, el colaborador será guardado como externo</span>';

                echo '
                </td>
            </tr>';

            echo '
            <tr>
            <td>
                <label for="">Es jurado? (S/N)</label>
            </td>

            <td>
                <input class="Text__Input" name="esJurado" type="text"  placeholder="" value='.((isset($esJurado))?(($esJurado)?("S"):("N")):"").'>
                ';


                if (!empty($esJuradoError)){
                  echo '<span class="help-inline">'.$esJuradoError.'</span>';
              }

            echo '
            </td>
        </tr>';



            


                  }

                  if ($type=='al'){
                    echo '
                    <tr>
                    <td>
                        <label for="">Nombre</label>
                    </td>
  
                    <td>
                        <input class="Text__Input" name="nombre" type="text"  placeholder="" value='.(!empty($nombre)?$nombre:"").'>
                        '; 
                        
                    if (!empty($nombreError)){
                        echo '<span class="help-inline">'.$nombreError.'</span>';
                    }
                    echo '
                    </td>
                </tr>';
  
                echo '
                <tr>
                <td>
                    <label for="">Apellido</label>
                </td>

                <td>
                    <input class="Text__Input" name="apellido" type="text"  placeholder="" value='.(!empty($apellido)?$apellido:"").'>
                    ';

                if (!empty($apellidoError)){
                    echo '<span class="help-inline">'.$apellidoError.'</span>';
                }
                echo '
                </td>
            </tr>';

            echo '
                <tr>
                <td>
                    <label for="">Correo</label>
                </td>

                <td>
                    <input class="Text__Input" name="correo" type="text"  placeholder="" value='.(!empty($correo)?$correo:"").'>
                    ';

                if (!empty($correoError)){
                    echo '<span class="help-inline">'.$correoError.'</span>';
                }
                echo '
                </td>
            </tr>';

            echo '
                <tr>
                <td>
                    <label for="">Matricula</label>
                </td>

                <td>
                    <input class="Text__Input" name="correo" type="text"  placeholder="" value='.(!empty($nomMat)?$nomMat:"").'>
                    ';

                if (!empty($nomMatError)){
                    echo '<span class="help-inline">'.$nomMatError.'</span>';
                }
                echo '
                </td>
            </tr>';
                  }
                  

                  ?>
                    


                    <tr>
                        <td>
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Usuario" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="UsuariosView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

</main>

</body>
</html>
