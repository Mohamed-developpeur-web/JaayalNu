import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  standalone: true,
  imports: [CommonModule],
  selector: 'app-users',
  template: `
    <section class="page-card">
      <div class="section-title">
        <h2>Gestion des utilisateurs</h2>
        <p>Supervisez les comptes, rôles et statuts des membres.</p>
      </div>
      <div style="display: grid; gap: 1rem;">
        <div class="page-card" style="border-radius: 24px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <strong>Moussa Diop</strong>
            <p style="margin: 0.5rem 0 0; color: #6b7280;">Vendeur • Actif</p>
          </div>
          <button class="header-action">Voir profil</button>
        </div>
        <div class="page-card" style="border-radius: 24px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <strong>Fatou Sow</strong>
            <p style="margin: 0.5rem 0 0; color: #6b7280;">Acheteuse • Actif</p>
          </div>
          <button class="header-action">Voir profil</button>
        </div>
        <div class="page-card" style="border-radius: 24px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <strong>Abdoulaye Ndiaye</strong>
            <p style="margin: 0.5rem 0 0; color: #6b7280;">Vendeur • Suspendu</p>
          </div>
          <button class="header-action">Gérer</button>
        </div>
      </div>
    </section>
  `,
})
export class UsersComponent {}
