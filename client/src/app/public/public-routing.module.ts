import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Accueil } from './accueil/accueil';
import { ListeProduits } from './liste-produits/liste-produits';
import { DetailsProduits } from './details-produits/details-produits';
import { ProfilVendeur } from './profil-vendeur/profil-vendeur';
import { Inscription } from './inscription/inscription';
import { Connexion } from './connexion/connexion';

const routes: Routes = [
  { path: '', component: Accueil },
  { path: 'produits', component: ListeProduits },
  { path: 'produits/:id', component: DetailsProduits },
  { path: 'vendeur/:id', component: ProfilVendeur },
  { path: 'inscription', component: Inscription },
  { path: 'connexion', component: Connexion },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PublicRoutingModule {}
