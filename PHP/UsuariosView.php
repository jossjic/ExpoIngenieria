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

    
  <title>Usuarios View</title>

  <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
  <link rel="stylesheet" href="../CSS/AdminPages.css">
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

  <main class="Size">
        <div class="Admin__Start ">
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
                                $a=$q1+$q2;
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
                        <td>Docentes: </td>
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
                </table>
            </div>

            <a class="Estadisticas__Btn" href="../PHP/RegistroJurado.php">Agregar Jurado</a>

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
                            <option value="Matrícula">Matricula</option>
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

<?php
            if(isset($_GET['actu'])){
                $actu = $_GET['actu'];
            }
       ?>
        <script>
            if (<?php echo $actu;?>){
                alert(<?php echo $actu;?>);
            }
            else {
                //ola
            }
        </script>

        <div class="Info">
            <div class="Info__Header">
                <p>&nbsp;</p>
                <p></p>
                <p>Matrícula</p>
                <p>Tipo</p>
                <p>Nombre</p>
                <p>Apellido</p>
                <p>Acciones</p>
             </div>
                <div class="Info__Table">
                  
                <?php
								   	$pdo = Database::connect();
								   	$sql = 'SELECT * FROM COLABORADOR ORDER BY co_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                        /*echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
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
                                            
                                
                                        echo '<p></p>';

                                        echo '<a class="Btn__Green" href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                        echo '<a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Editar</a>';
                                        echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                        
								    }
								   	
				  				?>
                                 <?php

								   
								   	$sql = 'SELECT * FROM ALUMNO ORDER BY a_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';

                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
			    					   	echo '<p>'. $row['a_nombre'] . '</>';
			    					  	echo '<p>'. $row['a_apellido'] . '</p>';
                      					
                                        echo '<p></p>';

                                        echo '<a class="Btn__Green" href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a>';
                                        echo '<a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Editar</a>';
                                        echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a>';
                                        
                                        
								    }
								   	Database::disconnect();
				  				?>
            
            </div>
        </div>
                                        
     

  </main>

  
</body>
</html>