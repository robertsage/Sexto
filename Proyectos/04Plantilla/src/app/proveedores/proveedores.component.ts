import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { Iproveedor } from '../Interfaces/iproveedor';
import { ProveedorService } from '../Services/proveedores.service';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
@Component({
  selector: 'app-proveedores',
  standalone: true,
  imports: [SharedModule, FormsModule, RouterLink],
  templateUrl: './proveedores.component.html',
  styleUrl: './proveedores.component.scss'
})
export class ProveedoresComponent {
  title = 'Lista de Proveedores';

  listaProveedores: Iproveedor[] = [];
  constructor(private ServicioProveedor: ProveedorService) { }
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.ServicioProveedor.todos().subscribe(
      (data) => {
        //console.log(this.listaProveedores); 
        //console.log(data); para llenar la lista de proveedores e imprimir
        this.listaProveedores = data;
      }
    );
  }
  eliminar(idProveedor: number) {
    //alert(idProveedor); para probar si está llegando la solicitud de eliminacion
    this.ServicioProveedor.eliminar(idProveedor).subscribe((data) => {
      this.cargatabla();
    });
  }
}
