<?php
    require_once "dataBase.php";

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
        exit();
    }

    // GET METHOD
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $pdo = Database::connect();

        // Project
        $sql = "SELECT * FROM PROYECTO WHERE p_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        $project = $q->fetch(PDO::FETCH_ASSOC);
        
        // Students
        $sql = "SELECT *
                FROM ALUMNO
                NATURAL JOIN PROYECTO_ALUMNO
                WHERE p_id = ? 
                ORDER BY a_apellido";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        $students = $q->fetchAll();
        $number_of_students = $q->rowCount();

        Database::disconnect();

        if (1 == 2) {

            // guardar el url completo y que el regex se haga al renderizar

            // Regex for Google Drive video
            $str = 'https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing';
            if (preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $str, $match) == 1) {
                $video_id = $match[1];
            }
            $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
            echo $video_full_link;

            // Regex for Google Drive image
            $str = 'https://drive.google.com/file/d/1_YeOir5f72U8WrprQfbxhPWwt2VLGatb/view?usp=sharing';
            if (preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $str, $match) == 1) {
                $image_id = $match[1];
            }
            $image_full_link = "https://drive.google.com/uc?export=view&id=".$image_id;
            echo $image_full_link;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/ico" href="../media/favicon.ico" />
		<title>Gestionar proyecto | Expo ingenierías</title>
		<link rel="stylesheet" href="../CSS/HeaderFooterStructure.css" />
		<link rel="stylesheet" href="../CSS/Page5.css" />
	</head>
	<body>
		<header>
		    <a href="../index.php"><img class="Logo__Expo" src="../media/logo-expo.svg" alt="Logotipo de Expo ingenierías"></a>
		    <ul>
		        <li><a href="../index.php">Inicio</a></li>
		        <li><a href="#">Layout de proyectos</a></li>
		    </ul>
		    <nav>
		        <ul>
		            <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
		        </ul>
		    </nav>
		</header>
		<aside>
			<h1>Gestiona la información de tu proyecto</h1>
			<div action="" class="Upload__Video">
				<?php
				    if ($project['p_video'] != null) {
				        preg_match('/^https:\/\/drive.google.com\/file\/d\/(.*?)\/view\?usp=sharing/', $project['p_video'], $match);
				        $video_id = $match[1];
				        $video_full_link = "https://drive.google.com/file/d/".$video_id."/preview";
				        echo '<iframe width="100%" height="90%" src="'.$video_full_link.'"></iframe>';
				    }
				?>
				<button
					class="btn-submit"
					type="button"
					onclick="showVideoLinkInput()"
				>
					Agregar Video
				</button>
			</div>

			<div action="" class="Upload__Poster">
				<iframe
					width="100%"
					height="600px"
					src="https://www.youtube.com/embed/QJT6MBNycMw"
				></iframe>

				<button
					class="btn-submit"
					type="button"
					onclick="showPosterLinkInput()"
				>
					Agregar Video
				</button>
			</div>
		</aside>

		<!-- Ventana emergente para ingresar el enlace del video -->
		<div id="video-link-modal" class="modal-video">
			<div class="modal-content">
				<span class="close close-video">&times;</span>
				<h2>Ingresa el enlace del video</h2>
				<form onsubmit="saveVideoLink(event)">
					<input
						type="url"
						name="url"
						id="url-video"
						placeholder="https://example.com"
						pattern="https://.*"
						size="50"
						required
					/>
					<button type="submit">Guardar</button>
				</form>
			</div>
		</div>

		<!-- Ventana emergente para ingresar el enlace al poster -->
		<div id="poster-link-modal" class="modal-poster">
			<div class="modal-content">
				<span class="close close-poster">&times;</span>
				<h2>Ingresa el enlace del video</h2>
				<form onsubmit="savePosterLink(event)">
					<input
						type="url"
						name="url"
						id="url-poster"
						placeholder="https://example.com"
						pattern="https://.*"
						size="50"
						required
					/>
					<button type="submit">Guardar</button>
				</form>
			</div>
		</div>

		<main>
			<form class="First__Form" action="" method="post">
				<table style="text-align: center">
					<tr>
						<th>
							<label for="project_public_name">
								Nombre público del proyecto
							</label>
						</th>
						<th>
							<label for="category">Categoría</label>
						</th>
						<th>
							<label for="status">Avance</label>
						</th>
						<th></th>
					</tr>
					<tr>
						<td>
							<input
								type="text"
								name="project_public_name"
								id="project_public_name"
								value="<?php echo !empty($project_public_name) ? $project_public_name : ''; ?>"
							/>
						</td>
						<td>
							<select name="category" id="category">
								<option value="cyber">Cyber</option>
								<option value="nexus">Nexus</option>
								<option value="bio">Bio</option>
								<option value="nano">Nano</option>
							</select>
						</td>
						<td>
							<select name="status" id="status">
								<option value="not-started">No iniciado</option>
								<option value="in-progress">En progreso</option>
								<option value="completed">Completado</option>
							</select>
						</td>
						<td>
							<input type="submit" value="Guardar" />
						</td>
					</tr>
				</table>

				<div>
					<label for="project_description"
						>Descripción del Proyecto</label
					>
					<textarea
						class="input"
						name="project_description"
						id="project_description"
						cols="30"
						rows="10"
					></textarea>
				</div>
			</form>

			<div class="Second__Form">
				<div>
					<button
						id="add_student_btn"
						onclick="showStudentFieldInput()"
					>
						Agregar Alumno
					</button>
					<button
						id="add_teacher_btn"
						onclick="showTeacherFieldInput()"
					>
						Agregar Profesor
					</button>
				</div>
				<div class="students_div">
					<h3>Alumnos</h3>
					<div class="students_div_menu">
						<div class="students_div_menu_eachone">
							<span class="nombrecompleto">
								Juanito Perez Dominguez
							</span>
							<span class="matricula"> A0000000 </span>
							<span class="correo"> A0000000@tec.mx </span>
						</div>
					</div>
				</div>
				<div class="teachers_div">
					<h3>Profesores</h3>
					<div class="teachers_div_menu">
						<div class="teachers_div_menu_eachone">
							<span class="nombrecompleto">
								Juanito Perez Dominguez
							</span>
							<span class="correo"> A0000000@tec.mx </span>
						</div>
					</div>
				</div>
			</div>
		</main>

		<!-- Ventana emergente para ingresar el estudiante -->
		<div id="estudiante-data-modal" class="modal-estudiante">
			<div class="modal-content">
				<span class="close close-estudiante">&times;</span>
				<h2>Agregar Alumno</h2>
				<form action="" id="student_form">
					<label for="student_id">Matrícula:</label>
					<input type="text" id="student_id" name="student_id" />
					<br /><br />
					<label for="student_name">Nombre Completo:</label>
					<input type="text" id="student_name" name="student_name" />
					<br /><br />
					<label for="student_email">Correo Electrónico:</label>
					<input
						type="email"
						id="student_email"
						name="student_email"
					/>
					<br /><br />
					<input type="submit" value="Guardar" />
				</form>
			</div>
		</div>

		<!-- Ventana emergente para ingresar el estudiante -->
		<div id="docente-data-modal" class="modal-docente">
			<div class="modal-content">
				<span class="close close-docente">&times;</span>
				<h2>Agregar Profesor</h2>
				<form action="" id="teacher_form">
					<label for="teacher_email">Correo Electrónico:</label>
					<select name="teacher_email" id="teacher_email">
						<!--PHP CODE-->
					</select>
					<br /><br />
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
