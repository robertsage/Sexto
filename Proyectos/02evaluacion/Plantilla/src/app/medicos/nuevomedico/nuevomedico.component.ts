import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Imedico } from 'src/app/Interfaces/imedico';
import { MedicosService } from 'src/app/Services/medicos.service';

@Component({
  selector: 'app-nuevomedico',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevomedico.component.html',
  styleUrl: './nuevomedico.component.scss'
})
export class NuevomedicoComponent implements OnInit {
  titulo = "Insertar Medico";
  idmedicos = 0;
  Nombres: any;
  Especialidad;
  Telefono;
  Email;
  
  constructor(
    private medicoServicio: MedicosService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) { }
  ngOnInit(): void {
    this.idmedicos = parseInt(this.ruta.snapshot.paramMap.get('idmedico'));
    /*this.ruta.paramMap.subscribe((parametros) => {
      this.idmedicos = parseInt(parametros.get('idmedico'));
    });*/
    if (this.idmedicos > 0) {
      this.medicoServicio
        .uno(this.idmedicos)
        .subscribe((medico) => {
          console.log(medico);
          this.Nombres = medico.Nombres;
          this.Especialidad = medico.Especialidad;
          this.Telefono = medico.Telefono;
          this.Email = medico.Email;
          this.titulo = 'Actualizar Medico';
        });
    }
  }

  limpiarcaja() {
    alert('Limpiar Caja');
  }
  grabar() {
    let imedico: Imedico = {
      idMedicos: 0,
      Nombres: this.Nombres,
      Especialidad: this.Especialidad,
      Telefono: this.Telefono,
      Email: this.Email
    };
    console.log(this.idmedicos);
    if (this.idmedicos == 0 || isNaN(this.idmedicos)) {

      this.medicoServicio.insertar(imedico).subscribe(
        (respuesta) => {
          // parseInt(respuesta) > 1 ? alert("Grabado con éxito") : alert("Error al grabar");
          if (parseInt(respuesta) > 1) {
            alert("Grabado con éxito");
            this.navegacion.navigate(['/medicos']);
          } else {
            alert("Error al grabar");
          }
        });
    } else {
      imedico.idMedicos = this.idmedicos;
      this.medicoServicio.actualizar(imedico).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          this.idmedicos = 0;
          alert('Actualizado con éxito');
          this.navegacion.navigate(['/medicos']);
        } else {
          alert('Error al actualizar');
        }
      });


    }
  }
}
