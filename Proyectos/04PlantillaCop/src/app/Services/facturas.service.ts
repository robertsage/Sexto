import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Ifactura } from '../Interfaces/ifactura';

@Injectable({
  providedIn: 'root'
})
export class FacturasService {
  apiurl =
    'http://localhost/sexto/proyectos/03MVC/controllers/factura.controller.php?op=';

  constructor(private lector: HttpClient) { }

  todos(): Observable<Ifactura[]> {
    // console.log(this.apiurl + 'todos');
    return this.lector.get<Ifactura[]>(this.apiurl + 'todos');
  }
  uno(idFactura: number): Observable<Ifactura> {
    const formData = new FormData();
    formData.append('idf', idFactura.toString());
    return this.lector.post<Ifactura>(this.apiurl + 'uno', formData);
  }
  eliminar(idFactura: number): Observable<number> {
    const formData = new FormData();
    formData.append('idFactura', idFactura.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(factura: Ifactura): Observable<Ifactura> {
    const formData = new FormData();
    formData.append('Fecha', factura.Fecha);
    formData.append('Sub_total', factura.Sub_total.toString());
    formData.append('Sub_total_iva', factura.Sub_total_iva.toString());
    formData.append('Valor_IVA', factura.Valor_IVA.toString());
    formData.append('Clientes_idClientes', factura.Clientes_idClientes.toString());
    return this.lector.post<Ifactura>(this.apiurl + 'insertar', formData);
  }
  actualizar(factura: Ifactura): Observable<Ifactura> {
    const formData = new FormData();
    formData.append('idFactura', factura.idFactura.toString());
    formData.append('Fecha', factura.Fecha);
    formData.append('Sub_total', factura.Sub_total.toString());
    formData.append('Sub_total_iva', factura.Sub_total_iva.toString());
    formData.append('Valor_IVA', factura.Valor_IVA.toString());
    formData.append('Clientes_idClientes', factura.Clientes_idClientes.toString());
    return this.lector.post<Ifactura>(this.apiurl + 'insertar', formData);
  }
}
