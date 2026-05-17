import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { PublicRoutingModule } from './public-routing.module';
import { Accueil } from './accueil/accueil';
import { ListeProduits } from './liste-produits/liste-produits';
import { DetailsProduits } from './details-produits/details-produits';
import { ProfilVendeur } from './profil-vendeur/profil-vendeur';
import { Inscription } from './inscription/inscription';
import { Connexion } from './connexion/connexion';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    PublicRoutingModule,
    Accueil,
    ListeProduits,
    DetailsProduits,
    ProfilVendeur,
    Inscription,
    Connexion,
  ],
})
export class PublicModule {}
