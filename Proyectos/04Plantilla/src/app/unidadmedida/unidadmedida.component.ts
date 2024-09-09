import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from '../theme/shared/shared.module';
import { UnidadmedidaService } from '../Services/unidadmedida.service';
import Swal from 'sweetalert2';
import { IUnidadMedida } from '../Interfaces/iunidadmedida';

@Component({
  selector: 'app-unidadmedida',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './unidadmedida.component.html',
  styleUrl: './unidadmedida.component.scss'
})
export class UnidadmedidaComponent implements OnInit {
  listaunidades: IUnidadMedida[] = [];

  constructor(private unidadServicio: UnidadmedidaService) {}

  ngOnInit(): void {
   this.cargarUnidadesMedida();
  }

  cargarUnidadesMedida() {
    this.unidadServicio.todos().subscribe((data) => {
      this.listaunidades = data;
    });
  }

  eliminar(idUnidadMedida: number) {
    Swal.fire({
      title: 'Eliminar Unidad de Medida',
      text: '¿Está seguro de que desea eliminar esta Unidad de Medida?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        // console.log('verificar')
        this.unidadServicio.eliminar(idUnidadMedida).subscribe((res: any ) => {
          console.log(res);
          this.cargarUnidadesMedida();
          Swal.fire({
            title: 'Unidad de Medida Eliminada',
            text: res.mensaje,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          });
        });
      }
    });
  }
}