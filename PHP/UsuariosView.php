<?php
    require 'dataBase.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Usuarios</title>
  <link rel="icon" type="image/ico" href="../media/favicon.ico"/>
  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/AdminPages.css">
</head>
<body>

  <header>
      <img class="Logo__EscNegCie" src="../media/logo-expo.svg" alt="Logo__EscNegCie">
      <ul>
          <li>
              <a href="#">Cerrar Sesion</a>
          </li>
      </ul>
      <nav>
          <ul>
          <li><a href="../PHP/ProyectosView.php">Proyectos</a></li>
              <li><a href="../PHP/UsuariosView.php">Usuarios</a></li>
              <li><a href="../PHP/ReconocimientosView.php">Reconocimientos</a></li>
              <li><a href="../PHP/EstadisticasView.php">Estadísticas</a></li>
          </ul>
      </nav>
  </header>

  <main>
        <div class="Admin__Start">
            <div class="Admin__Start__Left">
                <h1>Administrador de Usuarios</h1>
                <table>
                    <tr>
                        <td>Total de Usuarios:</td>
                        <td id="TotalUsuarios">
                        <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM COLABORADOR";
                                $q1 = $pdo->query($sql)->rowCount();
                                $sql = "SELECT * FROM ALUMNO";
                                $q2 = $pdo->query($sql)->rowCount();
                                $sql = "SELECT * FROM ADMIN";
                                $q3 = $pdo->query($sql)->rowCount();
                                $a=$q1+$q2+$q3;
                                echo "$a";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jurados:</td>
                        <td id="TotalJurados">
                        <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM COLABORADOR WHERE co_es_jurado = true";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Profesores:</td>
                        <td id="TotalProfes">
                        <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM COLABORADOR WHERE co_nomina IS NOT NULL";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Alumnos:</td>
                        <td id="TotalAlumnos">
                        <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM ALUMNO";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Admins:</td>
                        <td id="TotalAdmins">
                        <?php
                                $pdo = Database::connect();
                                $sql = "SELECT * FROM ADMIN";
                                $q = $pdo->query($sql)->rowCount();
                                echo "$q";
                                Database::disconnect();
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="Estadisticas__Btn">
                <a cglass="Admin__Start__Right__Btn" href="../PHP/EstadisticasUsuarios.php">Estadisticas Usuarios</a>
            </div>
        </div>

        <form action="../PHP/UsuariosBusqueda.php" method="post" class="Winners__Explorer">
            <table>
                <tr>
                    <td>
                        Buscar
                    </td>
                    <td>
                        <select name="UserID" id="UserID">
                            <option value="Nomina/Matrícula">Nomina/Matrícula</option>
                            <option value="Tipo">Tipo</option>
                            <option value="Nombre">Nombre</option>
                            <option value="Apellido">Apellido</option>
                            <option value="Correo">Correo</option>
                        </select>
                    </td>
                    <td>
                        
                        <input type="search" name="inp" class="Text__Search" id="" placeholder="Ingresa el valor">
                        <input type="submit" name="BtnBuscar" class="Search__Btn" id="" value="Buscar">
                        
                    </td>
                    
                </tr>
              </table>
        </form>
       <?php
            if(isset($_GET['verif'])){
                $verif = $_GET['verif'];
            }
       ?>
        <script>
            if(<?php echo $verif;?>){
                alert("El usuario ha sido eliminado exitosamente")
            }
            else if (!<?php echo $verif;?>){
                alert("Hubo un error al eliminar el usuario")
            }
            else {
                //ola
            }
        </script>

        <div class="Info">
            <div class="Info__Header">
               <p>&nbsp;</p>
                <!-- <p></p> -->
                <p>Nomina/Matrícula</p>
                <p>Tipo</p>
                <p>Nombre</p>
                <p>Apellido</p>
                <p>Correo</p>
                <p>Acciones</p>
             </div>
                <div class="Info__Table">
                  
                <?php
								   	$pdo = Database::connect();
								   	$sql = 'SELECT * FROM COLABORADOR ORDER BY co_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                        /*echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';

                                    
                                        if ($row['co_es_jurado'] == 1 && $row['co_nomina']!=NULL) {
                                            echo '<p>'. $row['co_nomina'] . '</p>';
                                            echo '<p>Jurado Profesor</p>';}
                                        else if ($row['co_es_jurado']==0 && $row['co_nomina']!=NULL) {
                                            echo '<p>'. $row['co_nomina'] . '</p>';
                                            echo '<p>Profesor</p>';}
                                        else if ($row['co_es_jurado']==1 && $row['co_nomina']==NULL) {
                                            echo '<p>N/A</p>';
                                            echo '<p>Jurado Externo</p>';}
                                        else {
                                            echo '<p>N/A</p>';
                                            echo '<p>Externo</p>';}
                                            echo '<p>'. $row['co_nombre'] . '</>';
                                            echo '<p>'. $row['co_apellido'] . '</p>';
                                            echo '<p>'. $row['co_correo'] . '</p>';
                                
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green" > <a href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a></div>';
                                        
								    }
								   	
				  				?>
                                 <?php

								   
								   	$sql = 'SELECT * FROM ALUMNO ORDER BY a_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';

                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
			    					   	echo '<p>'. $row['a_nombre'] . '</>';
			    					  	echo '<p>'. $row['a_apellido'] . '</p>';
                      					echo '<p>'. $row['a_correo'] . '</p>';
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                        
								    }
								   	Database::disconnect();
				  				?>
                                <?php

								   
								   	$sql = 'SELECT * FROM ADMIN ORDER BY adm_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p>N/A</p>';
                                        echo '<p>Administrador</p>';
			    					   	echo '<p>'. $row['adm_nombre'] . '</>';
			    					  	echo '<p>'. $row['adm_apellido'] . '</p>';
                      					echo '<p>'. $row['adm_correo'] . '</p>';
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['adm_correo'].'&type=adm">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['adm_correo'].'&type=adm">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['adm_correo'].'&type=adm">Eliminar</a></div>';
                                        
								    }
								   	Database::disconnect();
				  				?>
            
            </div>
        </div>
                                        
     

  </main>

  
</body>
</html>