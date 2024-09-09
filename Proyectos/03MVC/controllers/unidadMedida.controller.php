<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de unidadMedida

require_once('../models/unidadMedida.model.php');
error_reporting(0);//TODOS: DESHABILITAR ERRORR,  DEJAR COMENTADO Si se desea que se muestre el error
$unidadMedida = new UnidadMedida;

switch ($_GET["op"]) {
        //TODO: operaciones de unidadMedida

    case 'todos': //TODO: Procedimiento para cargar todos las datos de unidad_medida
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase unidadMedida.model.php
        $datos = $unidadMedida->todos(); // Llamo al metodo todos de la clase unidadMedida.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimeinto para obtener un registro de la base de datos
    case 'uno':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = array();
        $datos = $unidadMedida->uno($idUnidad_Medida);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimeinto para insertar un unidad_medida en la base de datos
    case 'insertar':
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];
          
        $datos = array();
        $datos = $unidadMedida->insertar($Detalle, $Tipo);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para actualziar un unidad_medida en la base de datos
    case 'actualizar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];
               
        $datos = array();
        $datos = $unidadMedida->actualizar($idUnidad_Medida, $Detalle, $Tipo);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para eliminar un unidad_medida en la base de datos
    case 'eliminar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = array();
        $datos = $unidadMedida->eliminar($idUnidad_Medida);
        echo json_encode($datos);
        break;
}