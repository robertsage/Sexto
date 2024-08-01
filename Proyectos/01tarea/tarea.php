<?php
//Declaración de Variables
echo 'a. Declaración de Variables: ';
echo '<br>';
$empleados = 240;
echo 'Tipo de datos Integer: '.$empleados;
echo '<br>';

$pi = 3.41;
echo 'Tipo de datos Float: '.$pi;
echo '<br>';

$alumno = 'Mario Farinango';
echo 'Tipo de datos Stringr: '.$alumno;
echo '<br>';

$activo = true;
echo 'Tipo de datos Booleano: '.$activo;
echo '<br>';

$meses = array();
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
echo 'Tipo de datos Array: ';
echo '<br>';
for ($j = 0; $j < count($meses); $j++) {
    echo $meses[$j]."<br>";
}
echo '<br>';
echo '<br>';

//Operaciones Aritméticas
echo 'b. Operaciones Aritméticas: ';
echo '<br>';
$producto=$empleados*$pi;
echo 'Multiplicación: '.$producto;
echo '<br>';
$division=$empleados/$pi;
echo 'División: '.$division;
echo '<br>';
echo '<br>';

//Manipulación de Cadenas
echo 'c. Manipulación de Cadenas: ';
echo '<br>';
$nombre = 'Ines'.' Torres';
echo $nombre;
echo '<br>';
echo 'Longitud: '.strlen($nombre); 
echo '<br>';
echo '<br>';

//Uso de Condicionales
echo ' d. Uso de Condicionales: ';
$contribuyente = 'Maria'.' Torres';
$longitud=strlen($contribuyente); 
echo '<br>';
if ($longitud>=1){
    $verificado = true;
    echo 'No es un valor Null: '.$verificado;
}else{
    $verificado = false;
    echo 'Es un valor Null '.$verificado;
}
echo '<br>';
echo '<br>';

//Creación de un Array
echo ' e. Creación de un Array: ';
echo '<br>';
$dias = array();
$dias=['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
echo "<ol>";
for ($i = 0; $i < count($dias); $i++) {
    echo "<li>" . $dias[$i]."</li>";
} 
echo '<br>';
echo "Elemento específico del arreglo: ". $dias[3];
echo "</ol>";

?>