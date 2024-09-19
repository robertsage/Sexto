// angular import
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

// project import
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SharedModule } from './theme/shared/shared.module';
import { PacientesComponent } from './pacientes/pacientes.component';
import { MedicosComponent } from './medicos/medicos.component';
import { ConsultasComponent } from './consultas/consultas.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NuevopacienteComponent } from './pacientes/nuevopaciente/nuevopaciente.component';
import { NuevomedicoComponent } from './medicos/nuevomedico/nuevomedico.component';
import { NuevaconsultaComponent } from './consultas/nuevaconsulta/nuevaconsulta.component';
import LoginComponent from './demo/authentication/login/login.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

@NgModule({
  declarations: [AppComponent],
  imports: [BrowserModule, AppRoutingModule, SharedModule, BrowserAnimationsModule, 
    PacientesComponent, NuevopacienteComponent, 
    MedicosComponent, NuevomedicoComponent, 
    ConsultasComponent, NuevaconsultaComponent, 
    LoginComponent,
    HttpClientModule, FormsModule, ReactiveFormsModule, NgbModule],
  bootstrap: [AppComponent]
})
export class AppModule { }
