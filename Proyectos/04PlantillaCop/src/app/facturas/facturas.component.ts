import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { Ifactura } from '../Interfaces/ifactura';
import { FacturasService } from '../Services/facturas.service';
import { RouterLink } from '@angular/router';
@Component({
  selector: 'app-facturas',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './facturas.component.html',
  styleUrl: './facturas.component.scss'
})
export class FacturasComponent {
  title = 'Lista de Facturas';

  listaFacturas: Ifactura[] = [];
  constructor(private ServicioFactura: FacturasService) { }
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.ServicioFactura.todos().subscribe(
      (data) => {
        //console.log(this.listaFacturas); 
        //console.log(data); para llenar la lista de facturas e imprimir
        this.listaFacturas = data;
      }
    );
  }
  eliminar(idFactura: number) {
    //alert(idFactura); para probar si está llegando la solicitud de eliminacion
    this.ServicioFactura.eliminar(idFactura).subscribe((data) => {
      this.cargatabla();
    });
  }

}
