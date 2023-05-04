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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
  <title> Usuarios View</title>

  

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
	</header>>

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
       

        <div class="Info">
            <div class="Info__Header">
                <p class="Winners__View__Column-1">&nbsp;</p>
                <p class="Winners__View__Column-6"></p>
                <p class="Winners__View__Column-2">Nómina</p>
                <p class="Winners__View__Column-3">Tipo</p>
                <p class="Winners__View__Column-4">Nombre</p>
                <p class="Winners__View__Column-5">Apellido</p>
                <p class="Winners__View__Column-7">Acciones</p>
             </div>
                <div class="Info__Table">
                  
                <?php
                                if (!empty($_POST)){ 
                                    $UserID = $_POST['UserID'];
                                    $inp = $_POST['inp'];

                                    if(trim($inp)==""){
                                        
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
                                
                                        

			    					   	echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
			    					  	echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
			    					   	echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                        
								    }
								   	
				  												   
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

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                        
								    }
								   	
								   	Database::disconnect();
				  				
                                    }

                                    if(trim($UserID) == 'Matrícula') {
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM COLABORADOR WHERE co_nomina=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));

                                         foreach ($q as $row) {
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
                                 
                                         
 
                                            echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                            echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                            echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                         
                                        }
                                        
                                    

                                        $sql = "SELECT * FROM ALUMNO WHERE a_matricula=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
                                         foreach ($q as $row) {
                                        /* echo '<input type="checkbox" name="" id="">' ;*/
                                            echo '<p></p>';
                                            echo '<p></p>';
    
                                            echo '<p>'. $row['a_matricula'] . '</p>';
                                            echo '<p>Alumno</p>';
                                            echo '<p>'. $row['a_nombre'] . '</>';
                                            echo '<p>'. $row['a_apellido'] . '</p>';
                                            echo '<p></p>';
                                            
    
                                            echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
                                            echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
                                            echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                         
                                        }

                                    if(trim($inp) == 'N/A') {
                                        $sql = 'SELECT * FROM ADMIN ORDER BY adm_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';

                                        echo '<p>N/A</p>';
                                        echo '<p>Administrador</p>';
			    					   	echo '<p>'. $row['adm_nombre'] . '</>';
			    					  	echo '<p>'. $row['adm_apellido'] . '</p>';
                      					
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['adm_correo'].'&type=adm">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['adm_correo'].'&type=adm">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['adm_correo'].'&type=adm">Eliminar</a></div>';
                                        
								    }
                                     }


                                        

                                    }
                                   
                                
                                if(trim($UserID) == 'Tipo') {
                                    $pdo = Database::connect();
                                    if(strtolower(trim($inp)) == 'jurado profesor'){
                                        $sql = "SELECT * FROM COLABORADOR ORDER BY co_apellido";


                                         foreach ($pdo->query($sql) as $row) {
                                         /*echo '<input type="checkbox" name="" id="">' ;*/
                                         if ($row['co_es_jurado'] == 1 && $row['co_nomina']!=NULL) {
                                            echo '<p></p>';
                                            echo '<p></p>';
                                            
                                            echo '<p>'. $row['co_nomina'] . '</p>';
                                            echo '<p>Jurado Profesor</p>';
                                            echo '<p>'. $row['co_nombre'] . '</>';
                                            echo '<p>'. $row['co_apellido'] . '</p>';
                                            echo '<p></p>';
                                            
                                            echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                            echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                            echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                         }
                                     }
                                        
                                    }

                                    elseif(strtolower(trim($inp)) == 'profesor'){
                                        $sql = "SELECT * FROM COLABORADOR ORDER BY co_apellido";
                                        foreach ($pdo->query($sql) as $row) {
                                            /*echo '<input type="checkbox" name="" id="">' ;*/
                                            if ($row['co_es_jurado'] == 0 && $row['co_nomina']!=NULL) {
                                               echo '<p></p>';
                                               echo '<p></p>';
                                                echo '<p>'. $row['co_nomina'] . '</p>';
                                                echo '<p>Profesor</p>';
                                                echo '<p>'. $row['co_nombre'] . '</>';
                                               echo '<p>'. $row['co_apellido'] . '</p>';
                                              
                                            echo '<p></p>';
                                               echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                              echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                               echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                            }
                                        }
                                    }

                                    elseif(strtolower(trim($inp)) == 'alumno'){

                                        $sql = "SELECT * FROM ALUMNO ORDER BY a_apellido";
                                        foreach ($pdo->query($sql) as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';

                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
                                        echo '<p>'. $row['a_nombre'] . '</>';
                                        echo '<p>'. $row['a_apellido'] . '</p>';
                                        
                                        echo '<p></p>';

                                           echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
                                          echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
                                           echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                        
                                    }
                                    }

                                    elseif(strtolower(trim($inp)) == 'administrador'||strtolower((trim($inp)) =='admin')) {
                                        $sql = 'SELECT * FROM ADMIN ORDER BY adm_apellido';
                                        foreach ($pdo->query($sql) as $row) {
                                            echo '<p></p>';
                                            echo '<p></p>';

                                        echo '<p>N/A</p>';
                                        echo '<p>Administrador</p>';
			    					   	echo '<p>'. $row['adm_nombre'] . '</>';
			    					  	echo '<p>'. $row['adm_apellido'] . '</p>';
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['adm_correo'].'&type=adm">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['adm_correo'].'&type=adm">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['adm_correo'].'&type=adm">Eliminar</a></div>';
                                        }
                                    }   

                                    else{
                                        echo '<p> No se encontraron resultados</p>';
                                    }


                                    
                                    }

                                    if(trim($UserID) == 'Nombre') {
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM COLABORADOR WHERE co_nombre=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));

                                         foreach ($q as $row) {
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
 
                                            echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                           echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                            echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                         
                                     }
                                        
                                    

                                        $sql = "SELECT * FROM ALUMNO WHERE a_nombre=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
                                         foreach ($q as $row) {
                                        /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';
 
                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
                                        echo '<p>'. $row['a_nombre'] . '</>';
                                        echo '<p>'. $row['a_apellido'] . '</p>';
                                        
                                        echo '<p></p>';
 
                                            echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
                                           echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
                                            echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                         
                                     }
                                        $sql = "SELECT * FROM ADMIN WHERE adm_nombre=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
				 				   	foreach ($q as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';
                                        echo '<p>N/A</p>';

                                        echo '<p>Administrador</p>';
			    					   	echo '<p>'. $row['adm_nombre'] . '</>';
			    					  	echo '<p>'. $row['adm_apellido'] . '</p>';
                      					
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['adm_correo'].'&type=adm">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['adm_correo'].'&type=adm">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['adm_correo'].'&type=adm">Eliminar</a></div>';
                                        
								    }
                                     



                                    }
                                    if(trim($UserID) == 'Apellido') {
                                        
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM COLABORADOR WHERE co_apellido=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));

                                         foreach ($q as $row) {
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
 
                                            echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                            echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                            echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                         
                                     }
                                        
                                    

                                        $sql = "SELECT * FROM ALUMNO WHERE a_apellido=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
                                         foreach ($q as $row) {
                                        /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';
 
                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
                                        echo '<p>'. $row['a_nombre'] . '</>';
                                        echo '<p>'. $row['a_apellido'] . '</p>';
                                           
                                        echo '<p></p>';
 
                                        echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
                                        echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
                                        echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                         
                                     }
                                        $sql = "SELECT * FROM ADMIN WHERE adm_apellido=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
				 				   	foreach ($q as $row) {
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
                                    }
                                    if(trim($UserID) == 'Correo') {
                                        
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM COLABORADOR WHERE co_correo=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));

                                         foreach ($q as $row) {
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
 
                                            echo '  <a class="Btn__Green"  href="UsuariosRead.php?correo='.$row['co_correo'].'&type=co">Ver</a>';
                                            echo '  <a class="Btn__Blue" href="UsuariosUpdate.php?correo='.$row['co_correo'].'&type=co">Actualizar</a>';
                                            echo '<a class="Btn__Red" href="UsuariosDelete.php?correo='.$row['co_correo'].'&type=co">Eliminar</a>';
                                         
                                     }
                                        
                                    

                                        $sql = "SELECT * FROM ALUMNO WHERE a_correo=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
                                         foreach ($q as $row) {
                                        /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';
 
                                        echo '<p>'. $row['a_matricula'] . '</p>';
                                        echo '<p>Alumno</p>';
                                        echo '<p>'. $row['a_nombre'] . '</>';
                                        echo '<p>'. $row['a_apellido'] . '</p>';
                                        echo '<p></p>';
 
                                        echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['a_correo'].'&type=al">Ver</a></div>';
                                        echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['a_correo'].'&type=al">Actualizar</a></div>';
                                        echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['a_correo'].'&type=al">Eliminar</a></div>';
                                         
                                     }
                                        $sql = "SELECT * FROM ADMIN WHERE adm_correo=?";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array(trim($inp)));
				 				   	foreach ($q as $row) {
                                       /* echo '<input type="checkbox" name="" id="">' ;*/
                                        echo '<p></p>';
                                        echo '<p></p>';

                                        echo '<p>N/A</p>';
                                        echo '<p>Administrador</p>';
			    					   	echo '<p>'. $row['adm_nombre'] . '</>';
			    					  	echo '<p>'. $row['adm_apellido'] . '</p>';
                      					echo '<p></p>';
                                        

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?correo='.$row['adm_correo'].'&type=adm">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?correo='.$row['adm_correo'].'&type=adm">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?correo='.$row['adm_correo'].'&type=adm">Eliminar</a></div>';
                                        
								    }
                                    }


                                        Database::disconnect();
                                    }
                                

                                    
                                
				  				
                                        ?>
                                    
				  				
            
            </div>
        </div>
    </main>

</body>
</html>