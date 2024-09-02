// angular import
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

// project import
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SharedModule } from './theme/shared/shared.module';
import { ProveedoresComponent } from './proveedores/proveedores.component';
import { ClientesComponent } from './clientes/clientes.component';
import { ProductosComponent } from './productos/productos.component';
import { FacturasComponent } from './facturas/facturas.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NuevoproveedorComponent } from './proveedores/nuevoproveedor/nuevoproveedor.component';
import { NuevafacturaComponent } from './facturas/nuevafactura/nuevafactura.component';
import { NuevoproductoComponent } from './productos/nuevoproducto/nuevoproducto.component';
import { NuevoclienteComponent } from './clientes/nuevocliente/nuevocliente.component';

@NgModule({
  declarations: [AppComponent],
  imports: [BrowserModule, AppRoutingModule, SharedModule, BrowserAnimationsModule, ProveedoresComponent, NuevoproveedorComponent, ClientesComponent, NuevoclienteComponent, ProductosComponent, NuevoproductoComponent, FacturasComponent, NuevafacturaComponent, HttpClientModule, FormsModule, ReactiveFormsModule],
  bootstrap: [AppComponent]
})
export class AppModule { }
