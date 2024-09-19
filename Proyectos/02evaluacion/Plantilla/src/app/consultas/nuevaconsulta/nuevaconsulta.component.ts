import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Iconsulta } from 'src/app/Interfaces/iconsulta';
import { Imedico } from 'src/app/Interfaces/imedico';
import { Ipaciente } from 'src/app/Interfaces/ipaciente';
import { ConsultasService } from 'src/app/Services/consultas.service';
import { MedicosService } from 'src/app/Services/medicos.service';
import { PacientesService } from 'src/app/Services/pacientes.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevaconsulta',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './nuevaconsulta.component.html',
  styleUrl: './nuevaconsulta.component.scss'
})
export class NuevaconsultaComponent implements OnInit{
  titulo = 'Nueva Consulta';
  frm_Consultas: FormGroup;
  idConsultas = 0;
  Fecha;
  Descripcion;
  listaMedicos: Imedico[] = [];
  listaPacientes: Ipaciente[] = [];

  constructor(
    private medicoServicio: MedicosService,
    private pacienteServicio: PacientesService,
    private consultaServicio: ConsultasService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.idConsultas = parseInt(this.ruta.snapshot.paramMap.get('idconsulta'), 10);
    
    this.frm_Consultas = new FormGroup({
      Fecha: new FormControl('', Validators.required),
      Descripcion: new FormControl('', Validators.required),
      idMedico: new FormControl('', [Validators.required]),
      idPaciente: new FormControl('', [Validators.required]),
    });

    this.cargarListas();

    // actualizacion
    if (this.idConsultas > 0) {
      this.consultaServicio.uno(this.idConsultas).subscribe((consulta) => {
        this.frm_Consultas.controls['fecha_consulta'].setValue(consulta.Fecha);
        this.frm_Consultas.controls['fecha_consulta'].setValue(consulta.Descripcion);
        this.frm_Consultas.controls['nino_id'].setValue(consulta.Medico);
        this.frm_Consultas.controls['cuidador_id'].setValue(consulta.NombrePaciente);
        this.frm_Consultas.controls['cuidador_id'].setValue(consulta.ApellidoPaciente);
        this.titulo = 'Editar Consulta';
      });
    }
  }

  cargarListas() {
    // medicos
    this.medicoServicio.todos().subscribe((medicos) => {
      this.listaMedicos = medicos;
    });

    // pacientes
    this.pacienteServicio.todos().subscribe((pacientes) => {
      this.listaPacientes = pacientes;
    });
  }

  grabar() {
    let consulta: Iconsulta = {
      Fecha: this.frm_Consultas.get('fecha_consulta')?.value,
      Descripcion: this.frm_Consultas.get('descripcion')?.value,
      Medicos_idMedicos: this.frm_Consultas.get('idMedicos')?.value,
      Pacientes_idPacientes: this.frm_Consultas.get('idPacientes')?.value,

      idConsultas: this.idConsultas > 0 ? this.idConsultas : undefined,
      Medico: '',
      NombrePaciente: '',
      ApellidoPaciente: ''
    };

    
    Swal.fire({
      title: 'Guardar Consulta',
      text: '¿Desea guardar cambios?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idConsultas > 0) {
          // actualizat
          this.consultaServicio.actualizar(consulta).subscribe(() => {
            Swal.fire('Éxito', 'La consulta se actualizó con éxito', 'success');
            this.navegacion.navigate(['/consultas']);
          });
        } else {
          // insertar
          this.consultaServicio.insertar(consulta).subscribe(() => {
            Swal.fire('Éxito', 'La consulta se guardó con éxito', 'success');
            this.navegacion.navigate(['/consultas']);
          });
        }
      }
    });
  }
}
