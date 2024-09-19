<?php
// TODO: Clase de Factura Tienda Cel@g
require_once('../config/config.php');

class Factura
{
    public function todos() // select * from factura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT factura.idFactura, clientes.Nombres, (factura.Sub_total + factura.Sub_total_iva) as total FROM `factura` INNER JOIN clientes on factura.Clientes_idClientes = clientes.idClientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
    public function unoFacDet($idFactura) // select * from factura where id = $idFactura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT
                    df.idDetalle_Factura as idDetalle_Factura_d,
                    f.idFactura AS idFactura,
                    f.Fecha AS Fecha,
                    c.Cedula as Cedula,
                    c.Nombres AS Nombres,
                    c.Direccion AS Direccion,
                    c.Telefono as Telefono,
                    c.Correo as Correo,
                    f.Sub_total as Sub_total_f,
                    f.Valor_IVA as Valor_IVA_f,
                    f.Sub_total_iva as Sub_total_iva_f,
                    P.idProductos as idProductos,
                    P.Nombre_Producto as Nombre_Producto,
                    
                    df.Cantidad as Cantidad ,
                    df.Precio_Unitario as Precio_Unitario_d,
                    df.Sub_Total_item as Sub_Total_item_d ,
                    i.Valor as Porcentaje_iva
                FROM
                    `factura` f
                JOIN `clientes` c ON
                    c.idClientes = f.Clientes_idClientes
                JOIN `detalle_factura` df ON
                    df.Factura_idFactura = f.idFactura
                JOIN `kardex` k ON
                    k.idKardex = df.Kardex_idKardex
                JOIN `productos` p ON
                    p.idProductos = k.Productos_idProductos
                JOIN `iva` i ON
                    i.idIVA = k.IVA_idIVA
                WHERE
                    f.idFactura = $idFactura AND k.Estado = 1";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

/*    

public function uno($idFactura) // select * from factura where id = $idFactura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `factura` INNER JOIN clientes on factura.Clientes_idClientes = clientes.idClientes WHERE `idFactura` = $idFactura";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
        
    */

    public function insertar($Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes) // insert into factura (Fecha, Sub_total, Sub_total_iva, Valor_IVA, Clientes_idClientes) values (...)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `factura`(`Fecha`, `Sub_total`, `Sub_total_iva`, `Valor_IVA`, `Clientes_idClientes`) 
                       VALUES ('$Fecha', '$Sub_total', '$Sub_total_iva', '$Valor_IVA', '$Clientes_idClientes')";
            //echo $cadena;
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($idFactura, $Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes) // update factura set ... where id = $idFactura
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `factura` SET 
                       `Fecha`='$Fecha',
                       `Sub_total`='$Sub_total',
                       `Sub_total_iva`='$Sub_total_iva',
                       `Valor_IVA`='$Valor_IVA',
                       `Clientes_idClientes`='$Clientes_idClientes'
                       WHERE `idFactura` = $idFactura";
            if (mysqli_query($con, $cadena)) {
                return $idFactura; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idFactura) // delete from factura where id = $idFactura
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `factura` WHERE `idFactura`= $idFactura";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
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