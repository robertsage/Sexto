<?php
//TODO: Clase de Iva
require_once('../config/config.php');
class Iva
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from iva
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `iva`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idIVA) //select * from iva where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `iva` WHERE `idIVA`=$idIVA";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Detalle, $Estado, $Valor) //insert into iva (Detalle, Estado, Valor) values ($Detalle, $Estado, $Valor)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `iva` ( `Detalle`, `Estado`, `Valor`) VALUES ('$Detalle', '$Estado', '$Valor')";
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
    public function actualizar($idIVA, $Detalle, $Estado, $Valor) //update iva set Detalle = $Detalle, Estado = $Estado, Valor = $Valor where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `iva` SET `Detalle`='$Detalle',`Estado`='$Estado',`Valor`='$Valor' WHERE `idIVA` = $idIVA";
            if (mysqli_query($con, $cadena)) {
                return $idIVA;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idIVA) //delete from iva where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `iva` WHERE `idIVA`= $idIVA";
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