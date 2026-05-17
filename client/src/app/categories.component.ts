import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { CategoryService } from './category.service';
import { Category } from './category.model';

@Component({
  standalone: true,
  imports: [CommonModule, FormsModule],
  selector: 'app-categories',
  template: `
    <section class="page-card">
      <div class="section-title">
        <div>
          <h2>Gestion des catégories</h2>
          <p>Gérez la taxonomie de la plateforme pour faciliter la recherche de produits.</p>
        </div>
        <button class="cta-button" (click)="createCategory()">Nouvelle Catégorie</button>
      </div>

      <div class="summary-grid">
        <div class="stat-card">
          <span>Total catégories</span>
          <strong>{{ categories.length }}</strong>
        </div>
        <div class="stat-card">
          <span>Total produits</span>
          <strong>531</strong>
        </div>
        <div class="stat-card">
          <span>Catégories actives</span>
          <strong>{{ categories.length }}</strong>
        </div>
      </div>
    </section>

    <section class="page-card">
      <div class="section-title">
        <h2>Liste des catégories</h2>
        <span class="secondary-text">Affichage de {{ categories.length }} catégories</span>
      </div>

      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Catégorie</th>
              <th>Produits</th>
              <th>Date de création</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr *ngFor="let categorie of categories">
              <td>{{ categorie.nom }}</td>
              <td>—</td>
              <td>{{ categorie.created_at ? (categorie.created_at | date:'dd/MM/yyyy') : '—' }}</td>
              <td><span class="status-pill">Actif</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <section class="page-card sidebar-card">
      <div class="section-title">
        <h2>Ajout rapide</h2>
      </div>
      <div class="form-grid">
        <label>
          Nom de la catégorie
          <input [(ngModel)]="nom" placeholder="Ex: Maroquinerie" />
        </label>
        <label>
          Description
          <textarea rows="4" [(ngModel)]="description" placeholder="Décrivez brièvement le type de produits..."></textarea>
        </label>
        <label>
          Icône (nom Lucide)
          <input [(ngModel)]="icone" placeholder="Ex: ShoppingBag" />
        </label>
        <button class="cta-button" (click)="createCategory()" [disabled]="saving || !nom">
          {{ saving ? 'Création...' : 'Créer la catégorie' }}
        </button>
        <p class="form-message success" *ngIf="successMessage">{{ successMessage }}</p>
        <p class="form-message error" *ngIf="errorMessage">{{ errorMessage }}</p>
      </div>
    </section>
  `,
  styles: [
    `
      .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
        margin-top: 1rem;
      }

      .stat-card {
        padding: 1rem;
        border-radius: 20px;
        background: #ecfdf5;
      }

      .table-wrapper {
        overflow-x: auto;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 1rem 0.75rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
      }

      th {
        color: #6b7280;
        font-weight: 700;
      }

      .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.8rem;
        border-radius: 999px;
        background: #ecfdf5;
        color: #065f46;
        font-size: 0.85rem;
        font-weight: 600;
      }

      .sidebar-card {
        max-width: 420px;
      }

      .form-grid {
        display: grid;
        gap: 1rem;
      }

      label {
        display: grid;
        gap: 0.5rem;
        font-size: 0.95rem;
        color: #374151;
      }

      input,
      textarea {
        width: 100%;
        padding: 0.95rem 1rem;
        border-radius: 16px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
        font: inherit;
      }

      .secondary-text {
        color: #6b7280;
        font-size: 0.95rem;
      }

      .form-message {
        margin: 0;
        font-size: 0.95rem;
      }

      .form-message.success {
        color: #065f46;
      }

      .form-message.error {
        color: #b91c1c;
      }

      @media (max-width: 900px) {
        .summary-grid {
          grid-template-columns: 1fr;
        }
      }
    `,
  ],
})
export class CategoriesComponent implements OnInit {
  categories: Category[] = [];
  nom = '';
  description = '';
  icone = '';
  saving = false;
  successMessage = '';
  errorMessage = '';

  constructor(private readonly categoryService: CategoryService) {}

  ngOnInit(): void {
    this.loadCategories();
  }

  loadCategories(): void {
    this.categoryService.list().subscribe({
      next: (categories) => {
        this.categories = categories;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger les catégories.';
      },
    });
  }

  createCategory(): void {
    if (!this.nom.trim()) {
      this.errorMessage = 'Le nom de la catégorie est requis.';
      return;
    }

    this.saving = true;
    this.errorMessage = '';
    this.successMessage = '';

    this.categoryService.create(this.nom.trim()).subscribe({
      next: (categorie) => {
        this.categories = [categorie, ...this.categories];
        this.nom = '';
        this.description = '';
        this.icone = '';
        this.successMessage = 'Catégorie créée avec succès.';
        this.saving = false;
      },
      error: () => {
        this.errorMessage = 'Échec de la création de la catégorie. Réessayez.';
        this.saving = false;
      },
    });
  }
}
