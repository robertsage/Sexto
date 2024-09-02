import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
@Component({
  selector: 'app-productos',
  standalone: true,
  imports: [SharedModule],
  templateUrl: './productos.component.html',
  styleUrl: './productos.component.scss'
})
export class ProductosComponent {

}
