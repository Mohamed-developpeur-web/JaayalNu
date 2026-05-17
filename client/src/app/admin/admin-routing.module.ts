import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Dashboard } from './dashboard/dashboard';
import { Utilisateurs } from './utilisateurs/utilisateurs';
import { Produits } from './produits/produits';
import { Categories } from './categories/categories';
import { Abonnements } from './abonnements/abonnements';
import { Statistiques } from './statistiques/statistiques';
import { ValidationVendeur } from './validation-vendeur/validation-vendeur';

import { RoleGuard } from '../role.guard';

const routes: Routes = [
  { path: '', component: Dashboard, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'dashboard', component: Dashboard, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'utilisateurs', component: Utilisateurs, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'produits', component: Produits, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'categories', component: Categories, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'abonnements', component: Abonnements, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'statistiques', component: Statistiques, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
  { path: 'validation-vendeur', component: ValidationVendeur, canActivate: [RoleGuard], data: { roles: ['administrateur'] } },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AdminRoutingModule {}
