<?php
//TODO: Clase de Medicos
require_once('../config/config.php');
class Medicos
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from medicos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `medicos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idMedicos) //select * from medicos where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `medicos` WHERE `idMedicos`=$idMedicos";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombres, $Especialidad, $Telefono, $Email) //insert into medicos (nombres, especialidad, telefono, email) values ($nombres, $especialidad, $telefono, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `medicos` ( `Nombres`, `Especialidad`, `Telefono`, `Email`) VALUES ('$Nombres','$Especialidad', '$Telefono','$Email')";
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
    public function actualizar($idMedicos, $Nombres, $Especialidad, $Telefono, $Email) //update medicos set nombres = $nombres, especialidad = $especialidad, telefono = $telefono, email = $email where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `medicos` SET `Nombres`='$Nombres', `Especialidad`='$Especialidad', `Telefono`='$Telefono',`Email`='$Email' WHERE `idMedicos` = $idMedicos";
            if (mysqli_query($con, $cadena)) {
                return $idMedicos;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idMedicos) //delete from medicos where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `medicos` WHERE `idMedicos`= $idMedicos";
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