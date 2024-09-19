import { Component, OnInit } from '@angular/core';
import { Ipaciente } from '../Interfaces/ipaciente';
import { PacientesService } from '../Services/pacientes.service';
import Swal from 'sweetalert2';
import { SharedModule } from '../theme/shared/shared.module';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-pacientes',
  standalone: true,
  imports: [SharedModule, FormsModule, RouterLink],
  templateUrl: './pacientes.component.html',
  styleUrl: './pacientes.component.scss'
})
export class PacientesComponent implements OnInit {
  listaPacientes: Ipaciente[] = [];
  constructor(private ServicioPaciente: PacientesService) {}
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.ServicioPaciente.todos().subscribe((data) => {
      //console.log(this.listaPacientes);
      //console.log(data); para llenar la lista de pacientes e imprimir
      this.listaPacientes = data;
    });
  }
  eliminar(idPaciente: number) {
    Swal.fire({
      title: 'Pacientes',
      text: 'Está seguro que desea eliminar el Paciente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Paciente'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServicioPaciente.eliminar(idPaciente).subscribe((data) => {
          Swal.fire('Pacientes', 'El paciente ha sido eliminado', 'success');
          this.cargatabla();
        });
      }
    });
    //alert(idMedico); para probar si está llegando la solicitud de eliminacion
  }
}
