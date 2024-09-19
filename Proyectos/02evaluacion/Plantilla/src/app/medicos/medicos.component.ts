import { Component, OnInit } from '@angular/core';
import { Imedico } from '../Interfaces/imedico';
import { MedicosService } from '../Services/medicos.service';
import Swal from 'sweetalert2';
import { SharedModule } from '../theme/shared/shared.module';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-medicos',
  standalone: true,
  imports: [SharedModule, FormsModule, RouterLink],
  templateUrl: './medicos.component.html',
  styleUrl: './medicos.component.scss'
})
export class MedicosComponent implements OnInit {
  listaMedicos: Imedico[] = [];
  constructor(private ServicioMedico: MedicosService) {}
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.ServicioMedico.todos().subscribe((data) => {
      //console.log(this.listaMedicos);
      //console.log(data); para llenar la lista de medicos e imprimir
      this.listaMedicos = data;
    });
  }
  eliminar(idMedico: number) {
    Swal.fire({
      title: 'Medicos',
      text: 'Está seguro que desea eliminar el Medico!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Medico'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServicioMedico.eliminar(idMedico).subscribe((data) => {
          Swal.fire('Medicos', 'El medico ha sido eliminado', 'success');
          this.cargatabla();
        });
      }
    });
    //alert(idMedico); para probar si está llegando la solicitud de eliminacion
  }
}
