import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { ICliente } from '../Interfaces/icliente';
import { ClientesService } from '../Services/clientes.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [SharedModule, FormsModule, RouterLink],
  templateUrl: './clientes.component.html',
  styleUrl: './clientes.component.scss'
})
export class ClientesComponent {
  listaClientes: ICliente[] = [];
  constructor(private ServicioCliente: ClientesService) {}
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.ServicioCliente.todos().subscribe((data) => {
      //console.log(this.listaClientes);
      //console.log(data); para llenar la lista de clientes e imprimir
      this.listaClientes = data;
    });
  }
  eliminar(idcliente: number) {
    Swal.fire({
      title: 'Clientes',
      text: 'Está seguro que desea eliminar el cliente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Cliente'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServicioCliente.eliminar(idcliente).subscribe((data) => {
          Swal.fire('Clientes', 'El cliente ha sido eliminado', 'success');
          this.cargatabla();
        });
      }
    });
    //alert(idCliente); para probar si está llegando la solicitud de eliminacion
  }
}
