<?php
header("Access-Control-Allow-Origin: *");// El asterisco determina que cualquier ip puede conectarse, o sino se especifica una ip directamente
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");// Que peticiones pueden pedir, de seguridad, origen, respuesta, de contenido, de aceptación o de respuesta como método
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");//que métodos vamos a utilizar,
header("Allow: GET, POST, OPTIONS, PUT, DELETE");//WPA= Web Application progressive, WPS= Web Application Single
$method = $_SERVER["REQUEST_METHOD"];//Busque método de petición
if ($method == "OPTIONS") {//Bloquea el metodo para pasar datos, en este caso pregunta si el método es OPTIONS se muere el proceso
    die();
}
//TODO: controlador de medicos

require_once('../models/medicos.model.php');
error_reporting(0);
$medicos = new Medicos;

switch ($_GET["op"]) {
        //TODO: operaciones de medicos

    case 'todos': //TODO: Procedimeinto para cargar todos las datos de los medicos
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase medicos.model.php
        $datos = $medicos->todos(); // Llamo al metodo todos de la clase medicos.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimeinto para obtener un registro de la base de datos
    case 'uno':
        $idMedicos = $_POST["idMedicos"];
        $datos = array();
        $datos = $medicos->uno($idMedicos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimeinto para insertar un medico en la base de datos
    case 'insertar':
        $Nombres = $_POST["Nombres"];
        $Especialidad = $_POST["Especialidad"];
        $Telefono = $_POST["Telefono"];
        $Email = $_POST["Email"];
        $datos = array();
        $datos = $medicos->insertar($Nombres, $Especialidad, $Telefono, $Email);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para actualziar un medico en la base de datos
    case 'actualizar':
        $idMedicos = $_POST["idMedicos"];
        $Nombres = $_POST["Nombres"];
        $Especialidad = $_POST["Especialidad"];
        $Telefono = $_POST["Telefono"];
        $Email = $_POST["Email"];
        $datos = array();
        $datos = $medicos->actualizar($idMedicos, $Nombres, $Especialidad, $Telefono, $Email);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para eliminar un medico en la base de datos
    case 'eliminar':
        $idMedicos = $_POST["idMedicos"];
        $datos = array();
        $datos = $medicos->eliminar($idMedicos);
        echo json_encode($datos);
        break;
}