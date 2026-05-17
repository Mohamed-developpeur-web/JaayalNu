import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '', loadChildren: () => import('./public/public.module').then(m => m.PublicModule) },
  { path: 'vendeur', loadChildren: () => import('./vendeur/vendeur.module').then(m => m.VendeurModule) },
  { path: 'admin', loadChildren: () => import('./admin/admin.module').then(m => m.AdminModule) },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)], // ⚠️ ici c’est forRoot car c’est le routing principal
  exports: [RouterModule],
})
export class AppRoutingModule {}
