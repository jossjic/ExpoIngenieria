<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../media/favicon.ico">
  <title>Admin Usuarios</title>

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
              <li><a href="#">Estadísticas</a></li>
          </ul>
      </nav>
  </header>

	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Admin Usuarios</h3>
    		</div>

				<div class="row">
					<p>
						<a href="../PHP/registroUsuarios.php" class="btn btn-success">Registrar Usuario</a>
					</p>

					<table class="table table-striped table-bordered">
	            <thead>
	                <tr>
	                	<th>Nombre	</th>
	                	<th>Apellido				</th>
                    <th>Correo				</th>
	                </tr>
	            </thead>
	            <tbody>
	              	<?php
								   	include 'database.php';
								   	$pdo = Database::connect();
								   	$sql = 'SELECT * FROM V2_DOCENTE ORDER BY d_apellido_paterno';
				 				   	foreach ($pdo->query($sql) as $row) {
											echo '<tr>';
			    					   	echo '<td>'. $row['d_nombre'] . '</td>';
			    					  	echo '<td>'. $row['d_apellido_paterno'] . '</td>';
                      					echo '<td>'. $row['d_correo'] . '</td>';
			                            //echo '<td>';    echo ($row['ac'])?"SI":"NO"; echo'</td>';
			                            echo '<td width=250>';
			    					   	echo '<a class="btn" href="readAdminUsu.php?id='.$row['d_nomina'].'">Detalles</a>';
			    					   	echo '&nbsp;';
			    					  	echo '<a class="btn btn-success" href="updateAdminUsu.php?id='.$row['d_nomina'].'">Actualizar</a>';
			    					   	echo '&nbsp;';
			    					   	echo '<a class="btn btn-danger" href="deleteAdminUsu.php?id='.$row['d_nomina'].'">Eliminar</a>';
			    					   	echo '</td>';
										  echo '</tr>';
								    }

									$sql = 'SELECT * FROM V2_JURADO ORDER BY j_apellido_paterno';
									foreach ($pdo->query($sql) as $row) {
										echo '<tr>';
									   echo '<td>'. $row['j_nombre'] . '</td>';
									  echo '<td>'. $row['j_apellido_paterno'] . '</td>';
				  					echo '<td>'. $row['j_correo'] . '</td>';
									//echo '<td>';    echo ($row['ac'])?"SI":"NO"; echo'</td>';
									echo '<td width=250>';
									   echo '<a class="btn" href="readAdminUsu.php?id='.$row['j_id'].'">Detalles</a>';
									   echo '&nbsp;';
									  echo '<a class="btn btn-success" href="updateAdminUsu.php?id='.$row['j_id'].'">Actualizar</a>';
									   echo '&nbsp;';
									   echo '<a class="btn btn-danger" href="deleteAdminUsu.php?id='.$row['j_id'].'">Eliminar</a>';
									   echo '</td>';
									  echo '</tr>';
								}

								$sql = 'SELECT * FROM V2_ALUMNO ORDER BY a_ap_pa';
								foreach ($pdo->query($sql) as $row) {
									echo '<tr>';
								   echo '<td>'. $row['a_nombre'] . '</td>';
								  echo '<td>'. $row['a_ap_pa'] . '</td>';
			  					echo '<td>'. $row['a_correo'] . '</td>';
								//echo '<td>';    echo ($row['ac'])?"SI":"NO"; echo'</td>';
								echo '<td width=250>';
								   echo '<a class="btn" href="readAdminUsu.php?id='.$row['a_matricula'].'">Detalles</a>';
								   echo '&nbsp;';
								  echo '<a class="btn btn-success" href="updateAdminUsu.php?id='.$row['a_matricula'].'">Actualizar</a>';
								   echo '&nbsp;';
								   echo '<a class="btn btn-danger" href="deleteAdminUsu.php?id='.$row['a_matricula'].'">Eliminar</a>';
								   echo '</td>';
								  echo '</tr>';
							}


								   	Database::disconnect();
				  				?>
			    		</tbody>
		      </table>

		    </div>

	    </div> <!-- /container -->
	</body>

	
	<footer>
    <img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC">
  </footer>
</html>
