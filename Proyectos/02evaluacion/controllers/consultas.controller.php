<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
// TODO: controlador de consultas 

require_once('../models/consultas.model.php');
error_reporting(0);
$consultas = new Consultas;

switch ($_GET["op"]) {
        // TODO: operaciones de consultas

    case 'todos': // Procedimiento para cargar todas las consultas
        $datos = array();
        $datos = $consultas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener una consulta por ID
        if (!isset($_POST["idConsultas"])) {
            echo json_encode(["error" => "Consultas ID not specified."]);
            exit();
        }
        $idConsultas = intval($_POST["idConsultas"]);
        $datos = array();
        $datos = $consultas->uno($idConsultas);
        //$res = mysqli_fetch_assoc($datos);
        while ($row = mysqli_fetch_assoc($datos)) {
            $res[] = $row;
        }
        //print_r($res);
        echo json_encode($res);
        break;

        case 'unoConsulDet': // Procedimiento para obtener una consulta por ID
            if (!isset($_POST["idConsultas"])) {
                echo json_encode(["error" => "Consultas ID not specified."]);
                exit();
            }
            $idConsultas = intval($_POST["idConsultas"]);
            $datos = array();
            $datos = $consultas->unoConsulDet($idConsultas);
            //$res = mysqli_fetch_assoc($datos);
            while ($row = mysqli_fetch_assoc($datos)) {
                $res[] = $row;
            }
            //print_r($res);
            echo json_encode($res);
            break;

    case 'insertar': // Procedimiento para insertar una nueva consulta
        if (!isset($_POST["Fecha"]) || !isset($_POST["Descripcion"]) || !isset($_POST["Medicos_idMedicos"]) || !isset($_POST["Pacientes_idPacientes"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $Fecha = $_POST["Fecha"];
        $Descripcion = $_POST["Descripcion"];
        $Medicos_idMedicos = intval($_POST["Medicos_idMedicos"]);
        $Pacientes_idPacientes = intval($_POST["Pacientes_idPacientes"]);
        $datos = array();
        $datos = $consultas->insertar($Fecha, $Descripcion, $Medicos_idMedicos, $Pacientes_idPacientes);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar una consulta existente
        if (!isset($_POST["idConsultas"]) || !isset($_POST["Fecha"]) || !isset($_POST["Descripcion"]) || !isset($_POST["Medicos_idMedicos"]) || !isset($_POST["Pacientes_idPacientes"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $idConsultas = intval($_POST["idConsultas"]);
        $Fecha = $_POST["Fecha"];
        $Descripcion = $_POST["Descripcion"];
        $Medicos_idMedicos = intval($_POST["Medicos_idMedicos"]);
        $Pacientes_idPacientes = intval($_POST["Pacientes_idPacientes"]);
        $datos = array();
        $datos = $consultas->actualizar($idConsultas, $Fecha, $Descripcion, $Medicos_idMedicos, $Pacientes_idPacientes);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar una consulta
        if (!isset($_POST["idConsultas"])) {
            echo json_encode(["error" => "Consultas ID not specified."]);
            exit();
        }
        $idConsultas = intval($_POST["idConsultas"]);
        $datos = array();
        $datos = $consultas->eliminar($idConsultas);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}