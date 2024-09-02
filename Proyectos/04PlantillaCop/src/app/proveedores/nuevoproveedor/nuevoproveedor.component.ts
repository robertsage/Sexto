import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Iproveedor } from 'src/app/Interfaces/iproveedor';
import { ProveedorService } from 'src/app/Services/proveedores.service';

@Component({
  selector: 'app-nuevoproveedor',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevoproveedor.component.html',
  styleUrl: './nuevoproveedor.component.scss'
})
export class NuevoproveedorComponent {
  titulo = "Insertar Proveedor";
  Nombre_Empresa: any;
  Direccion;
  Telefono;
  Contacto_Empresa;
  Teleofno_Contacto;

  constructor(private proveedorServicio: ProveedorService) { }

  limpiarcaja() {
    alert('Limpiar Caja');
  }
  grabar() {
    let iproveedor: Iproveedor = {
      idProveedores: 0,
      Nombre_Empresa: this.Nombre_Empresa,
      Direccion: this.Direccion,
      Telefono: this.Telefono,
      Contacto_Empresa: this.Contacto_Empresa,
      Teleofno_Contacto: this.Teleofno_Contacto
    };
    this.proveedorServicio.insertar(iproveedor).subscribe(
      (respuesta) => {
        parseInt(respuesta) > 1 ? alert("Grabado con éxito") : alert("Error al grabar");
      }
    )
  }
}
