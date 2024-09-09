import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, Event, ActivatedRoute } from '@angular/router';
import { ICliente } from 'src/app/Interfaces/icliente';
import { IFactura } from 'src/app/Interfaces/ifactura';
import { ClientesService } from 'src/app/Services/clientes.service';
import { FacturaService } from 'src/app/Services/factura.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevafactura',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './nuevafactura.component.html',
  styleUrl: './nuevafactura.component.scss'
})
export class NuevafacturaComponent implements OnInit {
  //variables o constantes
  titulo = 'Nueva Factura';
  listaClientes: ICliente[] = [];
  listaClientesFiltrada: ICliente[] = [];
  totalapagar: number = 0;
  idFactura = 0;
  cliente: ICliente;
  //formgroup
  frm_factura: FormGroup;

  ///////
  constructor(
    private clietesServicios: ClientesService,
    private facturaService: FacturaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.idFactura = parseInt(this.ruta.snapshot.paramMap.get('idfactura'));
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
        this.frm_factura.controls['Fecha'].setValue(this.cambiarFormatFecha(unaFactura.Fecha));
        this.frm_factura.controls['Sub_total'].setValue(unaFactura.Sub_total);
        this.frm_factura.controls['Sub_total_iva'].setValue(unaFactura.Sub_total_iva);
        this.frm_factura.controls['Valor_IVA'].setValue(unaFactura.Valor_IVA);
        this.frm_factura.controls['Clientes_idClientes'].setValue(unaFactura.Clientes_idClientes);
        this.calculos();
        this.titulo = 'Editar Factura';
        this.cliente = this.obtenerCLiente(this.frm_factura.controls['Clientes_idClientes'].value);
      });
    }
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

    Swal.fire({
      title: 'Factura',
      text: 'Desea guardar los cambios en la Factura del Cliente ',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idFactura > 0) {
          this.facturaService.actualizar(factura).subscribe((res: any) => {
            Swal.fire({
              title: 'Factura',
              text: res.mensaje,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/facturas']);
          });
        } else {
          this.facturaService.insertar(factura).subscribe((res: any) => {
            Swal.fire({
              title: 'Factura',
              text: res.mensaje,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/facturas']);
          });
        }
      }
    });
  }

  eliminar() {
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
        this.facturaService.eliminar(this.idFactura).subscribe((res: any) => {
          Swal.fire({
            title: 'Factura Eliminada',
            text: res.mensaje,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          });
          this.navegacion.navigate(['/facturas']);
        });
      }
    });
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
    this.obtenerCLiente(idCliente);
  }

  cambiarFormatFecha(fecha: string): string {
    return fecha.split(' ')[0]; // Esto toma solo la parte YYYY-MM-DD
  }

  obtenerCLiente(idCliente: number) {
    const cliente = this.listaClientes.find((cliente) => cliente.idClientes == idCliente);
    return cliente;
  }
}