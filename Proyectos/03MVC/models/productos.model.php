<?php
// TODO: Clase de Producto
require_once('../config/config.php');

class Producto
{
    public function todos() // select * from productos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "
        SELECT
            p.idProductos,
            p.Codigo_Barras,
            p.Nombre_Producto,
            p.Graba_IVA,
            u.Detalle AS Unidad_Medida,
            i.Detalle AS IVA_Detalle,
            k.Cantidad,
            k.Fecha_Transaccion,
            k.Valor_Compra,
            k.Valor_Venta,
            k.Tipo_Transaccion,
            k.idKardex
        FROM
            `Productos` p
        INNER JOIN `Kardex` k ON
            p.idProductos = k.Productos_idProductos
        INNER JOIN `Unidad_Medida` u ON
            k.Unidad_Medida_idUnidad_Medida = u.idUnidad_Medida
        INNER JOIN `IVA` i ON
            k.IVA_idIVA = i.idIVA
        WHERE
            k.`Estado` = 1;
";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idProductos,$idKardex) // select * from productos where id = $idProductos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT
            p.idProductos,
            p.Codigo_Barras,
            p.Nombre_Producto,
            p.Graba_IVA,
            u.idUnidad_Medida AS Unidad_Medida_idUnidad_Medida,
            u.Detalle AS Unidad_Medida,
            i.idIVA AS IVA_idIVA,
            i.Detalle AS IVA_Detalle,
            k.Cantidad,
            k.Fecha_Transaccion,
            k.Valor_Compra,
            k.Valor_Venta,
            k.Tipo_Transaccion, 
            k.Proveedores_idProveedores,
            k.idKardex

        FROM
            `Productos` p
        INNER JOIN `Kardex` k ON
            p.idProductos = k.Productos_idProductos
        INNER JOIN `Unidad_Medida` u ON
            k.Unidad_Medida_idUnidad_Medida = u.idUnidad_Medida
        INNER JOIN `IVA` i ON
            k.IVA_idIVA = i.idIVA
        WHERE
            k.`Estado` = 1
            and p.idProductos=$idProductos
            AND k.idKardex =$idKardex";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Codigo_Barras, $Nombre_Producto, $Graba_IVA, $Unidad_Medida_idUnidad_Medida, $IVA_idIVA, $Cantidad, $Valor_Compra, $Valor_Venta, $Proveedores_idProveedores)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();

            // Insertar el producto
            $cadenaProducto = "INSERT INTO `Productos`(`Codigo_Barras`, `Nombre_Producto`, `Graba_IVA`) 
                               VALUES ('$Codigo_Barras', '$Nombre_Producto', '$Graba_IVA')";

            if (mysqli_query($con, $cadenaProducto)) {
                $productoId = $con->insert_id; // Obtener el ID del producto recién creado

                // Insertar el Kardex asociado al producto
                $cadenaKardex = "INSERT INTO `Kardex`(`Estado`, `Fecha_Transaccion`, `Cantidad`, `Valor_Compra`, `Valor_Venta`, `Unidad_Medida_idUnidad_Medida`, `Unidad_Medida_idUnidad_Medida1`, `Unidad_Medida_idUnidad_Medida2`, `IVA`, `IVA_idIVA`, `Proveedores_idProveedores`, `Productos_idProductos`, `Tipo_Transaccion`)
                                 VALUES (1, NOW(), '$Cantidad', '$Valor_Compra', '$Valor_Venta', '$Unidad_Medida_idUnidad_Medida', '$Unidad_Medida_idUnidad_Medida', '$Unidad_Medida_idUnidad_Medida', '$IVA_idIVA', '$IVA_idIVA', '$Proveedores_idProveedores', '$productoId', 1)";

                if (mysqli_query($con, $cadenaKardex)) {
                    return $productoId; // Éxito, devolver el ID del producto
                } else {
                    return $con->error; // Error en el Kardex
                }
            } else {
                return $con->error; // Error en el producto
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

   /* public function actualizar($idProductos, $Codigo_Barras, $Nombre_Producto, $Graba_IVA) // update productos set ... where id = $idProductos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `Productos` SET 
                       `Codigo_Barras`='$Codigo_Barras',
                       `Nombre_Producto`='$Nombre_Producto',
                       `Graba_IVA`='$Graba_IVA'
                       WHERE `idProductos` = $idProductos";
            if (mysqli_query($con, $cadena)) {
                return $idProductos; // Éxito, devolver el ID actualizado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }*/
    public function actualizar($idProductos, $Codigo_Barras, $Nombre_Producto, $Graba_IVA, $Unidad_Medida_idUnidad_Medida, $IVA_idIVA, $Cantidad, $Valor_Compra, $Valor_Venta, $Proveedores_idProveedores, $idKardex) // update productos set ... where id = $idProductos
{
    try {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        // print_r("aqui ide kardex ". $idKardex. " y codigo barras =   " . $Codigo_Barras . "      .  ");

        // Actualizar el producto
        $cadenaProducto = "UPDATE `Productos` SET 
                           `Codigo_Barras`='$Codigo_Barras',
                           `Nombre_Producto`='$Nombre_Producto',
                           `Graba_IVA`='$Graba_IVA'
                           WHERE `idProductos` = $idProductos";

        if (mysqli_query($con, $cadenaProducto)) {
            // print_r("ingreso actualizar kardex   ". $idKardex. "         ---      ");
            // Actualizar el Kardex asociado al producto
            $cadenaKardex = "UPDATE `Kardex` SET 
                             `Cantidad`='$Cantidad',
                             `Valor_Compra`='$Valor_Compra',
                             `Valor_Venta`='$Valor_Venta',
                             `Unidad_Medida_idUnidad_Medida`='$Unidad_Medida_idUnidad_Medida',
                             `IVA_idIVA`='$IVA_idIVA',
                             `Proveedores_idProveedores`='$Proveedores_idProveedores',
                             `Fecha_Transaccion`=NOW()
                             WHERE `Productos_idProductos` = $idProductos AND `Estado`=1 
                             AND `idKardex` = $idKardex";

            if (mysqli_query($con, $cadenaKardex)) {
                return $idProductos; // Éxito, devolver el ID actualizado
            } else {
                return $con->error; // Error en la actualización del Kardex
            }
        } else {
            return $con->error; // Error en la actualización del producto
        }
    } catch (Exception $th) {
        return $th->getMessage();
    } finally {
        $con->close();
    }
}


    public function eliminar($idProductos) // delete from productos where id = $idProductos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `kardex` SET `Estado`=0 WHERE `Productos_idProductos`=$idProductos";
            if (mysqli_query($con, $cadena)) {
                return 1; // Éxito
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