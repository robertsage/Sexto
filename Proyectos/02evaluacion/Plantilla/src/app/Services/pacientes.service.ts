import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Ipaciente } from '../Interfaces/ipaciente';

@Injectable({
  providedIn: 'root'
})
export class PacientesService {
  apiurl =
    'http://localhost/sexto/Proyectos/02evaluacion/controllers/pacientes.controller.php?op=';

  constructor(private lector: HttpClient) { }

  todos(): Observable<Ipaciente[]> {
    // console.log(this.apiurl + 'todos');
    return this.lector.get<Ipaciente[]>(this.apiurl + 'todos');
  }
  uno(idPaciente: number): Observable<Ipaciente> {
    const formData = new FormData();
    formData.append('idPacientes', idPaciente.toString());
    return this.lector.post<Ipaciente>(this.apiurl + 'uno', formData);
  }
  eliminar(idPaciente: number): Observable<number> {
    const formData = new FormData();
    formData.append('idPacientes', idPaciente.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(paciente: Ipaciente): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', paciente.Nombre);
    formData.append('Apellido', paciente.Apellido);
    formData.append('Direccion', paciente.Direccion);
    formData.append('Telefono', paciente.Telefono);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(paciente: Ipaciente): Observable<string> {
    const formData = new FormData();
    formData.append('idPacientes', paciente.idPacientes.toString());
    formData.append('Nombre', paciente.Nombre);
    formData.append('Apellido', paciente.Apellido);
    formData.append('Direccion', paciente.Direccion);
    formData.append('Telefono', paciente.Telefono);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
