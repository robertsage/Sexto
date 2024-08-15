<?php
//TODO: Clase de Cursos
require_once('../config/config.php');
class Cursos
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from cursos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `cursos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idCursos) //select * from cursos where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `cursos` WHERE `idCursos`=$idCursos";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre_Curso, $Descripcion, $Fecha_Inicio, $Fecha_Fin, $Categorias_idCategorias) //insert into cursos (Nombre_Curso, Descripcion, Fecha_Inicio, Fecha_Fin, Categorias_idCategorias) values ($Nombre_Curso, $Descripcion, $Fecha_Inicio, $Fecha_Fin, $Categorias_idCategorias)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `cursos` ( `Nombre_Curso`, `Descripcion`, `Fecha_Inicio`, `Fecha_Fin`, `Categorias_idCategorias`) VALUES ('$Nombre_Curso', '$Descripcion', '$Fecha_Inicio', '$Fecha_Fin', '$Categorias_idCategorias')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function actualizar($idCursos, $Nombre_Curso, $Descripcion, $Fecha_Inicio, $Fecha_Fin, $Categorias_idCategorias) //update cursos set Nombre_Curso = $Nombre_Curso, Descripcion = $Descripcion, Fecha_Inicio = $Fecha_Inicio, Fecha_Fin = $Fecha_Fin, Categorias_idCategorias = $Categorias_idCategorias where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `cursos` SET `Nombre_Curso`='$Nombre_Curso',`Descripcion`='$Descripcion', `Fecha_Inicio`='$Fecha_Inicio', `Fecha_Fin`='$Fecha_Fin', `Categorias_idCategorias`='$Categorias_idCategorias' WHERE `idCursos` = $idCursos";
            if (mysqli_query($con, $cadena)) {
                return $idCursos;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idCursos) //delete from cursos where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `cursos` WHERE `idCursos`= $idCursos";
            // echo $cadena;
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}