import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { AdminRoutingModule } from './admin-routing.module';
import { Dashboard } from './dashboard/dashboard';
import { Utilisateurs } from './utilisateurs/utilisateurs';
import { Produits } from './produits/produits';
import { Categories } from './categories/categories';
import { Abonnements } from './abonnements/abonnements';
import { Statistiques } from './statistiques/statistiques';
import { ValidationVendeur } from './validation-vendeur/validation-vendeur';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    AdminRoutingModule,
    Dashboard,
    Utilisateurs,
    Produits,
    Categories,
    Abonnements,
    Statistiques,
    ValidationVendeur,
  ],
})
export class AdminModule {}
