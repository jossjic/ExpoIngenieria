<?php
	require 'dataBase.php';

	session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    } 


	if ( $_SESSION['id']==null) {
		header("Location: ../PHP/DashboardProyecto.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM PROYECTO WHERE p_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['id']));
		$data = $q->fetch(PDO::FETCH_ASSOC);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "SELECT * FROM CATEGORIA";
    	$q = $pdo->prepare($sql);
    	$q->execute();
    	$categorias = $q->fetchAll(PDO::FETCH_ASSOC);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "SELECT * FROM NIVEL";
    	$q = $pdo->prepare($sql);
    	$q->execute();
    	$nivel = $q->fetchAll(PDO::FETCH_ASSOC);
		Database::disconnect();
	}


?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/ico" href="../media/favicon.ico" />

		<title>Administrador de Proyecto</title>

		<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css" />
		<link rel="stylesheet" href="../CSS/Page5.css" />
		<link rel="stylesheet" href="../CSS/Extra.css" />
	</head>
	<body>
		<header>
            <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="#">Mapa de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

		<aside class="card">
			<h1>
				Bienvenido <br />
				de nuevo!
			</h1>

			<div class="Upload__Video">
				<iframe
					width="100%"
					height="90%"
					<?php 

						preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $data['p_video'], $match);
                        $video_id = $match[1];
                        $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
                        echo 'src="'.$video_full_link.'" title="YouTube video player" frameborder="0" allow="accelerometer"; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share allowfullscreen';
					?>
					
				></iframe>

				<button
					class="btn-submit"
					type="button"
					onclick="showVideoLinkInput()"
				>
					Agregar Video
				</button>
			</div>

			<div class="Upload__Poster">
				<iframe
					width="100%"
					height="600px"
					<?php
                            preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $data['p_poster'], $match);
                            $image_id = $match[1];
                            $image_full_link = "https://drive.google.com/file/d/".$image_id."/preview";
                            echo 'src="'.$image_full_link.'" allow="autoplay"';
                    ?>
				></iframe>

				<button
					class="btn-submit"
					type="button"
					onclick="showPosterLinkInput()"
				>
					Agregar Poster
				</button>
			</div>
		</aside>

		<!-- Ventana emergente para ingresar el enlace del video -->
		<div id="video-link-modal" class="modal-video">
			<div class="modal-content">
				<span class="close close-video">&times;</span>
				<h2>Ingresa el enlace del video</h2>
				<p>1. Asegurate de que el video lo compartas desde Google Drive <br>
				   2. Cuando pegues el link del video compartido desde google drive debe tener el siguiente pattern:  <br>
				   https://drive.google.com/file/d/.../view?usp=sharing</p>
				<form action="../PHP/EnlaceVideo.php" method="post" >
					<input
						type="url"
						name="url"
						id="url-video"
						placeholder="https://example.com"
						pattern="^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing$"
						size="50"
						required
					/>
					<input type="submit" value="Guardar">
				</form>
			</div>
		</div>

		<!-- Ventana emergente para ingresar el enlace al poster -->
		<div id="poster-link-modal" class="modal-poster">
			<div class="modal-content">
				<span class="close close-poster">&times;</span>
				<h2>Ingresa el enlace del poster en formato PDF</h2>
				<p>1. Asegurate de que el poster lo compartas desde Google Drive <br>
				   2. Cuando pegues el link del poster compartido desde google drive debe tener el siguiente pattern:  <br>
				   https://drive.google.com/file/d/.../view?usp=sharing</p>
				<form action="../PHP/EnlacePoster.php" method="post">
					<input
						type="url"
						name="url"
						id="url-poster"
						placeholder="https://example.com"
						pattern="^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing$"
						size="50"
						required
					/>
					<input type="submit" value="Guardar">
				</form>
			</div>
		</div>

		<main style="padding: 0;">
			<form class="First__Form card" style="width: 90%;" action="../PHP/InfoProyecto.php" method="POST">
				<table class="table-1">
					<tr>
						<td>
							<label for="project_name">
								Nombre del Proyecto
							</label>
						</td>
					</tr>
					<tr>
						
						<td>
								<input
									type="text"
									name="project_name"
									id="project_name"
									required
									<?php echo "value='".$data['p_nombre']."'" ?>
								/>
						</td>
						
						
					</tr>

					<tr>
						<td>
							<label for="category"> Categoría </label>
						</td>
					</tr>
					<tr>
					
						<td>
							<select name="category" id="category" required>
								<?php 
									foreach ($categorias as $row) {
										if ($row['ca_id'] == $data['ca_id']) {
											echo "<option value='".$row['ca_id']."' selected>".$row['ca_nombre']."</option>";
										} else {
											echo "<option value='".$row['ca_id']."'>".$row['ca_nombre']."</option>";
										}
									}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							<label for="status">Avance</label>
						</td>
					</tr>

					<tr>
						<td>
							<select name="level" id="level" required>
								<?php 
									foreach ($nivel as $row) {
										if ($row['n_id'] == $data['n_id']) {
											echo "<option value='".$row['n_id']."' selected>".$row['n_nombre']."</option>";
										} else {
											echo "<option value='".$row['n_id']."'>".$row['n_nombre']."</option>";
										}
										
									}
								?>
							</select>
						</td>
						
					</tr>
					<tr>
						<td colspan="2">

							<input type="submit" class="btn-submit" value="Guardar" />

						</td>
						<td>
						
							
						
						</td>
					</tr>
				</table>
				<table style="text-align: center" class="table-2">
					<tr>
						<td>
							<textarea
								class="input card"
								name="project_description"
								id="project_description"
								cols="30"
								rows="10"
								required
								style="display: inline; width: 100%; height: 100%; resize: none;"
							> <?php echo	$data['p_descripcion'] ?>
							</textarea>
						</td>
					</tr>
				</table>
			</form>

			<div class="Second__Form">
				<div class="Add_People cardBtn">
					<button
						id="add_student_btn"
						onclick="showStudentFieldInput()"
						class="btn-submit"
					>
						Agregar Alumno
					</button>
					<button
						id="add_teacher_btn"
						onclick="showTeacherFieldInput()"
						class="btn-submit"
					>
						Agregar Profesor
					</button>
				</div>
				<div class="students_div card">
					<h3>Alumnos</h3>
					<div class="students_div_menu">
								<?php 
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT * FROM PROYECTO_ALUMNO NATURAL JOIN ALUMNO WHERE p_id = ?";
									$q = $pdo->prepare($sql);
									$q->execute(array($_SESSION['id']));
									$dataAlumno = $q->fetchAll(PDO::FETCH_ASSOC);
									foreach ($dataAlumno as $row) {
										echo " 
										<div class='students_div_menu_eachone'>
											<span class='nombrecompleto'>".$row['a_nombre']. " ".$row['a_apellido']."</span>
											<span class='correo'>".$row['a_correo']."</span>
											<span style='color: black;' class='close'><a href='../PHP/EliminarAlumno.php?correo=".trim($row['a_correo'])."&id=".$_SESSION['id']."'</a>&times;</a></span>
										</div>
											";
									}
								?>

					</div>
				</div>
				<div class="teachers_div card">
					<h3>Profesores</h3>
					<div class="teachers_div_menu">
								<?php  
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT * FROM PROYECTO_DOCENTE NATURAL JOIN COLABORADOR WHERE p_id = ?";
									$q = $pdo->prepare($sql);
									$q->execute(array($_SESSION['id']));
									$dataProfesor = $q->fetchAll(PDO::FETCH_ASSOC);
									foreach ($dataProfesor as $row) {
										echo " 
												<div class='teachers_div_menu_eachone'>
													<span class='nombrecompleto'>".$row['co_nombre']. " ".$row['co_apellido']."</span>
													<span class='correo'>".$row['co_correo']."</span>
													<span style='color: black;' class='close'><a href='../PHP/EliminarDocente.php?correo=".trim($row['co_correo'])."&id=".$_SESSION['id']."'>&times;</a></span>
												</div>
											";
									}
								?> 
						
					</div>
				</div>
			</div>
		</main>

		<!-- Ventana emergente para ingresar el estudiante -->
		<div id="estudiante-data-modal" class="modal-estudiante">
			<div class="modal-content">
				<span class="close close-estudiante">&times;</span>
				<h2>Agregar Alumno</h2>
				<form action="../PHP/AgregarAlumno.php" method="post" id="student_form">
					<br><br>
					<label for="student_name">Nombre</label>
					<input type="text" id="student_name" name="student_name" required/>
					<br><br>
					<label for="student_lastname">Apellidos</label>
					<input type="text" id="student_lastname" name="student_lastname" required/>
					<br><br>
					<label for="student_matricula">Matricula</label>
					<input type="text" id="student_matricula" name="student_matricula" required />
					<br><br>
					<label for="student_email">Correo Electrónico:</label>
					<input
						type="email"
						id="student_email"
						name="student_email"
						required
						pattern="^[^@]+@tec\.mx$"
					/>
					<br><br>
					<input type="submit" value="Guardar"/>
				</form>
			</div>
		</div>

		<!-- Ventana emergente para ingresar un docente -->
		<div id="docente-data-modal" class="modal-docente">
			<div class="modal-content">
				<span class="close close-docente">&times;</span>
				<h2>Agregar Profesor</h2>
				<form action="../PHP/AgregarProfesor.php" id="teacher_form" method="POST">
					<label for="teacher_email">Correo Electrónico:</label>
					<select name="teacher_email" id="teacher_email">
						<?php 
							$pdo = Database::connect();
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM COLABORADOR";
							$q = $pdo->prepare($sql);
							$q->execute();
							$dataProyecto = $q->fetchAll(PDO::FETCH_ASSOC);
							foreach ($dataProyecto as $row) {
								echo "<option value='" .$row['co_correo']. "'> ".$row['co_nombre']. " " .$row['co_apellido']. "-" .$row['co_correo']. " </option>";
							}
							Database::disconnect();
						?>
					</select>
					<br/><br />
					<input type="submit" value="Guardar" />
				</form>
			</div>
		</div>

		<footer>
			<img class="Logo__Tec" src="../media/LogoTec.png" alt="Logo TEC" />
		</footer>
		
		<script src="../JS/AdministradorProyectos.js"></script>
	</body>
</html>