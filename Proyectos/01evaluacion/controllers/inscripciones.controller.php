<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de inscripciones

require_once('../models/inscripciones.model.php');
error_reporting(0);
$inscripciones = new Inscripciones;

switch ($_GET["op"]) {
        //TODO: operaciones de inscripciones

    case 'todos': //TODO: Procedimiento para cargar todos los datos de las inscripciones
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase inscripciones.model.php
        $datos = $inscripciones->todos(); // Llamo al metodo todos de la clase inscripciones.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valores almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idInscripciones = $_POST["idInscripciones"];
        $datos = array();
        $datos = $inscripciones->uno($idInscripciones);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar una inscripcion en la base de datos
    case 'insertar':
        $Fecha_Inscripcion = $_POST["Fecha_Inscripcion"];
        $Estudiantes_idEstudiantes = $_POST["Estudiantes_idEstudiantes"];
        $Cursos_idCursos = $_POST["Cursos_idCursos"];

        $datos = array();
        $datos = $inscripciones->insertar($Fecha_Inscripcion, $Estudiantes_idEstudiantes, $Cursos_idCursos);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualizar una inscripcion en la base de datos
    case 'actualizar':
        $idInscripciones = $_POST["idInscripciones"];
        $Fecha_Inscripcion = $_POST["Fecha_Inscripcion"];
        $Estudiantes_idEstudiantes = $_POST["Estudiantes_idEstudiantes"];
        $Cursos_idCursos = $_POST["Cursos_idCursos"];
        $datos = array();
        $datos = $inscripciones->actualizar($idInscripciones, $Fecha_Inscripcion, $Estudiantes_idEstudiantes, $Cursos_idCursos);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar una inscripcion en la base de datos
    case 'eliminar':
        $idInscripciones = $_POST["idInscripciones"];
        $datos = array();
        $datos = $inscripciones->eliminar($idInscripciones);
        echo json_encode($datos);
        break;
}