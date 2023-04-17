<?php
include 'dataBase.php';

// Conexión a la base de datos
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Consultas
$sqlDo = 'SELECT * FROM DOCENTEV1 ORDER BY d_apellido_paterno';
$sqlJu = 'SELECT * FROM JURADOV1 ORDER BY j_apellido_paterno';
$sqlAl = 'SELECT * FROM ALUMNOV1 ORDER BY a_apellido_paterno';
$sqlAd = 'SELECT * FROM ADMINV1 ORDER BY adm_usu';

// Ejecución de las consultas
$resultDo = mysqli_query($conn, $sqlDo);
$resultJu = mysqli_query($conn, $sqlJu);
$resultAl = mysqli_query($conn, $sqlAl);
$resultAd = mysqli_query($conn, $sqlAd);

// Mostrar resultados
while ($row = mysqli_fetch_assoc($resultDo)) {
	echo '<tr>';
	echo '<td>'. $row['d_nombre'] . '</td>';
	echo '<td>'. $row['d_apellido_paterno'] . '</td>';
	echo '<td>'. $row['d_correo'] . '</td>';
	//echo '<td>'; echo ($row['ac'])?"SI":"NO"; echo'</td>';
	echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
	echo '</tr>';
}

while ($row = mysqli_fetch_assoc($resultJu)) {
	echo '<tr>';
	echo '<td>'. $row['d_nombre'] . '</td>';
	echo '<td>'. $row['d_apellido_paterno'] . '</td>';
	echo '<td>'. $row['d_correo'] . '</td>';
	//echo '<td>'; echo ($row['ac'])?"SI":"NO"; echo'</td>';
	echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
	echo '</tr>';
}
while ($row = mysqli_fetch_assoc($resultDo)) {
	echo '<tr>';
	echo '<td>'. $row['d_nombre'] . '</td>';
	echo '<td>'. $row['d_apellido_paterno'] . '</td>';
	echo '<td>'. $row['d_correo'] . '</td>';
	//echo '<td>'; echo ($row['ac'])?"SI":"NO"; echo'</td>';
	echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
	echo '</tr>';
}

while ($row = mysqli_fetch_assoc($resultDo)) {
	echo '<tr>';
	echo '<td>'. $row['d_nombre'] . '</td>';
	echo '<td>'. $row['d_apellido_paterno'] . '</td>';
	echo '<td>'. $row['d_correo'] . '</td>';
	//echo '<td>'; echo ($row['ac'])?"SI":"NO"; echo'</td>';
	echo '<a class="btn" href="read.php?id='.$row['d_nomina'].'">Detalles</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-success" href="update.php?id='.$row['d_nomina'].'">Actualizar</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-danger" href="delete.php?id='.$row['d_nomina'].'">Eliminar</a>';
	echo '</tr>';
}


?>