import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { VendeurService } from './vendeur.service';
import { Vendeur } from './vendeur.model';

@Component({
  standalone: true,
  imports: [CommonModule, FormsModule],
  selector: 'app-validations',
  template: `
    <section class="page-card">
      <div class="section-title">
        <div>
          <h2>Validations des vendeurs</h2>
          <p>Examinez et approuvez les nouvelles demandes d’inscription des marchands.</p>
        </div>
        <span class="badge">{{ vendeurs.length }} dossiers en attente</span>
      </div>

      <div class="validation-layout">
        <div class="validation-list">
          <input placeholder="Rechercher un vendeur..." type="search" [(ngModel)]="query" />
          <div *ngFor="let vendeur of filteredVendeurs()" class="validation-item">
            <div>
              <strong>{{ vendeur.user.name }}</strong>
              <p>{{ vendeur.user.email }}</p>
              <small>{{ vendeur.status_compte | titlecase }}</small>
            </div>
            <div class="validation-actions">
              <button class="header-action">Revoir</button>
              <button class="cta-button">Approuver</button>
            </div>
          </div>
        </div>

        <div class="validation-detail page-card">
          <div *ngIf="selectedVendeur; else emptyState">
            <div class="section-title">
              <div>
                <h3>{{ selectedVendeur.user.name }}</h3>
                <p>Vendeur candidat • {{ selectedVendeur.user.email }}</p>
              </div>
              <span class="status-pill" [class.active]="selectedVendeur.est_premium">Premium</span>
            </div>
            <div class="detail-row">
              <div>
                <strong>Situation</strong>
                <p>{{ selectedVendeur.status_compte }}</p>
              </div>
              <div>
                <strong>Statut abonnement</strong>
                <p>{{ selectedVendeur.est_premium ? 'Premium activé' : 'Standard' }}</p>
              </div>
            </div>
            <div class="documents-grid">
              <div class="document-card">Dossier de documents</div>
              <div class="document-card">Pièce d’identité</div>
            </div>
            <div class="detail-actions">
              <button class="cta-button">Approuver le vendeur</button>
              <button class="header-action">Rejeter</button>
            </div>
          </div>
          <ng-template #emptyState>
            <p>Sélectionnez un vendeur pour voir son dossier.</p>
          </ng-template>
        </div>
      </div>
    </section>
  `,
  styles: [
    `
      .badge {
        display: inline-flex;
        padding: 0.65rem 1rem;
        border-radius: 999px;
        background: #ecfdf5;
        color: #065f46;
        font-weight: 700;
      }

      .validation-layout {
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 1rem;
      }

      .validation-list {
        display: grid;
        gap: 1rem;
      }

      input[type='search'] {
        width: 100%;
        padding: 0.95rem 1rem;
        border-radius: 16px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
      }

      .validation-item {
        padding: 1rem;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .validation-actions {
        display: flex;
        gap: 0.75rem;
      }

      .validation-detail {
        display: grid;
        gap: 1rem;
      }

      .status-pill {
        display: inline-flex;
        padding: 0.5rem 0.75rem;
        border-radius: 999px;
        background: #f3f4f6;
        color: #374151;
      }

      .status-pill.active {
        background: #ecfdf5;
        color: #065f46;
      }

      .detail-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
      }

      .documents-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
      }

      .document-card {
        min-height: 120px;
        border-radius: 20px;
        background: #f8fafc;
        display: grid;
        place-items: center;
        font-weight: 700;
        color: #475569;
      }

      .detail-actions {
        display: flex;
        gap: 0.75rem;
      }

      @media (max-width: 900px) {
        .validation-layout {
          grid-template-columns: 1fr;
        }
      }
    `,
  ],
})
export class ValidationsComponent implements OnInit {
  vendeurs: Vendeur[] = [];
  selectedVendeur: Vendeur | null = null;
  query = '';

  constructor(private readonly vendeurService: VendeurService) {}

  ngOnInit(): void {
    this.vendeurService.list().subscribe({
      next: (vendeurs) => {
        this.vendeurs = vendeurs;
        this.selectedVendeur = vendeurs.length ? vendeurs[0] : null;
      },
    });
  }

  filteredVendeurs(): Vendeur[] {
    if (!this.query.trim()) {
      return this.vendeurs;
    }

    const q = this.query.toLowerCase();
    return this.vendeurs.filter((vendeur) =>
      vendeur.user.name.toLowerCase().includes(q) || vendeur.user.email.toLowerCase().includes(q)
    );
  }
}
