// Modèle TypeScript pour la représentation d'un produit renvoyé par l'API.
// Cette interface correspond aux champs JSON envoyés par le backend Laravel.
export interface Product {
  id: number;
  nom: string;
  description: string | null;
  prix: number;
  stock: number;
  date_ajout: string;
  categorie: {
    id: number;
    nom: string;
  };
  vendeur: {
    id: number;
    nom: string;
  };
}
