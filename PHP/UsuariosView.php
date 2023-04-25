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
      <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logo__EscNegCie">
      <ul>
          <li>
              <a href="#">Cerrar Sesion</a>
          </li>
      </ul>
      <nav>
          <ul>
              <li><a href="#">Proyectos</a></li>
              <li><a href="#">Usuarios</a></li>
              <li><a href="#">Reconocimientos</a></li>
              <li><a href="#">Eastadísticas</a></li>
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
                        <td id="TotalUsuarios">6</td>
                    </tr>
                    <tr>
                        <td>Jurados:</td>
                        <td id="TotalJurados">4</td>
                    </tr>
                    <tr>
                        <td>Profesores:</td>
                        <td id="TotalProfesores">2</td>
                    </tr>
                </table>
            </div>

            <div class="Estadisticas__Btn">
                <a cglass="Admin__Start__Right__Btn" href="../PHP/EstadisticasUsuarios.php">Estadisticas Proyectos</a>
            </div>
        </div>

        <form method="post" class="Winners__Explorer">
            <table>
                <tr>
                    <td>
                        Buscar
                    </td>
                    <td>
                        <select name="ProyectoID" id="ProyectoID">
                            <option value="ID">ID</option>
                            <option value="Nombre">Nombre</option>
                            <option value="Edicion">Edicion</option>
                            <option value="Tipo">Tipo</option>
                        </select>
                    </td>
                    <td>
                        
                        <input type="search" name="BuscarNombre" class="Text__Search" id="" placeholder="Ingresa el valor">
                        <input type="submit" name="BtnBuscar" class="Search__Btn" id="" value="Buscar">
                        
                    </td>
                    
                </tr>
              </table>
        </form>
       

        <div class="Info">
            <div class="Info__Header">
                <p>&nbsp;</p>
                <p></p>
                <p>ID</p>
                <p>Nombre</p>
                <p>Apellido Paterno</p>
                <p>Correo</p>
                <p>Acciones</p>
            </div>
            <div class="Info__Table">
                  
                <?php
								   	include 'dataBase.php';
								   	$pdo = Database::connect();
								   	$sql = 'SELECT * FROM V3_COLABORADOR ORDER BY co_apellido';
				 				   	foreach ($pdo->query($sql) as $row) {
                                        echo '<input type="checkbox" name="" id="">' ;
                                        echo '<p></p>';

                                        echo '<p>'. $row['co_nomina'] . '</p>';
			    					   	echo '<p>'. $row['co_nombre'] . '</>';
			    					  	echo '<p>'. $row['co_apellido_paterno'] . '</p>';
                      					echo '<p>'. $row['co_correo'] . '</p>';
                                        echo '<p></p>';

			    					   	echo ' <div class="Btn__Green"> <a href="UsuariosRead.php?id='.$row['d_nomina'].'">Ver</a></div>';
			    					  	echo ' <div class="Btn__Blue"> <a href="UsuariosUpdate.php?id='.$row['d_nomina'].'">Actualizar</a></div>';
			    					   	echo ' <div class="Btn__Red" ><a href="UsuariosDelete.php?id='.$row['d_nomina'].'">Eliminar</a></div>';
                                        
								    }


								$sql = 'SELECT * FROM V2_ALUMNO ORDER BY a_ap_pa';
								foreach ($pdo->query($sql) as $row) {
                                    echo '<input type="checkbox" name="" id="">' ;

                                    echo '<p>'. $row['a_matricula'] . '</p>';
								    echo '<p>'. $row['a_nombre'] . '</p>';
								    echo '<p>'. $row['a_ap_pa'] . '</p>';
			  					    echo '<p>'. $row['a_correo'] . '</p>';

								    echo ' <div class="Btn__Green"> <a href="readAdminUsu.php?id='.$row['a_matricula'].'">Ver</a></div>';
								    echo ' <div class="Btn__Blue" > <a href="updateAdminUsu.php?id='.$row['a_matricula'].'">Actualizar</a></div>';
								    echo ' <div class="Btn__Red" > <a href="deleteAdminUsu.php?id='.$row['a_matricula'].'">Eliminar</a></div>';
                                    
							}


								   	Database::disconnect();
				  				?>



            </div>
        </div>

  </main>

  
</body>
</html>