import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Iproveedor } from 'src/app/Interfaces/iproveedor';
import { Iiva } from 'src/app/Interfaces/iiva';
import { ProveedorService } from 'src/app/Services/proveedores.service';
import { UnidadmedidaService } from 'src/app/Services/unidadmedida.service';
import { IvaService } from 'src/app/Services/iva.service';
import { IProducto } from 'src/app/Interfaces/iproducto';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';
import { ProductoService } from 'src/app/Services/productos.service';
import { IUnidadMedida } from 'src/app/Interfaces/iunidadmedida';

@Component({
  selector: 'app-nuevoproducto',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './nuevoproducto.component.html',
  styleUrl: './nuevoproducto.component.scss'
})
export class NuevoproductoComponent implements OnInit {
  //titulo = 'Nuevo Producto';
  listaUnidadMedida: IUnidadMedida[] = [];
  listaProveedores: Iproveedor[] = [];
  listaIva: Iiva[] = [];
  titulo = '';
  idProductos = 0;
  idKardex = 0;
  //
  unidadmedida: IUnidadMedida;

  frm_Producto: FormGroup;
  constructor(
    private productoServicio: ProductoService,
    private uniadaServicio: UnidadmedidaService,
    private fb: FormBuilder,
    private proveedoreServicio: ProveedorService,
    private ivaServicio: IvaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}
  ngOnInit(): void {
    this.ruta.paramMap.subscribe(params => {
      this.idProductos = parseInt(params.get('idProducto'), 10);
      this.idKardex = parseInt(params.get('idKardex'), 10);
    });

    // this.idProductos = parseInt(this.ruta.snapshot.paramMap.get('idProducto'));
    
    this.uniadaServicio.todos().subscribe((data) => (this.listaUnidadMedida = data));
    this.proveedoreServicio.todos().subscribe((data) => (this.listaProveedores = data));
    this.ivaServicio.todos().subscribe((data) => (this.listaIva = data));
    
    this.crearFormulario();

    /*
1.- Modelo => Solo el procedieminto para realizar un select
2.- Controador => Solo el procedieminto para realizar un select
3.- Servicio => Solo el procedieminto para realizar un select
4.-  realizar el insertar y actualizar

*/

    if (this.idProductos > 0) {
      this.productoServicio.uno(this.idProductos, this.idKardex).subscribe((unProducto) => {
        // console.log(unProducto);
        this.frm_Producto.controls['Codigo_Barras'].setValue(unProducto.Codigo_Barras);
        this.frm_Producto.controls['Nombre_Producto'].setValue(unProducto.Nombre_Producto);
        this.frm_Producto.controls['Graba_IVA'].setValue(unProducto.Graba_IVA);
        this.frm_Producto.controls['Unidad_Medida_idUnidad_Medida'].setValue(unProducto.Unidad_Medida_idUnidad_Medida);
        this.frm_Producto.controls['IVA_idIVA'].setValue(unProducto.IVA_idIVA);
        this.frm_Producto.controls['Cantidad'].setValue(unProducto.Cantidad);
        this.frm_Producto.controls['Valor_Compra'].setValue(unProducto.Valor_Compra);
        this.frm_Producto.controls['Valor_Venta'].setValue(unProducto.Valor_Venta);
        this.frm_Producto.controls['Proveedores_idProveedores'].setValue(unProducto.Proveedores_idProveedores);
        this.frm_Producto.controls['idKardex'].setValue(unProducto.idKardex);
        this.titulo = 'Editar Factura';
        this.unidadmedida = this.obtenerUnidadMedida(this.frm_Producto.controls['Unidad_Medida_idUnidad_Medida'].value)
        // console.log('Unidad Medida:', this.unidadmedida);

      });
    }
  }

  crearFormulario() {
    /* this.frm_Producto = this.fb.group({
      Codigo_Barras: ['', Validators.required],
      Nombre_Producto: ['', Validators.required],
      Graba_IVA: ['', Validators.required],
      Unidad_Medida_idUnidad_Medida: ['', Validators.required],
      IVA_idIVA: ['', Validators.required],
      Cantidad: ['', [Validators.required, Validators.min(1)]],
      Valor_Compra: ['', [Validators.required, Validators.min(0)]],
      Valor_Venta: ['', [Validators.required, Validators.min(0)]],
      Proveedores_idProveedores: ['', Validators.required]
    });*/
    this.frm_Producto = new FormGroup({
      Codigo_Barras: new FormControl('', Validators.required),
      Nombre_Producto: new FormControl('', Validators.required),
      Graba_IVA: new FormControl('', Validators.required),
      Unidad_Medida_idUnidad_Medida: new FormControl('', Validators.required),
      IVA_idIVA: new FormControl('', Validators.required),
      Cantidad: new FormControl('', [Validators.required, Validators.min(1)]),
      Valor_Compra: new FormControl('', [Validators.required, Validators.min(0)]),
      Valor_Venta: new FormControl('', [Validators.required, Validators.min(0)]),
      Proveedores_idProveedores: new FormControl('', Validators.required),
      idKardex: new FormControl('')
    });
  }

  grabar() {
    let producto: IProducto = {
      idProductos: this.idProductos,
      Codigo_Barras: this.frm_Producto.get('Codigo_Barras')?.value,
      Nombre_Producto: this.frm_Producto.get('Nombre_Producto')?.value,
      Graba_IVA: this.frm_Producto.get('Graba_IVA')?.value,
      Unidad_Medida_idUnidad_Medida: this.frm_Producto.get('Unidad_Medida_idUnidad_Medida')?.value,
      IVA_idIVA: this.frm_Producto.get('IVA_idIVA')?.value,
      Cantidad: this.frm_Producto.get('Cantidad')?.value,
      Valor_Compra: this.frm_Producto.get('Valor_Compra')?.value,
      Valor_Venta: this.frm_Producto.get('Valor_Venta')?.value,
      Proveedores_idProveedores: this.frm_Producto.get('Proveedores_idProveedores')?.value,
      idKardex: this.frm_Producto.get('idKardex')?.value
    };

    Swal.fire({
      title: 'Producto',
      text: 'Desea guardar los cambios en el Producto ',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        // console.log(this.idProductos);
        if (this.idProductos > 0) {
          //producto.idProductos = this.idProductos;
          // console.log(producto);
          this.productoServicio.actualizar(producto).subscribe((res: any) => {
            // console.log(res);
            Swal.fire({
              title: 'Producto',
              text: res.mensaje,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/productos']);
          });
        } else {
          this.productoServicio.insertar(producto).subscribe((res: any) => {
            Swal.fire({
              title: 'Producto',
              text: res.mensaje,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/productos']);
          });
        }
      }
    });
  }

  /*
  calculos() {
    let sub_total = this.frm_factura.get('Sub_total')?.value;
    let iva = this.frm_factura.get('Valor_IVA')?.value;
    let sub_total_iva = sub_total * iva;
    this.frm_factura.get('Sub_total_iva')?.setValue(sub_total_iva);
    this.totalapagar = parseInt(sub_total) + sub_total_iva;
  }
*/
/*
  cambio(objetoSleect: any) {
    let idProductos = objetoSleect.target.value;
    this.frm_Producto.get('Codigo_Barras')?.setValue(objetoSleect.target.value);
    //this.obtenerCLiente(idProductos);
  }*/

    obtenerUnidadMedida(idUnidad_Medida: number) {
      const unidadmedida = this.listaUnidadMedida.find((unidadmedida) => unidadmedida.idUnidad_Medida == idUnidad_Medida);
      // console.log('Unidad Medida:', unidadmedida);  
      return unidadmedida;
    }


}