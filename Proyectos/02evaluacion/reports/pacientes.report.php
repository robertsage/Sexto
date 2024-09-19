<?php
require('fpdf/fpdf.php');
require_once("../models/pacientes.model.php");

//TODO:  Crear nueva instancia de FPDF
$PacienteModels = new Pacientes ();
$pdf=new FPDF('P', 'mm', 'A4');
$pdf->AddPage();


// Márgenes Izquierdo, superior y derecho
$pdf->SetMargins(10, 20 , 10);


//TODO:  Crear instancia del modelo de Factura
$idPacientes = $_GET['idPacientes'];  //TODO:  Recibir el ID de la factura desde el request
$numPaciente = $PacienteModels->uno($idPacientes);

//TODO:  Función para truncar texto para el nombre del producto u otro que se requiera
function truncarTexto($texto, $maxLongitud) {
    return (strlen($texto) > $maxLongitud) ? substr($texto, 0, $maxLongitud) . '...' : $texto;
}

//TODO:  Logo y nombre para el encabezado de la factura
$pdf->Image('../public/images/tienda.png', 10, 15, 25); //TODO:  Logo
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(185, 10, 'CLINICA', 0, 1, 'C');  //TODO:  Nombre 

//TODO:  Información de la empresa
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(185, 5, utf8_decode('Huacas 1-52 y Shyris'), 0, 1, 'C');
$pdf->Cell(185, 5, utf8_decode('Ibarra - Imbabura'), 0, 1, 'C');
$pdf->Cell(185, 5, utf8_decode('RUC: 102343368001'), 0, 1, 'C');


//TODO:  Obtener datos de la factura y cliente
if ($numPaciente && mysqli_num_rows($numPaciente) > 0) {
    //TODO:  Extraer el primer registro (cabecera de la factura)
    $datosPaciente = mysqli_fetch_assoc($numPaciente);

//TODO:  Núm de factura y autorización
$pdf->Ln(3);
//TODO:  Información del cliente
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, utf8_decode('Nombre: ' .  $datosPaciente['Nombre']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Apellido: ' .$datosPaciente['Apellido']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Direccion: ' .$datosPaciente['Fecha']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Dirección: ' . $datosPaciente['Direccion']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Telçofono: ' . $datosPaciente['Telefono']), 0, 1, 'L');


$pdf->Ln();



} else {
    //TODO:  Mensaje de error si no existe factura (PDF)
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, utf8_decode('No existe pacientes'), 0, 1, 'C');
}


//TODO:  Imprimir pie de página
$pdf->SetY(-33);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 10, utf8_decode('Página ' . $pdf->PageNo()), 0, 0, 'C');

//TODO:  Salida del PDF
$pdf->Output();