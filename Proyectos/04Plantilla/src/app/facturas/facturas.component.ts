import { Component, OnInit } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { Router, RouterLink } from '@angular/router';
import { FacturaService } from '../Services/factura.service';
import { IFactura } from '../Interfaces/ifactura';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-facturas',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './facturas.component.html',
  styleUrl: './facturas.component.scss'
})
export class FacturasComponent implements OnInit {
  listaFacturas: IFactura[] = [];
  constructor(private facturaServicio: FacturaService,
    private navegacion: Router,
  ) {}
  ngOnInit(): void {
    this.cargarFacturas();
  }

  cargarFacturas() {
    this.facturaServicio.todos().subscribe((data: IFactura[]) => {
      this.listaFacturas = data;
      this.ordenerFacturas();
    });
  }
  ordenerFacturas() {
    this.listaFacturas.sort((a, b) => a.idFactura - b.idFactura);
  }

  eliminar(idFactura) {
    Swal.fire({
      title: 'Eliminar Factura',
      text: '¿Está seguro de que desea eliminar esta factura?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.facturaServicio.eliminar(idFactura).subscribe((res: any ) => {
          this.cargarFacturas();
          Swal.fire({
            title: 'Factura Eliminada',
            text: res.mensaje,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          });
          //this.navegacion.navigate(['/facturas']);
        });
      }
    });
  }

}