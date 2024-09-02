import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, Event, ActivatedRoute } from '@angular/router';
import { IFactura } from 'src/app/Interfaces/factura';
import { ICliente } from 'src/app/Interfaces/icliente';
import { ClientesService } from 'src/app/Services/clientes.service';
import { FacturaService } from 'src/app/Services/factura.service';

@Component({
  selector: 'app-nuevafactura',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './nuevafactura.component.html',
  styleUrl: './nuevafactura.component.scss'
})
export class NuevafacturaComponent implements OnInit {
  titulo = 'Nueva Factura';
  listaClientes: ICliente[] = [];
  listaClientesFiltrada: ICliente[] = [];
  totalapagar: number = 0;
  idFactura = 0;
  cliente: ICliente;
  frm_factura: FormGroup;

  constructor(
    private clietesServicios: ClientesService,
    private facturaService: FacturaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.idFactura = parseInt(this.ruta.snapshot.paramMap.get('idFactura'));
    this.frm_factura = new FormGroup({
      Fecha: new FormControl('', Validators.required),
      Sub_total: new FormControl('', Validators.required),
      Sub_total_iva: new FormControl('', Validators.required),
      Valor_IVA: new FormControl('0.15', Validators.required),
      Clientes_idClientes: new FormControl('', Validators.required)
    });

    this.clietesServicios.todos().subscribe({
      next: (data) => {
        this.listaClientes = data;
        this.listaClientesFiltrada = data;
      },
      error: (e) => {
        console.log(e);
      }
    });
    if (this.idFactura > 0) {
      this.facturaService.uno(this.idFactura).subscribe((unaFactura) => {
        console.log(unaFactura);
        this.frm_factura.controls['Fecha'].setValue(this.formato(unaFactura.Fecha));
        this.frm_factura.controls['Sub_total'].setValue(unaFactura.Sub_total);
        this.frm_factura.controls['Sub_total_iva'].setValue(unaFactura.Sub_total_iva);
        this.frm_factura.controls['Valor_IVA'].setValue(unaFactura.Valor_IVA);
        this.frm_factura.controls['Clientes_idClientes'].setValue(unaFactura.Clientes_idClientes);
        this.calculos();
        this.titulo = 'Editar Factura';
        this.cliente = this.listaClientes.find((cliente) => cliente.idClientes == this.frm_factura.controls['Clientes_idClientes'].value);
      });
    }
  }
  formato(fecha: string): string {
    return fecha.split(' ')[0];
  }

  grabar() {
    let factura: IFactura = {
      idFactura: this.idFactura,
      Fecha: this.frm_factura.get('Fecha')?.value,
      Sub_total: this.frm_factura.get('Sub_total')?.value,
      Sub_total_iva: this.frm_factura.get('Sub_total_iva')?.value,
      Valor_IVA: this.frm_factura.get('Valor_IVA')?.value,
      Clientes_idClientes: this.frm_factura.get('Clientes_idClientes')?.value
    };
    if (this.idFactura > 0) {
      this.facturaService.actualizar(factura).subscribe((res: any) => {
        alert('Factura actualizada');
        this.navegacion.navigate(['/facturas']);
      });
    } else {
      this.facturaService.insertar(factura).subscribe((res: any) => {
        alert('Factura grabada');
        this.navegacion.navigate(['/facturas']);
      });
    }
  }

  calculos() {
    let sub_total = this.frm_factura.get('Sub_total')?.value;
    let iva = this.frm_factura.get('Valor_IVA')?.value;
    let sub_total_iva = sub_total * iva;
    this.frm_factura.get('Sub_total_iva')?.setValue(sub_total_iva);
    this.totalapagar = parseInt(sub_total) + sub_total_iva;
  }

  cambio(objetoSleect: any) {
    let idCliente = objetoSleect.target.value;
    this.frm_factura.get('Clientes_idClientes')?.setValue(idCliente);
  }
}
