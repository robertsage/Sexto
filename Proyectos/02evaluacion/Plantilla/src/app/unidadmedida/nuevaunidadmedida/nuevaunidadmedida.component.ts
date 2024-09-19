import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { UnidadmedidaService } from '../../Services/unidadmedida.service';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';
import { IUnidadMedida } from 'src/app/Interfaces/iunidadmedida';

@Component({
  selector: 'app-nuevaunidadmedida',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule],
  templateUrl: './nuevaunidadmedida.component.html',
  styleUrl: './nuevaunidadmedida.component.scss'
})
export class NuevaunidadmedidaComponent implements OnInit {
  titulo = 'Nueva Unidad de Medida';
  frm_UnidadMedida: FormGroup;

  idUnidadMedida = 0;
  constructor(
    private unidadService: UnidadmedidaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.idUnidadMedida = parseInt(this.ruta.snapshot.paramMap.get('id'));
    this.frm_UnidadMedida = new FormGroup({
      Detalle: new FormControl('', [Validators.required]),
      Tipo: new FormControl('', [Validators.required])
    });
    if (this.idUnidadMedida > 0) {
      this.unidadService.uno(this.idUnidadMedida).subscribe((unaUnidad) => {
        this.frm_UnidadMedida.controls['Detalle'].setValue(unaUnidad.Detalle);
        this.frm_UnidadMedida.controls['Tipo'].setValue(unaUnidad.Tipo);
        this.titulo = 'Editar Unidad de Medida';
      });
    }
  }

  cambio(objetoSleect: any) {
    this.frm_UnidadMedida.get('Tipo')?.setValue(objetoSleect.target.value);
  }

  grabar() {
    let unidadmedida: IUnidadMedida = {
      Detalle: this.frm_UnidadMedida.get('Detalle')?.value,
      Tipo: this.frm_UnidadMedida.get('Tipo')?.value,
      idUnidad_Medida: this.idUnidadMedida
    };
    Swal.fire({
      title: 'Unidad de Medida',
      text: 'Desea guardar los cambios en la Unidad de Medida ',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        // console.log(this.idUnidadMedida)
        if (this.idUnidadMedida > 0) {
          unidadmedida.idUnidad_Medida = this.idUnidadMedida;
          this.unidadService.actualizar(unidadmedida).subscribe((x) => {
            console.log(x);
            Swal.fire('Exito', 'La unidad de medida se modifico con exito', 'success');
            this.navegacion.navigate(['/unidadmedida']);
          });
        } else {
          this.unidadService.insertar(unidadmedida).subscribe((x) => {
            Swal.fire('Exito', 'La unidad de medida se grabo con exito', 'success');
            this.navegacion.navigate(['/unidadmedida']);
          });
        }
      }
    });
  }
}
