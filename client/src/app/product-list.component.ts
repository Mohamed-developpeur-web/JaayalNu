// Composant Angular affichant la liste des produits récupérés depuis l'API.
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { ProductService } from './product.service';
import { Product } from './product.model';

@Component({
  selector: 'app-product-list',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  template: `
    <section class="page-card">
      <div class="section-title">
        <div>
          <h2>Gestion de l'inventaire</h2>
          <p>Supervisez et modérez tous les produits listés sur la marketplace.</p>
        </div>
        <button class="cta-button">Ajouter un produit</button>
      </div>

      <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.25rem;">
        <input placeholder="Rechercher un produit ou un vendeur..." style="flex: 1; padding: 0.95rem 1rem; border-radius: 999px; border: 1px solid #d1d5db; background: #f9fafb;" />
        <button class="header-action">Filtrer</button>
      </div>

      <div *ngIf="loading" style="padding: 1.5rem; border-radius: 20px; background: #f8fafc;">Chargement des produits...</div>
      <div *ngIf="error" style="padding: 1.5rem; border-radius: 20px; background: #ffe7e7; color: #8b0000;">{{ error }}</div>

      <div *ngIf="!loading && !error" style="display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        <article *ngFor="let produit of produits" class="page-card" style="padding: 1.25rem;">
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.75rem; margin-bottom: 0.9rem;">
            <span class="label-pill">{{ produit.categorie.nom }}</span>
            <span style="font-size: 0.85rem; color: #6b7280;">Stock: {{ produit.stock }}</span>
          </div>
          <h3 style="margin: 0 0 0.75rem; font-size: 1.05rem;">{{ produit.nom }}</h3>
          <p style="margin: 0 0 1rem; color: #4b5563; min-height: 3rem;">{{ produit.description }}</p>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
            <strong style="font-size: 1.1rem;">{{ produit.prix | number:'1.0-0' }} FCFA</strong>
            <button class="header-action">Modifier</button>
          </div>
          <p style="margin: 0.75rem 0 0; color: #6b7280;">Vendeur: {{ produit.vendeur.nom }}</p>
          <p style="margin: 0.25rem 0 0; color: #6b7280;">Ajouté le {{ produit.date_ajout | date:'dd MMM yyyy' }}</p>
        </article>
      </div>
    </section>
  `,
  styles: [
    `
      h2 {
        margin: 0;
      }

      input {
        width: 100%;
      }

      .page-card {
        background: #ffffff;
      }
    `,
  ],
})
export class ProductListComponent implements OnInit {
  // Contient les produits récupérés depuis l'API.
  produits: Product[] = [];

  // Indique si la page est en train de charger les données.
  loading = true;

  // Message d'erreur en cas de problème réseau ou serveur.
  error: string | null = null;

  constructor(private readonly productService: ProductService) {}

  // Au démarrage du composant, on appelle le backend pour récupérer les produits.
  ngOnInit(): void {
    this.productService.list().subscribe({
      next: (produits) => {
        this.produits = produits;
        this.loading = false;
      },
      error: () => {
        this.error =
          'Impossible de charger les produits. Vérifiez que le backend est démarré et accessible.';
        this.loading = false;
      },
    });
  }
}
