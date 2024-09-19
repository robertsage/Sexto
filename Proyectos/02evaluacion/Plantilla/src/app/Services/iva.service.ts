import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Iiva } from '../Interfaces/iiva';

@Injectable({
  providedIn: 'root',
})
export class IvaService {
  apiurl = 'http://localhost/sexto/Proyectos/03MVC/controllers/iva.controller.php?op=';

  constructor(private lector: HttpClient) {}

  todos(): Observable<Iiva[]> {
    return this.lector.get<Iiva[]>(this.apiurl + 'todos');
  }

  uno(idIVA: number): Observable<Iiva> {
    const formData = new FormData();
    formData.append('idIVA', idIVA.toString());
    return this.lector.post<Iiva>(this.apiurl + 'uno', formData);
  }

  eliminar(idIVA: number): Observable<number> {
    const formData = new FormData();
    formData.append('idIVA', idIVA.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(iva: Iiva): Observable<string> {
    const formData = new FormData();
    formData.append('Detalle', iva.Detalle);
    formData.append('Estado', iva.Estado.toString());
    formData.append('Valor', iva.Valor.toString());
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(iva: Iiva): Observable<string> {
    const formData = new FormData();
    formData.append('idIVA', iva.idIVA.toString());
    formData.append('Detalle', iva.Detalle);
    formData.append('Estado', iva.Estado.toString());
    formData.append('Valor', iva.Valor.toString());
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}