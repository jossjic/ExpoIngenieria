<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
		<title>Admin Usuarios</title>
	</head>

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
			    					   	echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
			    					   	echo '&nbsp;';
			    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
			    					   	echo '&nbsp;';
			    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
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
									   echo '<a class="btn" href="read.php?id='.$row['j_id'].'">Detalles</a>';
									   echo '&nbsp;';
									  echo '<a class="btn btn-success" href="update.php?id='.$row['j_id'].'">Actualizar</a>';
									   echo '&nbsp;';
									   echo '<a class="btn btn-danger" href="delete.php?id='.$row['j_id'].'">Eliminar</a>';
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
								   echo '<a class="btn" href="read.php?id='.$row['a_matricula'].'">Detalles</a>';
								   echo '&nbsp;';
								  echo '<a class="btn btn-success" href="update.php?id='.$row['a_matricula'].'">Actualizar</a>';
								   echo '&nbsp;';
								   echo '<a class="btn btn-danger" href="delete.php?id='.$row['a_matricula'].'">Eliminar</a>';
								   echo '</td>';
								  echo '</tr>';
							}

							$sql = 'SELECT * FROM DOCENTEV1 ORDER BY d_apellido_paterno';
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
							   echo '<td>'. $row['d_nombre'] . '</td>';
							  echo '<td>'. $row['d_apellido_paterno'] . '</td>';
		  					echo '<td>'. $row['d_correo'] . '</td>';
							//echo '<td>';    echo ($row['ac'])?"SI":"NO"; echo'</td>';
							echo '<td width=250>';
							   echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
							   echo '&nbsp;';
							  echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
							   echo '&nbsp;';
							   echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
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
</html>
