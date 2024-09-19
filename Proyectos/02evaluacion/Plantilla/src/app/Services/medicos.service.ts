import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Imedico } from '../Interfaces/imedico';

@Injectable({
  providedIn: 'root'
})
export class MedicosService {
  apiurl =
    'http://localhost/sexto/Proyectos/02evaluacion/controllers/medicos.controller.php?op=';

  constructor(private lector: HttpClient) { }

  todos(): Observable<Imedico[]> {
    // console.log(this.apiurl + 'todos');
    return this.lector.get<Imedico[]>(this.apiurl + 'todos');
  }
  uno(idMedico: number): Observable<Imedico> {
    const formData = new FormData();
    formData.append('idMedicos', idMedico.toString());
    return this.lector.post<Imedico>(this.apiurl + 'uno', formData);
  }
  eliminar(idMedico: number): Observable<number> {
    const formData = new FormData();
    formData.append('idMedicos', idMedico.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(medico: Imedico): Observable<string> {
    const formData = new FormData();
    formData.append('Nombres', medico.Nombres);
    formData.append('Especialidad', medico.Especialidad);
    formData.append('Telefono', medico.Telefono);
    formData.append('Email', medico.Email);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(medico: Imedico): Observable<string> {
    const formData = new FormData();
    formData.append('idMedicos', medico.idMedicos.toString());
    formData.append('Nombres', medico.Nombres);
    formData.append('Especialidad', medico.Especialidad);
    formData.append('Telefono', medico.Telefono);
    formData.append('Email', medico.Email);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
