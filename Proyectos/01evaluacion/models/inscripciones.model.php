<?php
//TODO: Clase de Inscripciones
require_once('../config/config.php');
class Inscripciones
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from inscripciones
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `inscripciones`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idInscripciones) //select * from inscripciones where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `inscripciones` WHERE `idInscripciones`=$idInscripciones";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Fecha_Inscripcion, $Estudiantes_idEstudiantes, $Cursos_idCursos) //insert into inscripciones (Fecha_Inscripcion, Estudiantes_idEstudiantes, Cursos_idCursos) values ($Fecha_Inscripcion, $Estudiantes_idEstudiantes, $Cursos_idCursos)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `inscripciones` ( `Fecha_Inscripcion`, `Estudiantes_idEstudiantes`, `Cursos_idCursos`) VALUES ('$Fecha_Inscripcion', '$Estudiantes_idEstudiantes', '$Cursos_idCursos')";
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
    public function actualizar($idInscripciones, $Fecha_Inscripcion, $Estudiantes_idEstudiantes, $Cursos_idCursos) //update inscripciones set Fecha_Inscripcion = $Fecha_Inscripcion, Estudiantes_idEstudiantes = $Estudiantes_idEstudiantes, Cursos_idCursos = $Cursos_idCursos where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `inscripciones` SET `Fecha_Inscripcion`='$Fecha_Inscripcion',`Estudiantes_idEstudiantes`='$Estudiantes_idEstudiantes', `Cursos_idCursos`='$Cursos_idCursos' WHERE `idInscripciones` = $idInscripciones";
            if (mysqli_query($con, $cadena)) {
                return $idInscripciones;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idInscripciones) //delete from inscripciones where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `inscripciones` WHERE `idInscripciones`= $idInscripciones";
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