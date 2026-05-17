const routes: Routes = [
  { path: '', component: AccueilComponent },
  { path: 'produits', component: ListeProduitsComponent },
  { path: 'produits/:id', component: DetailsProduitsComponent },
  { path: 'vendeur/:id', component: ProfilVendeurComponent },
  { path: 'inscription', component: InscriptionComponent },
  { path: 'connexion', component: ConnexionComponent },
];
