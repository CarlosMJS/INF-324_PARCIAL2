<?php
require('fpdf.php');

include '../conexion.inc.php';

$sql="SELECT * FROM academico.persona ";
$sql.="WHERE id=1";
$resultadofi=mysqli_query($con, $sql);
$datos=mysqli_fetch_array($resultadofi);
// datos del destinatario

$nombre = $datos['nombre']." ".$datos['apaterno']." ".$datos['amaterno'];
// crear el objeto PDF
$pdf = new FPDF('L');
$pdf->AddPage();


$pdf->Image('logo.jpeg', 10, 10, 30, 0); // Inserta la imagen en el PDF
$pdf->Image('logoinfo.jpeg', 235, 10, 60, 0); // Inserta la imagen en el PDF

// establecer la fuente y el tamaño del texto
$pdf->SetFont('Arial', 'B', 20); // Establece la fuente gótica como la fuente actual
$pdf->Ln(20);
// insertar el título
$pdf->Cell(0, 10, 'CERTIFICADO DE CULMINACION DE ESTUDIOS', 0, 1, 'C');

// espacio en blanco
$pdf->Ln(20);

// establecer la fuente y el tamaño del texto
$pdf->SetFont('Arial', '', 20);

// insertar el nombre del destinatario
$pdf->Cell(0, 10, "Se otorga el presente certificado de", 0, 1, 'C');
$pdf->Cell(0, 10, "CULMINACION DE ESTUDIOS a:", 0, 1, 'C');
// espacio en blanco
$pdf->Ln(10);

// insertar la felicitación
$pdf->SetFont('Arial', '', 45);
$pdf->MultiCell(0, 10, $nombre, 0, 'C');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 20);
// insertar el nombre del destinatario
$pdf->Cell(0, 10, "Por haber finalizado exitosamente el plan de estudios en la carrera", 0, 1, 'C');
$pdf->Cell(0, 10, " de INFORMATICA de la UNIVERSIDAD MAYOR DE SAN ANDRES", 0, 1, 'C');
$hoy = date('d/m/Y');
$pdf->SetFont('Arial', '', 20);
$pdf->Cell(0, 10, "otorgada en: $hoy", 0, 1, 'C');
// espacio en blanco
$pdf->Ln(20);

// establecer la fuente y el tamaño del texto
$pdf->SetFont('Arial', '', 12);

// insertar las firmas
$pdf->Cell(0, 10, '_____________________________                                 ___________________________', 0, 1, 'C');
$pdf->Cell(0, 10, 'Firma del Director de Carrera                                              Firma del Decano de la facultad', 0, 1, 'C');
$pdf->Output('Prueba2.pdf', 'I');

?>