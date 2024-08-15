<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de categorias

require_once('../models/categorias.model.php');
error_reporting(0);
$categorias = new Categorias;

switch ($_GET["op"]) {
        //TODO: operaciones de categorias

    case 'todos': //TODO: Procedimiento para cargar todos los datos de las categorias
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase categorias.model.php
        $datos = $categorias->todos(); // Llamo al metodo todos de la clase categorias.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valores almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idCategorias = $_POST["idCategorias"];
        $datos = array();
        $datos = $categorias->uno($idCategorias);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar una categoria en la base de datos
    case 'insertar':
        $Nombre_Categoria = $_POST["Nombre_Categoria"];
        $Descripcion = $_POST["Descripcion"];

        $datos = array();
        $datos = $categorias->insertar($Nombre_Categoria, $Descripcion);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualizar una categoria en la base de datos
    case 'actualizar':
        $idCategorias = $_POST["idCategorias"];
        $Nombre_Categoria = $_POST["Nombre_Categoria"];
        $Descripcion = $_POST["Descripcion"];
        $datos = array();
        $datos = $categorias->actualizar($idCategorias, $Nombre_Categoria, $Descripcion);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar una categoria en la base de datos
    case 'eliminar':
        $idCategorias = $_POST["idCategorias"];
        $datos = array();
        $datos = $categorias->eliminar($idCategorias);
        echo json_encode($datos);
        break;
}