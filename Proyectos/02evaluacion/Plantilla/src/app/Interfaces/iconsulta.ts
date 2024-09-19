export interface Iconsulta {
    idConsultas?: number;
    Fecha: string;
    Descripcion: string;
    Medicos_idMedicos: number;
    Pacientes_idPacientes: number;
    Medico: string;
    NombrePaciente: string;
    ApellidoPaciente: string
  
    //son solo para mostrar informacion
    Nombres?: string;
    Nombre?: string;
    Apellido?: string;
}
