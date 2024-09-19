import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Ipaciente } from 'src/app/Interfaces/ipaciente';
import { PacientesService } from 'src/app/Services/pacientes.service';

@Component({
  selector: 'app-nuevopaciente',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevopaciente.component.html',
  styleUrl: './nuevopaciente.component.scss'
})
export class NuevopacienteComponent implements OnInit {
  titulo = "Insertar Paciente";
  idpacientes = 0;
  Nombre: any;
  Apellido;
  Direccion;
  Telefono;
  
  constructor(
    private pacienteServicio: PacientesService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) { }
  ngOnInit(): void {
    this.idpacientes = parseInt(this.ruta.snapshot.paramMap.get('idpaciente'));
    /*this.ruta.paramMap.subscribe((parametros) => {
      this.idpacientes = parseInt(parametros.get('idpaciente'));
    });*/
    if (this.idpacientes > 0) {
      this.pacienteServicio
        .uno(this.idpacientes)
        .subscribe((paciente) => {
          console.log(paciente);
          this.Nombre = paciente.Nombre;
          this.Apellido = paciente.Apellido;
          this.Direccion = paciente.Direccion;
          this.Telefono = paciente.Telefono;
          this.titulo = 'Actualizar Paciente';
        });
    }
  }

  limpiarcaja() {
    alert('Limpiar Caja');
  }
  grabar() {
    let ipaciente: Ipaciente = {
      idPacientes: 0,
      Nombre: this.Nombre,
      Apellido: this.Apellido,
      Direccion: this.Direccion,
      Telefono: this.Telefono
    };
    console.log(this.idpacientes);
    if (this.idpacientes == 0 || isNaN(this.idpacientes)) {

      this.pacienteServicio.insertar(ipaciente).subscribe(
        (respuesta) => {
          // parseInt(respuesta) > 1 ? alert("Grabado con éxito") : alert("Error al grabar");
          if (parseInt(respuesta) > 1) {
            alert("Grabado con éxito");
            this.navegacion.navigate(['/pacientes']);
          } else {
            alert("Error al grabar");
          }
        });
    } else {
      ipaciente.idPacientes = this.idpacientes;
      this.pacienteServicio.actualizar(ipaciente).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          this.idpacientes = 0;
          alert('Actualizado con éxito');
          this.navegacion.navigate(['/pacientes']);
        } else {
          alert('Error al actualizar');
        }
      });


    }
  }
}
