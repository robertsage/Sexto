<?php
//TODO: Clase de Consultas
require_once('../config/config.php');
class Consultas
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from consultas
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT c.idConsultas, c.Fecha, c.Descripcion, m.Nombres as Medico, p.Nombre as NombrePaciente, p.Apellido as ApellidoPaciente FROM `consultas` as c JOIN medicos as m on c.Medicos_idMedicos = m.idMedicos INNER JOIN pacientes as p on c.Pacientes_idPacientes = p.idPacientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function unoConsulDet($idConsultas) // select * from consultas where id = $idConsultas
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT                    
                    c.idConsultas AS idConsultas,
                    c.Fecha AS Fecha,
                    c.Descripcion as Descripcion,
                    m.Nombres as Nombres_Medico,
                    p.Nombre as Npombre_Paciente,
                    p.Apellido as Apellido_Paciente
                FROM
                    `consultas` c
                JOIN `medicos` m ON
                    m.idMedicos = c.Medicos_idMedicos
                JOIN `pacientes` p ON
                    p.idPacientes = c.Pacientes_idPacientes
                WHERE
                    c.idConsultas = $idConsultas";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

/*
    public function uno($idConsultas) //select * from consultas where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `consultas` WHERE `idConsultas`=$idConsultas";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
*/
    public function insertar($Fecha, $Descripcion, $Medicos_idMedicos, $Pacientes_idPacientes) //insert into consultas (fecha, especialidad, telefono, email) values ($nombres, $especialidad, $telefono, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `consultas` ( `Fecha`, `Descripcion`, `Medicos_idMedicos`, `Pacientes_idPacientes`) VALUES ('$Fecha','$Descripcion', '$Medicos_idMedicos','$Pacientes_idPacientes')";
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
    public function actualizar($idConsultas, $Fecha, $Descripcion, $Medicos_idMedicos, $Pacientes_idPacientes) //update consultas set fecha = $fecha, descripcion = $descripcion, Medicos_idMedicos = $Medicos_idMedicos, Pacientes_idPacientes = $Pacientes_idPacientes where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `consultas` SET `Fecha`='$Fecha', `Descripcion`='$Descripcion', `Medicos_idMedicos`='$Medicos_idMedicos',`Pacientes_idPacientes`='$Pacientes_idPacientes' WHERE `idConsultas` = $idConsultas";
            if (mysqli_query($con, $cadena)) {
                return $idConsultas;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idConsultas) //delete from consultas where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `consultas` WHERE `idConsultas`= $idConsultas";
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