<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de detalle_factura

require_once('../models/detalle_factura.model.php');
error_reporting(0);
$detalle_factura = new Detalle_Factura;

switch ($_GET["op"]) {
        //TODO: operaciones de detalle_factura

    case 'todos': //TODO: Procedimiento para cargar todos las datos del detalle_factura
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase detalle_factura.model.php
        $datos = $detalle_factura->todos(); // Llamo al metodo todos de la clase detalle_factura.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = array();
        $datos = $detalle_factura->uno($idDetalle_Factura);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un detalle_factura en la base de datos
    case 'insertar':
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];

        $datos = array();
        $datos = $detalle_factura->insertar($Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar una factura en la base de datos
    case 'actualizar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];
        $datos = array();
        $datos = $detalle_factura->actualizar($idDetalle_Factura, $Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un detalle_factura en la base de datos
    case 'eliminar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = array();
        $datos = $detalle_factura->eliminar($idDetalle_Factura);
        echo json_encode($datos);
        break;
}