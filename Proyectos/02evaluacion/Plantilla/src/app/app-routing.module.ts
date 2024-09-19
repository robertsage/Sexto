// angular import
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// Project import
import { AdminComponent } from './theme/layouts/admin-layout/admin-layout.component';
import { GuestComponent } from './theme/layouts/guest/guest.component';
import { usuariosGuardGuard } from './Guards/usuarios-guard.guard';

const routes: Routes = [
  {
    path: '', //url
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: '/dashboard/default',
        pathMatch: 'full'
      },
      {
        path: 'dashboard/default',
        loadComponent: () => import('./demo/default/dashboard/dashboard.component').then((c) => c.DefaultComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'typography',
        loadComponent: () => import('./demo/ui-component/typography/typography.component')
      },
      {
        path: 'color',
        loadComponent: () => import('./demo/ui-component/ui-color/ui-color.component')
      },
      {
        path: 'sample-page',
        loadComponent: () => import('./demo/other/sample-page/sample-page.component')
      },
      {
        path: 'pacientes',
        loadComponent: () => import('./pacientes/pacientes.component').then((m) => m.PacientesComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevopaciente',
        loadComponent: () => import('./pacientes/nuevopaciente/nuevopaciente.component').then((m) => m.NuevopacienteComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editarpaciente/:idpaciente',
        loadComponent: () => import('./pacientes/nuevopaciente/nuevopaciente.component').then((m) => m.NuevopacienteComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'medicos',
        loadComponent: () => import('./medicos/medicos.component').then((m) => m.MedicosComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevomedico',
        loadComponent: () => import('./medicos/nuevomedico/nuevomedico.component').then((m) => m.NuevomedicoComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editarmedico/:idmedico',
        loadComponent: () => import('./medicos/nuevomedico/nuevomedico.component').then((m) => m.NuevomedicoComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editarconsulta/:idconsulta',
        loadComponent: () => import('./consultas/nuevaconsulta/nuevaconsulta.component').then((m) => m.NuevaconsultaComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevaconsulta',
        loadComponent: () => import('./consultas/nuevaconsulta/nuevaconsulta.component').then((m) => m.NuevaconsultaComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'consultas',
        loadComponent: () => import('./consultas/consultas.component').then((m) => m.ConsultasComponent)
      }
    ]
  },
  {
    path: '',
    component: GuestComponent,
    children: [
      {
        path: 'login',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'login/:id',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'register',
        loadComponent: () => import('./demo/authentication/register/register.component')
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}