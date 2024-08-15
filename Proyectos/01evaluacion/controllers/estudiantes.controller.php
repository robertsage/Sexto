<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de estudiantes

require_once('../models/estudiantes.model.php');
error_reporting(0);
$estudiantes = new Estudiantes;

switch ($_GET["op"]) {
        //TODO: operaciones de estudiantes

    case 'todos': //TODO: Procedimiento para cargar todos los datos de los estudiantes
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase estudiantes.model.php
        $datos = $estudiantes->todos(); // Llamo al metodo todos de la clase estudiantes.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valores almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idEstudiantes = $_POST["idEstudiantes"];
        $datos = array();
        $datos = $estudiantes->uno($idEstudiantes);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un estudiante en la base de datos
    case 'insertar':
        $Nombres = $_POST["Nombres"];
        $Apellidos = $_POST["Apellidos"];
        $Cedula = $_POST["Cedula"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Email = $_POST["Email"];

        $datos = array();
        $datos = $estudiantes->insertar($Nombres, $Apellidos, $Cedula, $Direccion, $Telefono, $Email);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualizar un estudiante en la base de datos
    case 'actualizar':
        $idEstudiantes = $_POST["idEstudiantes"];
        $Nombres = $_POST["Nombres"];
        $Apellidos = $_POST["Apellidos"];
        $Cedula = $_POST["Cedula"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Email = $_POST["Email"];
        $datos = array();
        $datos = $estudiantes->actualizar($idEstudiantes, $Nombres, $Apellidos, $Cedula, $Direccion, $Telefono, $Email);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un estudiante en la base de datos
    case 'eliminar':
        $idEstudiantes = $_POST["idEstudiantes"];
        $datos = array();
        $datos = $estudiantes->eliminar($idEstudiantes);
        echo json_encode($datos);
        break;
}