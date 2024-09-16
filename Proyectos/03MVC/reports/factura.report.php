<?php
require('fpdf/fpdf.php');
require_once("../models/factura.model.php");

//TODO:  Crear nueva instancia de FPDF
$facturaModels = new Factura ();
$pdf=new FPDF('P', 'mm', 'A4');
$pdf->AddPage();


// Márgenes Izquierdo, superior y derecho
$pdf->SetMargins(10, 20 , 10);


//TODO:  Crear instancia del modelo de Factura
$idFactura = $_GET['idFactura'];  //TODO:  Recibir el ID de la factura desde el request
$numFactura = $facturaModels->unoFacDet($idFactura);

//TODO:  Función para truncar texto para el nombre del producto u otro que se requiera
function truncarTexto($texto, $maxLongitud) {
    return (strlen($texto) > $maxLongitud) ? substr($texto, 0, $maxLongitud) . '...' : $texto;
}

//TODO:  Logo y nombre para el encabezado de la factura
$pdf->Image('../public/images/tienda.png', 10, 15, 25); //TODO:  Logo
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(185, 10, 'TIENDA EN LINEA', 0, 1, 'C');  //TODO:  Nombre 

//TODO:  Información de la empresa
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(185, 5, utf8_decode('Huacas 1-52 y Shyris'), 0, 1, 'C');
$pdf->Cell(185, 5, utf8_decode('Ibarra - Imbabura'), 0, 1, 'C');
$pdf->Cell(185, 5, utf8_decode('RUC: 102343368001'), 0, 1, 'C');


//TODO:  Obtener datos de la factura y cliente
if ($numFactura && mysqli_num_rows($numFactura) > 0) {
    //TODO:  Extraer el primer registro (cabecera de la factura)
    $datosFactura = mysqli_fetch_assoc($numFactura);

//TODO:  Núm de factura y autorización
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5,utf8_decode('Factura Nº.: 001-001-' . $idFactura), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Numero de Autorización: 0000000000000000000000000000000000000000000000000'), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Fecha y Hora de Autorización: ' . $datosFactura['Fecha']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Ambiente: PRODUCCION'), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Emisión: NORMAL'), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Clave de Acceso: 0000000000000000000000000000000000000000000000000'), 0, 1, 'L');

//TODO:  Información del cliente
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, utf8_decode('Cliente: ' .  $datosFactura['Nombres']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Identificación: ' .$datosFactura['Cedula']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Fecha de Emisión: ' .$datosFactura['Fecha']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Dirección: ' . $datosFactura['Direccion']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Telçofono: ' . $datosFactura['Telefono']), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('Correo: ' . $datosFactura['Correo']), 0, 1, 'L');


//TODO:  Títulos de columnas de la factura
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 7, 'Sec.', 1);  //TODO:  Secuencial
$pdf->Cell(25, 7, 'idProducto', 1); //TODO:  idProducto
$pdf->Cell(55, 7, 'Descripcion', 1); //TODO:  Descripción del producto
$pdf->Cell(15, 7, 'Cant.', 1); //TODO:  Cantidad del producto en el detalle de la factura
$pdf->Cell(30, 7, 'Precio Unit.', 1); //TODO:  Precio unitario en el detalle de la factura
$pdf->Cell(20, 7, '% IVA', 1); //TODO:  % de IVA en el detalle de la factura
$pdf->Cell(30, 7, 'Total', 1); //TODO:  Total del detalle de la factura
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$index = 1;
mysqli_data_seek($numFactura, 0);  //TODO:  Reseteo del puntero de la consulta para recorrer todos los registros de detalle

while ($prod = mysqli_fetch_assoc($numFactura)) {
    $pdf->Cell(10, 7, $index, 1);  //TODO:  Secuencial
    $pdf->Cell(25, 7, number_format($prod['idProductos'], 2), 1); //TODO:  IdProducto
    $pdf->Cell(55, 7, truncarTexto($prod['Nombre_Producto'],30), 1);  //TODO:  Descripción del producto
    $pdf->Cell(15, 7, $prod['Cantidad'], 1);  //TODO:  Cantidad del producto en el detalle de la factura
    $pdf->Cell(30, 7, '$' . number_format($prod['Precio_Unitario_d'], 2) , 1);  //TODO:  Precio unitario en el detalle de la factura
    $pdf->Cell(20, 7, number_format($prod['Porcentaje_iva'], 0).'%', 1); //TODO:  % de IVA en el detalle de la factura
    $pdf->Cell(30, 7, '$' . number_format($prod['Sub_Total_item_d'], 2), 1); //TODO:  Total del detalle de la factura
    $pdf->Ln();
    $index++;
}

//TODO:  Infor adicional y resumen factura
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 6, 'Forma de Pago: OTROS CON UTILIZACION DEL SISTEMA FINANCIERO', 0, 1);
$pdf->Cell(190, 6, 'Ciudad: IBARRA', 0, 1);

//TODO:  Resumen de impuestos y totales
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 6, '', 0);  //TODO:  Espacio vacío
$pdf->Cell(30, 6, 'Subtotal 15%:', 0);  //TODO:  Subtotal antes de IVA
$pdf->Cell(30, 6, number_format($datosFactura['Sub_total_f'], 2), 0, 1, 'R');

$pdf->Cell(130, 6, '', 0);
$pdf->Cell(30, 6, 'IVA 15%:', 0); //TODO:  Valor de IVA
$pdf->Cell(30, 6, number_format($datosFactura['Valor_IVA_f'], 2), 0, 1, 'R');

$pdf->Cell(130, 6, '', 0);
$pdf->Cell(30, 6, 'Total:', 0); //TODO:  Total de la Factura
$pdf->Cell(30, 6, number_format($datosFactura['Sub_total_iva_f'], 2), 0, 1, 'R');



} else {
    //TODO:  Mensaje de error si no existe factura (PDF)
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, utf8_decode('No existe la factura'), 0, 1, 'C');
}


//TODO:  Imprimir pie de página
$pdf->SetY(-33);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 10, utf8_decode('Página ' . $pdf->PageNo()), 0, 0, 'C');

//TODO:  Salida del PDF
$pdf->Output();