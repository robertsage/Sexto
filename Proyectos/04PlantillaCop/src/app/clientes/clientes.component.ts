import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [SharedModule],
  templateUrl: './clientes.component.html',
  styleUrl: './clientes.component.scss'
})
export class ClientesComponent {

}
