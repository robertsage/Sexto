<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de cursos

require_once('../models/cursos.model.php');
error_reporting(0);
$cursos = new Cursos;

switch ($_GET["op"]) {
        //TODO: operaciones de cursos

    case 'todos': //TODO: Procedimiento para cargar todos los datos de los cursos
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase cursos.model.php
        $datos = $cursos->todos(); // Llamo al metodo todos de la clase cursos.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valores almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idCursos = $_POST["idCursos"];
        $datos = array();
        $datos = $cursos->uno($idCursos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un curso en la base de datos
    case 'insertar':
        $Nombre_Curso = $_POST["Nombre_Curso"];
        $Descripcion = $_POST["Descripcion"];
        $Fecha_Inicio = $_POST["Fecha_Inicio"];
        $Fecha_Fin = $_POST["Fecha_Fin"];
        $Categorias_idCategorias = $_POST["Categorias_idCategorias"];

        $datos = array();
        $datos = $cursos->insertar($Nombre_Curso, $Descripcion, $Fecha_Inicio, $Fecha_Fin, $Categorias_idCategorias);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualizar un curso en la base de datos
    case 'actualizar':
        $idCursos = $_POST["idCursos"];
        $Nombre_Curso = $_POST["Nombre_Curso"];
        $Descripcion = $_POST["Descripcion"];
        $Fecha_Inicio = $_POST["Fecha_Inicio"];
        $Fecha_Fin = $_POST["Fecha_Fin"];
        $Categorias_idCategorias = $_POST["Categorias_idCategorias"];
        $datos = array();
        $datos = $cursos->actualizar($idCursos, $Nombre_Curso, $Descripcion, $Fecha_Inicio, $Fecha_Fin, $Categorias_idCategorias);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un curso en la base de datos
    case 'eliminar':
        $idCursos = $_POST["idCursos"];
        $datos = array();
        $datos = $cursos->eliminar($idCursos);
        echo json_encode($datos);
        break;
}