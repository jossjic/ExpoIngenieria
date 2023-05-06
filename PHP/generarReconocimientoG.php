<?php
  require_once 'dataBase.php';
  require("../fpdf/fpdf.php");

  session_name("EngineerXpoWeb");
  session_start();

  if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] != "ADMIN") {
      header("Location: ../index.php");
      exit();
  }
if ($_GET) {
  if (isset($_GET['proyecto'])) {
    $fpdf = new FPDF('P', 'mm', 'Letter');
    $fpdf->AddPage();
    $pdo = Database::connect();
    //$sql = "SELECT * FROM alumno";
    $sql = "SELECT ALUMNO.a_nombre, ALUMNO.a_apellido, PROYECTO.p_nombre, EDICION.ed_nombre, CATEGORIA.ca_nombre FROM ALUMNO JOIN PROYECTO_ALUMNO ON ALUMNO.a_correo = PROYECTO_ALUMNO.a_correo JOIN PROYECTO ON PROYECTO_ALUMNO.p_id = PROYECTO.p_id JOIN EDICION ON PROYECTO.ed_id = EDICION.ed_id JOIN CATEGORIA ON PROYECTO.ca_id = CATEGORIA.ca_id WHERE PROYECTO.p_id = {$_GET['proyecto']};";
    $q = $pdo->query($sql);
    for ($x = 0; $x < $q->rowCount(); $x++) {
      //var_dump($q);
      $filas = $q->fetch();
      //var_dump($filas);
      //Database::disconnect();

      //var_dump($filas);
      $nombre = $filas["a_nombre"] . " " . $filas["a_apellido"];
      $proyecto = $filas["p_nombre"];
      $edicion = $filas["ed_nombre"];
      $categoria = $filas["ca_nombre"];
      $tipo = "Reconocimiento";
      $motivo = "por haber ganado en la";
      $evento = "Expo ingeniería";
      $dia = date("d");

      //$mes = strftime("%A");
      setlocale(LC_TIME, "spanish");
      $mes = strftime("%B");

      $year = date("Y");
      $fecha = "Puebla, Puebla, a " . $dia . " de " . $mes . " de " . $year;
      $autoridad1 = "Jorge Fco. Rocha Orozco";
      $titulo1 = "Titulo1";
      $autoridad2 = "José Rafael Aguilar Mejía";
      $titulo2 = "Titulo2";
      $campus = "campus Puebla";

      $fpdf->SetFont('Arial', '', 16);
      $fpdf->Ln(12);
      $fpdf->Image('../media/Logotipo95.png', 60.45, null, 95, 0);
      $fpdf->Ln(12);
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
      $fpdf->Cell(0, 0, 'con el proyecto', 0, 0, 'C');
      $fpdf->Ln(12);
      $fpdf->SetFont('Arial', 'IB', 22);
      $proyecto = iconv('UTF-8', 'windows-1252', $proyecto);
      $fpdf->Cell(0, 0, $proyecto, 0, 0, 'C');
      $fpdf->SetFont('Arial', 'I', 16);
      $fpdf->Ln(12);
      $fpdf->Cell(0, 0, 'en la categoria', 0, 0, 'C');
      $fpdf->Ln(12);
      $fpdf->SetFont('Arial', 'IB', 22);
      $proyecto = iconv('UTF-8', 'windows-1252', $categoria);
      $fpdf->Cell(0, 0, $proyecto, 0, 0, 'C');
      $fpdf->Ln(15);

      $fpdf->SetFont('Arial', '', 10);
      $fecha = iconv('UTF-8', 'windows-1252', $fecha);
      $fpdf->Cell(0, 0, $fecha, 0, 0, 'C');
      $fpdf->Ln(22.4);
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
    }
    $fpdf->Output();
  }
}