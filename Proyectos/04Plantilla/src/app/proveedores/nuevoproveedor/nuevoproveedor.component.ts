import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Iproveedor } from 'src/app/Interfaces/iproveedor';
import { ProveedorService } from 'src/app/Services/proveedores.service';

@Component({
  selector: 'app-nuevoproveedor',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevoproveedor.component.html',
  styleUrl: './nuevoproveedor.component.scss'
})
export class NuevoproveedorComponent implements OnInit {
  titulo = "Insertar Proveedor";
  idproveedores = 0;
  Nombre_Empresa: any;
  Direccion;
  Telefono;
  Contacto_Empresa;
  Teleofno_Contacto;

  constructor(
    private proveedorServicio: ProveedorService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) { }
  ngOnInit(): void {
    this.idproveedores = parseInt(this.ruta.snapshot.paramMap.get('id'));
    /*this.ruta.paramMap.subscribe((parametros) => {
      this.idproveedores = parseInt(parametros.get('id'));
    });*/
    if (this.idproveedores > 0) {
      this.proveedorServicio
        .uno(this.idproveedores)
        .subscribe((proveedor) => {
          console.log(proveedor);
          this.Nombre_Empresa = proveedor.Nombre_Empresa;
          this.Direccion = proveedor.Direccion;
          this.Telefono = proveedor.Telefono;
          this.Contacto_Empresa = proveedor.Contacto_Empresa;
          this.Teleofno_Contacto = proveedor.Teleofno_Contacto;
          this.titulo = 'Actualizar Proveedor';
        });
    }
  }

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
    console.log(this.idproveedores);
    if (this.idproveedores == 0 || isNaN(this.idproveedores)) {

      this.proveedorServicio.insertar(iproveedor).subscribe(
        (respuesta) => {
          // parseInt(respuesta) > 1 ? alert("Grabado con éxito") : alert("Error al grabar");
          if (parseInt(respuesta) > 1) {
            alert("Grabado con éxito");
            this.navegacion.navigate(['/proveedores']);
          } else {
            alert("Error al grabar");
          }
        });
    } else {
      iproveedor.idProveedores = this.idproveedores;
      this.proveedorServicio.actualizar(iproveedor).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          this.idproveedores = 0;
          alert('Actualizado con éxito');
          this.navegacion.navigate(['/proveedores']);
        } else {
          alert('Error al actualizar');
        }
      });


    }
  }
}
