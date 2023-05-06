<?php 
	require_once 'dataBase.php';

  session_name("EngineerXpoWeb");
  session_start();

  if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
      header("Location: ../index.php");
      exit();
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
  

  <link rel="icon" type="image/x-icon" href="../media/favicon.ico">
  <title>Ver Usuario</title>

  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/Extra.css">
  <!-- <link rel="stylesheet" href="../CSS/AdminPages.css"> -->

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
				<li><a href="../PHP/CategoriaView.php">Categorias</a></li>
				<li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
				<li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
				<li><a href="../PHP/AdministradoresView.php">Administradores</a></li>
				<li><a href="../PHP/EvaluacionesView.php">Evaluaciones</a></li>
				<li style="font-weight: 600;">
					<a href="../PHP/logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</header>

<main class="Size-1">
  <?php
  $pdo = Database::connect();
  $correo=$_GET['correo'];
  $type=$_GET['type'];

  if($type=='co'){
    $sql = "SELECT * FROM COLABORADOR WHERE co_correo=?";
    $res = $pdo->prepare($sql);
    $res->execute(array($correo));
    $info = $res->fetch(PDO::FETCH_ASSOC);

    if ($info['co_nomina']!=NULL){
      if($info['co_es_jurado']){
        $sql =  "SELECT ed.ed_id, ed.ed_nombre FROM EDICION_COLABORADOR NATURAL JOIN EDICION as ed WHERE co_correo=?";
        $queryed = $pdo->prepare($sql);
        $queryed->execute(array($correo));
       $infoed = $queryed->fetchAll(PDO::FETCH_OBJ);

       $sql =  "SELECT p.p_id, p.p_nombre_clave, p.p_estado FROM PROYECTO_DOCENTE NATURAL JOIN PROYECTO as p WHERE co_correo=?";
        $querypa = $pdo->prepare($sql);
       $querypa->execute(array($correo));
       $infopa = $querypa->fetchAll(PDO::FETCH_OBJ);

       $sql =  "SELECT p.p_id, p.p_nombre_clave, p.p_estado FROM PROYECTO_JURADO NATURAL JOIN PROYECTO as p WHERE co_correo=?";
        $querypc = $pdo->prepare($sql);
       $querypc->execute(array($correo));
       $infopc = $querypc->fetchAll(PDO::FETCH_OBJ);
        echo '<h1>Detalles del Profesor</h1>
        <br>
        
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['co_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['co_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['co_correo'].'</td>
          </tr>
          <tr>
            <td>Nómina: </td>
            <td>'.$info['co_nomina'].'</td>
          </tr>
          <tr>
            <td>Jurado: </td>
            <td>✔</td>
          </tr>
        </table>
        <br>
        ';

        echo '<h2>Ediciones</h2>
        <br>
        ';
        if($queryed -> rowCount() > 0){
          foreach($infoed as $row){
            echo '
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->ed_id.'</td>
              </tr>
              <tr>
                <td>Nombre: </td>
                <td>'.$row->ed_nombre.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo "ERROR: No hay ediciones asociadas a este usuario";
        }

        echo '<h2>Proyectos Asignados</h2>
        <br>
        ';
        if($querypa -> rowCount() > 0){
          foreach($infopa as $row){
            echo '
            
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->p_id.'</td>
              </tr>
              <tr>
                <td>Nombre Clave: </td>
                <td>'.$row->p_nombre_clave.'</td>
              </tr>
              <tr>
                <td>Estado: </td>
                <td>'.$row->p_estado.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo 'No hay proyectos asociados a este usuario';
        }

            echo '<h2>Proyectos para Calificar</h2>
        <br>
        ';
        if($querypc -> rowCount() > 0){
          foreach($infopc as $row){
            echo '
            
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->p_id.'</td>
              </tr>
              <tr>
                <td>Nombre Clave: </td>
                <td>'.$row->p_nombre_clave.'</td>
              </tr>
              <tr>
                <td>Estado: </td>
                <td>'.$row->p_estado.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo 'No hay proyectos asociados a este usuario';
        }

        echo '<div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';

      }
      else{
        $sql =  "SELECT ed.ed_id, ed.ed_nombre FROM EDICION_COLABORADOR NATURAL JOIN EDICION as ed WHERE co_correo=?";
        $queryed = $pdo->prepare($sql);
        $queryed->execute(array($correo));
       $infoed = $queryed->fetchAll(PDO::FETCH_OBJ);

       $sql =  "SELECT p.p_id, p.p_nombre_clave, p.p_estado FROM PROYECTO_DOCENTE NATURAL JOIN PROYECTO as p WHERE co_correo=?";
        $querypa = $pdo->prepare($sql);
        $querypa->execute(array($correo));
       $infopa = $querypa->fetchAll(PDO::FETCH_OBJ);
        echo '<h1>Detalles del Profesor</h1>
        <br>
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['co_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['co_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['co_correo'].'</td>
          </tr>
          <tr>
            <td>Nómina: </td>
            <td>'.$info['co_nomina'].'</td>
          </tr>
          <tr>
            <td>Jurado: </td>
            <td>❌</td>
          </tr>
        </table>
        <br>';
        echo '<h2>Ediciones</h2>
        <br>
        ';
        if($queryed -> rowCount() > 0){
          foreach($infoed as $row){
            echo '
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->ed_id.'</td>
              </tr>
              <tr>
                <td>Nombre: </td>
                <td>'.$row->ed_nombre.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        } else{
          echo "ERROR: No hay ediciones asociadas a este usuario";
        }

        echo '<h2>Proyectos Asignados</h2>
        <br>
        ';
        if($querypa -> rowCount() > 0){
          foreach($infopa as $row){
            echo '
            
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->p_id.'</td>
              </tr>
              <tr>
                <td>Nombre Clave: </td>
                <td>'.$row->p_nombre_clave.'</td>
              </tr>
              <tr>
                <td>Estado: </td>
                <td>'.$row->p_estado.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo 'No hay proyectos asociados a este usuario';
        }


        echo '<div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';
      }
    }

    else{
      if($info['co_es_jurado']){
        $sql =  "SELECT ed.ed_id, ed.ed_nombre FROM EDICION_COLABORADOR NATURAL JOIN EDICION as ed WHERE co_correo=?";
        $queryed = $pdo->prepare($sql);
        $queryed->execute(array($correo));
       $infoed = $queryed->fetchAll(PDO::FETCH_OBJ);

       $sql =  "SELECT p.p_id, p.p_nombre_clave, p.p_estado FROM PROYECTO_JURADO NATURAL JOIN PROYECTO as p WHERE co_correo=?";
        $querypc = $pdo->prepare($sql);
        $querypc->execute(array($correo));
       $infopc = $querypc->fetchAll(PDO::FETCH_OBJ);


        echo '<h1>Detalles del Externo</h1>
        <br>
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['co_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['co_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['co_correo'].'</td>
          </tr>
          <tr>
            <td>Jurado: </td>
            <td>✔</td>
          </tr>
        </table>
        <br>';
        echo '<h2>Ediciones</h2>
        <br>
        ';
        if($queryed -> rowCount() > 0){
          foreach($infoed as $row){
            echo '
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->ed_id.'</td>
              </tr>
              <tr>
                <td>Nombre: </td>
                <td>'.$row->ed_nombre.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo "ERROR: No hay ediciones asociadas a este usuario";
        }
        
        echo '<h2>Proyectos para Calificar</h2>
        <br>
        ';
        if($querypc -> rowCount() > 0){
          foreach($infopc as $row){
            echo '
            
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->p_id.'</td>
              </tr>
              <tr>
                <td>Nombre Clave: </td>
                <td>'.$row->p_nombre_clave.'</td>
              </tr>
              <tr>
                <td>Estado: </td>
                <td>'.$row->p_estado.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo 'No hay proyectos asociados a este usuario';
        }
        echo '<div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';
      }
      else{
        $sql =  "SELECT ed.ed_id, ed.ed_nombre FROM EDICION_COLABORADOR NATURAL JOIN EDICION as ed WHERE co_correo=?";
        $queryed = $pdo->prepare($sql);
        $queryed->execute(array($correo));
       $infoed = $queryed->fetchAll(PDO::FETCH_OBJ);
        echo '<h1>Detalles del Externo</h1>
        <br>
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['co_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['co_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['co_correo'].'</td>
          </tr>
          <tr>
            <td>Jurado: </td>
            <td>❌</td>
          </tr>
        </table>
        <br>';

        echo '<h2>Ediciones</h2> <br>';
        if($queryed -> rowCount() > 0){
          foreach($infoed as $row){
            echo '
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->ed_id.'</td>
              </tr>
              <tr>
                <td>Nombre: </td>
                <td>'.$row->ed_nombre.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo "ERROR: No hay ediciones asociadas a este usuario";
        }
        echo '<div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';
      }
    }
  }

  elseif ($type=='al') {
    $sql = "SELECT * FROM ALUMNO WHERE a_correo=?";
    $query = $pdo->prepare($sql);
    $query->execute(array($correo));
    $info = $query->fetch(PDO::FETCH_ASSOC);

    $sql =  "SELECT p.p_id, p.p_nombre_clave, p.p_estado
    FROM PROYECTO_ALUMNO AS pa
    JOIN PROYECTO AS p ON pa.p_id = p.p_id
    WHERE pa.a_correo = ?
    ";
    $querypa = $pdo->prepare($sql);
    $querypa->execute(array($correo));
   $infopa = $querypa->fetchAll(PDO::FETCH_OBJ);
    echo '<h1>Detalles del Alumno</h1>
        <br>
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['a_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['a_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['a_correo'].'</td>
          </tr>
          <tr>
            <td>Matricula: </td>
            <td>'.$info['a_matricula'].'</td>
          </tr>
        </table>
        <br>
        ';

        echo '<h2>Proyectos</h2><br>';
        if($querypa -> rowCount() > 0){
          foreach($infopa as $row){
            echo '
            
            <table>
              <tr>
                <td>ID: </td>
                <td>'.$row->p_id.'</td>
              </tr>
              <tr>
                <td>Nombre Clave: </td>
                <td>'.$row->p_nombre_clave.'</td>
              </tr>
              <tr>
                <td>Estado: </td>
                <td>'.$row->p_estado.'</td>
              </tr>
              </table>
              <br>
            ';
          }
        }
        else{
          echo 'No hay proyectos asociados a este usuario';
        }

        

        echo '<div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';

  }

  elseif ($type=='adm') {
    $sql = "SELECT * FROM ADMIN WHERE adm_correo=?";
    $query = $pdo->prepare($sql);
    $res->execute(array($correo));
    $info = $res->fetch(PDO::FETCH_ASSOC);
    echo '<h1>Detalles del Administrador</h1>
        <br>
        <table>
          <tr>
            <td>Nombre: </td>
            <td>'.$info['adm_nombre'].'</td>
          </tr>
          <tr>
            <td>Apellido: </td>
            <td>'.$info['adm_apellido'].'</td>
          </tr>
          <tr>
            <td>Correo: </td>
            <td>'.$info['adm_correo'].'</td>
          </tr>
        </table>
        <div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
        ';
  }

  else{
    echo '<h1>Hubo un error en la consulta de tipo de usuario</h1>
    <br>
    <div class="Btn-Ancla"> <a href="../PHP/UsuariosView.php">Regresar</a></div>
    ';
  }

  Database::disconnect();
  ?>
  
</main>
</html>
