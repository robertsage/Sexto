<?php
header("Access-Control-Allow-Origin: *");// El asterisco determina que cualquier ip puede conectarse, o sino se especifica una ip directamente
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");// Que peticiones pueden pedir, de seguridad, origen, respuesta, de contenido, de aceptación o de respuesta como método
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");//que métodos vamos a utilizar,
header("Allow: GET, POST, OPTIONS, PUT, DELETE");//WPA= Web Application progressive, WPS= Web Application Single
$method = $_SERVER["REQUEST_METHOD"];//Busque método de petición
if ($method == "OPTIONS") {//Bloquea el metodo para pasar datos, en este caso pregunta si el método es OPTIONS se muere el proceso
    die();
}

// Controlador de Unidad de Medida

require_once('../models/unidadmedida.model.php');
error_reporting(0);
$unidad_medida = new Unidad_Medida;

switch ($_GET["op"]) {
    case 'todos': // Procedimiento para cargar todas las unidades de medida
        $datos = array();
        $datos = $unidad_medida->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todas[] = $row;
        }
        echo json_encode($todas);
        break;

    case 'uno': // Procedimiento para obtener una unidad de medida por ID
        if (!isset($_POST["idUnidad_Medida"])) {
            echo json_encode(["error" => "Unidad de Medida ID not specified."]);
            exit();
        }
        $idUnidad_Medida = intval($_POST["idUnidad_Medida"]);
        $datos = array();
        $datos = $unidad_medida->uno($idUnidad_Medida);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar una nueva unidad de medida
        if (!isset($_POST["Descripcion"]) || !isset($_POST["Tipo"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $Descripcion = $_POST["Descripcion"];
        $Tipo = $_POST["Tipo"];

        $datos = array();
        $datos = $unidad_medida->insertar($Descripcion, $Tipo);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar una unidad de medida existente
       // if (!isset($_POST["idUnidad_Medida"]) || !isset($_POST["Descripcion"]) || !isset($_POST["Tipo"])) {
       //     echo json_encode(["error" => "Missing required parameters."]);
       //     exit();
       // }

        $idUnidad_Medida = intval($_POST["idUnidad_Medida"]);
        $Descripcion = $_POST["Descripcion"];
        $Tipo = $_POST["Tipo"];

        $datos = array();
        $datos = $unidad_medida->actualizar($idUnidad_Medida, $Descripcion, $Tipo);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar una unidad de medida
        if (!isset($_POST["idUnidad_Medida"])) {
            echo json_encode(["error" => "Unidad de Medida ID not specified."]);
            exit();
        }
        $idUnidad_Medida = intval($_POST["idUnidad_Medida"]);
        $datos = array();
        $datos = $unidad_medida->eliminar($idUnidad_Medida);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}