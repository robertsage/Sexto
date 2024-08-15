<?php
//TODO: Clase de Categorias
require_once('../config/config.php');
class Categorias
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from categorias
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `categorias`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idCategorias) //select * from categorias where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `categorias` WHERE `idCategorias`=$idCategorias";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre_Categoria, $Descripcion) //insert into categorias (nombre_categoria, descripcion) values ($Nombre_Categoria, $Descripcion)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `categorias` ( `Nombre_Categoria`, `Descripcion`) VALUES ('$Nombre_Categoria','$Descripcion')";
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
    public function actualizar($idCategorias, $Nombre_Categoria, $Descripcion) //update categorias set nombre_categoria = $nombre_categoria, descripcion = $descripcion where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `categorias` SET `Nombre_Categoria`='$Nombre_Categoria',`Descripcion`='$Descripcion' WHERE `idCategorias` = $idCategorias";
            if (mysqli_query($con, $cadena)) {
                return $idCategorias;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idCategorias) //delete from categorias where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `categorias` WHERE `idCategorias`= $idCategorias";
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