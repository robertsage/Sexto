<?php
//TODO: Clase de Pacientes
require_once('../config/config.php');
class Pacientes
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from pacientes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `pacientes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idPacientes) //select * from provedores where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `pacientes` WHERE `idPacientes`=$idPacientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre, $Apellido, $Direccion, $Telefono) //insert into pacientes (nombre, apellido, direccion, telefono) values ($nombre, $apellido, $direccion, $telefono)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `pacientes` ( `Nombre`, `Apellido`, `Direccion`, `Telefono`) VALUES ('$Nombre','$Apellido', '$Direccion','$Telefono')";
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
    public function actualizar($idPacientes, $Nombre, $Apellido, $Direccion, $Telefono) //update pacientes set nombre = $nombre, apellido = $apellido, direccion = $direccion, telefono = $telefono where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `pacientes` SET `Nombre`='$Nombre', `Apellido`='$Apellido', `Direccion`='$Direccion',`Telefono`='$Telefono' WHERE `idPacientes` = $idPacientes";
            if (mysqli_query($con, $cadena)) {
                return $idPacientes;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idPacientes) //delete from pacientes where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `pacientes` WHERE `idPacientes`= $idPacientes";
            //echo $cadena;
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