import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Iconsulta } from '../Interfaces/iconsulta';

@Injectable({
  providedIn: 'root'
})
export class ConsultasService {
  apiurl = 'http://localhost/sexto/Proyectos/02evaluacion/controllers/consultas.controller.php?op=';
  apiUrl = 'http://localhost/sexto/Proyectos/02evaluacion/reports/consultas.report.php';

  constructor(private lector: HttpClient) {}

  todos(): Observable<Iconsulta[]> {
    return this.lector.get<Iconsulta[]>(this.apiurl + 'todos');
  }

  uno(idConsulta: number): Observable<Iconsulta> {
    const formData = new FormData();
    formData.append('idConsultas', idConsulta.toString());
    return this.lector.post<Iconsulta>(this.apiurl + 'uno', formData);
  }

  eliminar(idConsulta: number): Observable<number> {
    const formData = new FormData();
    formData.append('idConsultas', idConsulta.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(consulta: Iconsulta): Observable<string> {
    const formData = new FormData();
    formData.append('Fecha', consulta.Fecha);
    formData.append('Descripcion', consulta.Descripcion.toString());
    formData.append('Medico', consulta.Medico.toString());
    formData.append('NombrePaciente', consulta.NombrePaciente.toString());
    formData.append('ApellidoPaciente', consulta.ApellidoPaciente.toString());
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(consulta: Iconsulta): Observable<string> {
    const formData = new FormData();
    formData.append('idConsultas', consulta.idConsultas.toString());
    formData.append('Fecha', consulta.Fecha);
    formData.append('Descripcion', consulta.Descripcion);
    formData.append('Medico', consulta.Medico.toString());
    formData.append('NombrePaciente', consulta.NombrePaciente.toString());
    formData.append('ApellidoPaciente', consulta.ApellidoPaciente.toString());
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
   // Método para generar el reporte
   generarReporteConsultas(): Observable<Blob> {
    return this.lector.get(this.apiUrl, { responseType: 'blob' });
  }
}
