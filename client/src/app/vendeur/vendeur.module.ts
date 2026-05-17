import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { VendeurRoutingModule } from './vendeur-routing.module';
import { Dashboard } from './dashboard/dashboard';
import { MesProduits } from './mes-produits/mes-produits';
import { AjouterProduit } from './ajouter-produit/ajouter-produit';
import { ModifierProduit } from './modifier-produit/modifier-produit';
import { Messages } from './messages/messages';
import { Statistiques } from './statistiques/statistiques';
import { ModifierProfil } from './modifier-profil/modifier-profil';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    VendeurRoutingModule,
    Dashboard,
    MesProduits,
    AjouterProduit,
    ModifierProduit,
    Messages,
    Statistiques,
    ModifierProfil,
  ],
})
export class VendeurModule {}
