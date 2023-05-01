<?php
require 'dataBase.php';
require("/fpdf/fpdf.php");
if ($_GET) {
    if (isset($_GET['matricula'])) {
        $pdo = Database::connect();
        $sql = "SELECT * 
                FROM COLABORADOR 
                NATURAL JOIN EDICION_COLABORADOR 
                NATURAL JOIN EDICION
                WHERE co_correo = '{$_REQUEST['matricula']}';";
        $q = $pdo->query($sql);
        //var_dump($q);
        $filas = $q->fetch();
        //var_dump($filas);
        //Database::disconnect();
    
$nombre = $filas["co_nombre"] . " " . $filas["co_apellido"];
$edicion = $filas["ed_nombre"];
$tipo = "Reconocimiento";
$motivo = "por haber participado en la";
$evento = "Expo ingenieria";
$dia = date("d");

//$mes = strftime("%A");
setlocale(LC_TIME, "spanish");
$mes = strftime("%B");

$year = date("Y");
$fecha = "Puebla, Puebla, a " . $dia . " de " . $mes . " de " . $year;
$autoridad1 = "Nombre de Director General";
$titulo1 = "Titulo1";
$autoridad2 = "Nombre de Autoridad 2";
$titulo2 = "Titulo2";
$campus = "campus Puebla";
$fpdf = new FPDF('P', 'mm', 'Letter');
$fpdf->AddPage();
$fpdf->SetFont('Arial', '', 16);
$fpdf->Ln(35);
$fpdf->Image('../media/Logotipo95.png', 60.45, null, 95, 0);
$fpdf->Ln(25.6);
$fpdf->Cell(0, 0, 'Otorga a:', 0, 0, 'C');
$nombre = iconv('UTF-8', 'windows-1252', $nombre);
$fpdf->Ln(18);
$fpdf->SetFont('Arial', 'B', 30);
$fpdf->Cell(0, 0, $nombre, 0, 0, 'C');
$fpdf->SetFont('Arial', 'I', 16);
$fpdf->Ln(15);
$fpdf->Cell(0, 0, "el presente", 0, 0, 'C');
$fpdf->Ln(15);
$fpdf->SetFont('Arial', 'IB', 24);
$tipo = iconv('UTF-8', 'windows-1252', $tipo);
$fpdf->Cell(0, 0, $tipo, 0, 0, 'C');
$fpdf->SetFont('Arial', 'I', 16);
$fpdf->Ln(15);
$motivo = iconv('UTF-8', 'windows-1252', $motivo);
$fpdf->Cell(0, 0, $motivo, 0, 0, 'C');
$fpdf->Ln(15);
$fpdf->SetFont('Arial', 'IB', 24);
$evento = iconv('UTF-8', 'windows-1252', $evento);
$fpdf->Cell(0, 0, $evento, 0, 0, 'C');
$fpdf->Ln(15);
$edicion = iconv('UTF-8', 'windows-1252', $edicion);
$fpdf->Cell(0, 0, $edicion, 0, 0, 'C');
$fpdf->SetFont('Arial', 'I', 16);
$fpdf->Ln(12);
$fpdf->SetFont('Arial', '', 10);
$fecha = iconv('UTF-8', 'windows-1252', $fecha);
$fpdf->Cell(0, 0, $fecha, 0, 0, 'C');
$fpdf->Ln(37.4);
$fpdf->SetFont('Arial', 'BI', 12);
$autoridad1 = iconv('UTF-8', 'windows-1252', $autoridad1);
$titulo1 = iconv('UTF-8', 'windows-1252', $titulo1);
$campus = iconv('UTF-8', 'windows-1252', $campus);
$autoridad2 = iconv('UTF-8', 'windows-1252', $autoridad2);
$titulo2 = iconv('UTF-8', 'windows-1252', $titulo2);
$autoridades = array($autoridad1, '', $autoridad2);
$titulos = array($titulo1, '', $titulo2);
$ancho = array(83, 30, 83);
for ($i = 0; $i < count($autoridades); $i++)
    $fpdf->Cell($ancho[$i], 7, $autoridades[$i], 0, 0, 'C');
$fpdf->Ln(5);
for ($i = 0; $i < count($autoridades); $i++)
    $fpdf->Cell($ancho[$i], 7, $titulos[$i], 0, 0, 'C');
$fpdf->Ln(5);
$fpdf->SetFont('Arial', 'I', 12);
$fpdf->Cell($ancho[0], 7, $campus, 0, 0, 'C');
$fpdf->Output();

$pdo = Database::connect();
 }
}

?>