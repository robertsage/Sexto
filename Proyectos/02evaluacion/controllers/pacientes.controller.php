<?php
header("Access-Control-Allow-Origin: *");// El asterisco determina que cualquier ip puede conectarse, o sino se especifica una ip directamente
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");// Que peticiones pueden pedir, de seguridad, origen, respuesta, de contenido, de aceptación o de respuesta como método
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");//que métodos vamos a utilizar,
header("Allow: GET, POST, OPTIONS, PUT, DELETE");//WPA= Web Application progressive, WPS= Web Application Single
$method = $_SERVER["REQUEST_METHOD"];//Busque método de petición
if ($method == "OPTIONS") {//Bloquea el metodo para pasar datos, en este caso pregunta si el método es OPTIONS se muere el proceso
    die();
}
//TODO: controlador de pacientes

require_once('../models/pacientes.model.php');
error_reporting(0);
$pacientes = new Pacientes;

switch ($_GET["op"]) {
        //TODO: operaciones de pacientes

    case 'todos': //TODO: Procedimeinto para cargar todos las datos de los pacientes
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase pacientes.model.php
        $datos = $pacientes->todos(); // Llamo al metodo todos de la clase pacientes.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimeinto para obtener un registro de la base de datos
    case 'uno':
        $idPacientes = $_POST["idPacientes"];
        $datos = array();
        $datos = $pacientes->uno($idPacientes);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimeinto para insertar un paciente en la base de datos
    case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["Apellido"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $datos = array();
        $datos = $pacientes->insertar($Nombre, $Apellido, $Direccion, $Telefono);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para actualziar un paciente en la base de datos
    case 'actualizar':
        $idPacientes = $_POST["idPacientes"];
        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["Apellido"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $datos = array();
        $datos = $pacientes->actualizar($idPacientes, $Nombre, $Apellido, $Direccion, $Telefono);
        echo json_encode($datos);
        break;
        //TODO: Procedimeinto para eliminar un paciente en la base de datos
    case 'eliminar':
        $idPacientes = $_POST["idPacientes"];
        $datos = array();
        $datos = $pacientes->eliminar($idPacientes);
        echo json_encode($datos);
        break;
}