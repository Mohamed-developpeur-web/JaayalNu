import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Dashboard } from './dashboard/dashboard';
import { MesProduits } from './mes-produits/mes-produits';
import { AjouterProduit } from './ajouter-produit/ajouter-produit';
import { ModifierProduit } from './modifier-produit/modifier-produit';
import { Messages } from './messages/messages';
import { Statistiques } from './statistiques/statistiques';
import { ModifierProfil } from './modifier-profil/modifier-profil';

import { RoleGuard } from '../role.guard';

const routes: Routes = [
  { path: '', component: Dashboard, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'dashboard', component: Dashboard, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'mes-produits', component: MesProduits, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'ajouter-produit', component: AjouterProduit, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'modifier-produit/:id', component: ModifierProduit, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'messages', component: Messages, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'statistiques', component: Statistiques, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
  { path: 'modifier-profil', component: ModifierProfil, canActivate: [RoleGuard], data: { roles: ['vendeur'] } },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class VendeurRoutingModule {}
