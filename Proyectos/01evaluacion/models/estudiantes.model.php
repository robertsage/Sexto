<?php
//TODO: Clase de Estudiantes
require_once('../config/config.php');
class Estudiantes
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from estudiantes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idEstudiantes) //select * from estudiantes where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes` WHERE `idEstudiantes`=$idEstudiantes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombres, $Apellidos, $Cedula, $Direccion, $Telefono, $Email) //insert into estudiantes (Nombres, Apellidos, Cedula, Direccion, Telefono, Email) values ($Nombres, $Apellidos, $Cedula, $Direccion, $Telefono, $Email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `estudiantes` ( `Nombres`, `Apellidos`, `Cedula`, `Direccion`, `Telefono`, `Email`) VALUES ('$Nombres', '$Apellidos', '$Cedula', '$Direccion', '$Telefono', '$Email')";
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
    public function actualizar($idEstudiantes, $Nombres, $Apellidos, $Cedula, $Direccion, $Telefono, $Email) //update estudiantes set Nombres = $Nombres, Apellidos = $Apellidos, Cedula = $Cedula, Direccion = $Direccion, Telefono = $Telefono, Email = $Email where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `estudiantes` SET `Nombres`='$Nombres',`Apellidos`='$Apellidos', `Cedula`='$Cedula', `Direccion`='$Direccion', `Telefono`='$Telefono', `Email`='$Email' WHERE `idEstudiantes` = $idEstudiantes";
            if (mysqli_query($con, $cadena)) {
                return $idEstudiantes;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idEstudiantes) //delete from estudiantes where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `estudiantes` WHERE `idEstudiantes`= $idEstudiantes";
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