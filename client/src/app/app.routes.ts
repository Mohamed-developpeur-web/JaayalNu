// Définition des routes Angular de l'application.
// Chaque page correspond à un écran de la dashboard et des modules de gestion.
import { Routes } from '@angular/router';
import { DashboardComponent } from './dashboard.component';
import { RoleGuard } from './role.guard';

export const routes: Routes = [
  {
    path: '',
    pathMatch: 'full',
    component: DashboardComponent,
  },
  {
    path: 'public',
    loadChildren: () => import('./public/public.module').then((m) => m.PublicModule),
  },
  {
    path: 'vendeur',
    loadChildren: () => import('./vendeur/vendeur.module').then((m) => m.VendeurModule),
    canLoad: [RoleGuard],
    data: { roles: ['vendeur'] },
  },
  {
    path: 'admin',
    loadChildren: () => import('./admin/admin.module').then((m) => m.AdminModule),
    canLoad: [RoleGuard],
    data: { roles: ['administrateur'] },
  },
  {
    path: '**',
    redirectTo: '',
  },
];
