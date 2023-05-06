<?php
	require_once 'dataBase.php';

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
        header("Location: ../index.php");
        exit();
    }

    $id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

    if ( $id==null ) {
		header("Location: ../PHP/ProyectosView.php");
	}

    if ( !empty($_POST)) {
		// keep track validation errors
		$NombreError = null;
        $CategoriaError = null;
        $Nivelrror = null;
        $EstadoError = null;

		// keep track post values
		$Nombre = $_POST['Nombre'];
        $Categoria = $_POST['Categoria'];
        $Nivel = $_POST['Nivel'];
        $Estado = $_POST['Estado'];

		/// validate input
		$valid = true;

        if (empty($Nombre)) {
			$NombreError = 'Porfavor Ingresa un nombre de Proyecto';
			$valid = false; 
		}
		if (empty($Categoria)) {
			$CategoriaError = 'Porfavor Ingresa una Categoria';
			$valid = false;
		}
		if (empty($Nivel)) {
			$NivelError = 'Porfavor Ingresa un Nivel';
			$valid = false;
		}
        if (empty($Estado)) {
			$EstadoError = 'Porfavor Ingresa un Estado';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE PROYECTO SET p_nombre = ?, ca_id = ?, n_id = ?, p_estado = ? WHERE p_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Nombre,$Categoria,$Nivel,$Estado,$id));
			Database::disconnect();
			header("Location: ../PHP/ProyectosView.php");
            exit();
		}
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM PROYECTO WHERE p_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Nombre = $data['p_nombre'];
        $Categoria = $data['ca_id'];
        $Nivel = $data['n_id'];
        $Estado = $data['p_estado'];
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" type="image/ico" href="../media/favicon.ico"/>

    
    

    <title>Proyectos View</title>

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

            <form class="form-horizontal" action="ProyectosUpdate.php?id=<?php echo $id?>" method="post">


                <table>

                    <tr>
                        <td>
                            <label for="">Nombre</label>
                        </td>

                        <td>
                            <input class="Text__Input" name="Nombre" type="text"  placeholder="" value="<?php echo !empty($Nombre )?$Nombre :''; ?>">
                            <?php if (!empty($NombreError != null)): ?>
                                <span class="help-inline"><?php echo $NombreError;?></span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Categoria</label>
                        </td>
                        <td>
                            <select name="Categoria" class="Text__Input" required>
                                <?php 
                                    $pdo = Database::connect();
                                    $sql = "SELECT * FROM CATEGORIA";
                                    $q = $pdo->query($sql);
                                    foreach ($q as $row) {
                                        if ($row['ca_id'] == $Categoria) {
                                            echo "<option value=".$row['ca_id']." selected>".$row['ca_nombre']."</option>";
                                        } else {
                                            echo "<option value=".$row['ca_id'].">".$row['ca_nombre']."</option>";
                                        }
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                            <?php if (($CategoriaError != null)) ?>
                            <span class="help-inline"><?php echo $CategoriaError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Nivel</label>
                        </td>
                        <td>
                            <select name="Nivel" class="Text__Input" required>
                                <?php 
                                    $pdo = Database::connect();
                                    $sql = "SELECT * FROM NIVEL";
                                    $q = $pdo->query($sql);
                                    foreach ($q as $row) {
                                        if ($row['n_id'] == $Nivel) {
                                            echo "<option value=".$row['n_id']." selected>".$row['n_nombre']."</option>";
                                        } else {
                                            echo "<option value=".$row['n_id'].">".$row['n_nombre']."</option>";
                                        }
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                            <?php if (($NivelError != null)) ?>
                            <span class="help-inline"><?php echo $NivelError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Estado</label>
                        </td>

                        <td>
                            <select name="Estado" class="Text__Input" required>
                                <?php 
                                    
                                        if ($Estado == "Registrado") {
                                            echo "<option value='Registrado' selected>Registrado</option>";
                                            echo "<option value='Rechazado'>Rechazado</option>";
                                            echo "<option value='Aceptado'>Aceptado</option>";
                                        } 
                                        else if ($Estado == "Rechazado") {
                                            echo "<option value='Rechazado' selected>Rechazado</option>";
                                            echo "<option value='Registrado'>Registrado</option>";
                                            echo "<option value='Aceptado'>Aceptado</option>";
                                        }
                                        else if ($Estado == "Aceptado") {
                                            echo "<option value='Aceptado' selected>Aceptado</option>";
                                            echo "<option value='Rechazado'>Rechazado</option>";
                                            echo "<option value='Registrado'>Registrado</option>";
                                        } 
                                        else {
                                            echo "<option value='Aceptado'>Aceptado</option>";
                                            echo "<option value='Rechazado'>Rechazado</option>";
                                            echo "<option value='Registrado'>Registrado</option>";
                                        }
                                    
                                ?>
                            </select>
                            <?php if (($EstadoError != null)) ?>
                            <span class="help-inline"><?php echo $EstadoError;?></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input class="Btn__Iniciar__Sesion" type="submit" value="Actualizar Proyectos" id="submit" name="submit">
                        </td>
                        <td>
                            <a class="Btn-Ancla" href="ProyectosView.php">Regresar</a>
                        </td>
                    </tr>
                </table>
            </form>

</main>

</body>
</html>