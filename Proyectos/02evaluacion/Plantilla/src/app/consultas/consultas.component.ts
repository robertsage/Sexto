import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from '../theme/shared/shared.module';
import { Iconsulta } from '../Interfaces/iconsulta';
import { ConsultasService } from '../Services/consultas.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-consultas',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './consultas.component.html',
  styleUrl: './consultas.component.scss'
})
export class ConsultasComponent implements OnInit {
  listaConsultas: Iconsulta[] = [];

  constructor(private ConsultaServicio: ConsultasService) {}

  ngOnInit(): void {
    this.cargarConsultas();
  }

  cargarConsultas() {
    this.ConsultaServicio.todos().subscribe((data) => {
      this.listaConsultas = data;
    });
  }

  eliminar(idConsulta: number) {
    Swal.fire({
      title: 'Eliminar Consulta',
      text: '¿Está seguro de que desea eliminar la consulta?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ConsultaServicio.eliminar(idConsulta).subscribe((res: any) => {
          console.log(res);
          this.cargarConsultas();
          Swal.fire({
            title: 'Consulta Eliminada',
            text: res.mensaje || 'La consulta ha sido eliminada exitosamente',
            icon: 'success',
            showConfirmButton: true,
            // timer: 1500
          });
        });
      }
    });
  }

// Método para imprimir el reporte de asignaciones
imprimirConsultas(): void {
  this.ConsultaServicio.generarReporteConsultas().subscribe(response => {
    const url = window.URL.createObjectURL(response);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'ReporteConsultas.pdf';
    a.click();
    window.URL.revokeObjectURL(url);
  }, error => {
    Swal.fire('Error', 'Problema al generar el reporte', 'error');
  });
}
}
