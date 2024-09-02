import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Iproducto } from '../Interfaces/iproducto';

@Injectable({
  providedIn: 'root'
})
export class ProductosService {
  apiurl =
    'http://localhost/sexto/proyectos/03MVC/controllers/productos.controller.php?op=';

  constructor(private lector: HttpClient) { }

  todos(): Observable<Iproducto[]> {
    // console.log(this.apiurl + 'todos');
    return this.lector.get<Iproducto[]>(this.apiurl + 'todos');
  }
  uno(idProducto: number): Observable<Iproducto> {
    const formData = new FormData();
    formData.append('idProductos', idProducto.toString());
    return this.lector.post<Iproducto>(this.apiurl + 'uno', formData);
  }
  eliminar(idProducto: number): Observable<number> {
    const formData = new FormData();
    formData.append('idProductos', idProducto.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(producto: Iproducto): Observable<Iproducto> {
    const formData = new FormData();
    formData.append('Codigo_Barras', producto.Codigo_Barras);
    formData.append('Nombre_Producto', producto.Nombre_Producto);
    formData.append('Graba_IVA', producto.Graba_IVA.toString());
    return this.lector.post<Iproducto>(this.apiurl + 'insertar', formData);
  }
  actualizar(producto: Iproducto): Observable<Iproducto> {
    const formData = new FormData();
    formData.append('idProductos', producto.idProductos.toString());
    formData.append('Codigo_Barras', producto.Codigo_Barras);
    formData.append('Nombre_Producto', producto.Nombre_Producto);
    formData.append('Graba_IVA', producto.Graba_IVA.toString());
    return this.lector.post<Iproducto>(this.apiurl + 'insertar', formData);
  }
}
