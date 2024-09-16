<?php
//TODO: Clase de kardex
require_once('../config/config.php');
class Kardex
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from kardex
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `kardex`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idKardex) //select * from kardex where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `kardex` WHERE `idKardex`=$idKardex";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Estado, $Fecha_Transaccion, $Cantidad, $Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion) //INSERT INTO `kardex`(`idKardex`, `Estado`, `Fecha_Transaccion`, `Cantidad`, `Valor_Compra`, `Valor_Venta`, `Unidad_Medida_idUnidad_Medida`, `Unidad_Medida_idUnidad_Medida1`, `Unidad_Medida_idUnidad_Medida2`, `Valor_Ganacia`, `IVA`, `IVA_idIVA`, `Proveedores_idProveedores`, `Productos_idProductos`, `Tipo_Transaccion`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]')
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `kardex` (`Estado`, `Fecha_Transaccion`, `Cantidad`, `Valor_Compra`, `Valor_Venta`, `Unidad_Medida_idUnidad_Medida`, `Unidad_Medida_idUnidad_Medida1`, `Unidad_Medida_idUnidad_Medida2`, `Valor_Ganacia`, `IVA`, `IVA_idIVA`, `Proveedores_idProveedores`, `Productos_idProductos`, `Tipo_Transaccion`) VALUES ($Estado, $Fecha_Transaccion, $Cantidad, $Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion)";
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
    public function actualizar($idKardex, $Estado, $Fecha_Transaccion, $Cantidad, $Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion) //UPDATE `kardex` SET `idKardex`='[value-1]',`Estado`='[value-2]',`Fecha_Transaccion`='[value-3]',`Cantidad`='[value-4]',`Valor_Compra`='[value-5]',`Valor_Venta`='[value-6]',`Unidad_Medida_idUnidad_Medida`='[value-7]',`Unidad_Medida_idUnidad_Medida1`='[value-8]',`Unidad_Medida_idUnidad_Medida2`='[value-9]',`Valor_Ganacia`='[value-10]',`IVA`='[value-11]',`IVA_idIVA`='[value-12]',`Proveedores_idProveedores`='[value-13]',`Productos_idProductos`='[value-14]',`Tipo_Transaccion`='[value-15]' WHERE 1
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `kardex` SET `Estado`='$Estado',`Fecha_Transaccion`='$Fecha_Transaccion',`Cantidad`='$Cantidad',`Valor_Compra`='$Valor_Compra',`Valor_Venta`='$Valor_Venta', `Unidad_Medida_idUnidad_Medida`='$Unidad_Medida_idUnidad_Medida',`Unidad_Medida_idUnidad_Medida1`='$Unidad_Medida_idUnidad_Medida1',`Unidad_Medida_idUnidad_Medida2`='$Unidad_Medida_idUnidad_Medida2', `Valor_Ganacia`='$Valor_Ganacia',`IVA`='$IVA', `IVA_idIVA`='$IVA_idIVA',`Proveedores_idProveedores`='$Proveedores_idProveedores',`Productos_idProductos`='$Productos_idProductos',`Tipo_Transaccion`='$Tipo_Transaccion WHERE `idKardex` = $idKardex";
            if (mysqli_query($con, $cadena)) {
                return $idKardex;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idKardex) //DELETE FROM `kardex` WHERE $idKardex
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `kardex` WHERE `idKardex`= $idKardex";
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