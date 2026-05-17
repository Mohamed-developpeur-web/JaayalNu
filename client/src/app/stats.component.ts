import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  standalone: true,
  imports: [CommonModule],
  selector: 'app-stats',
  template: `
    <section class="page-card">
      <div class="section-title">
        <h2>Analyses et statistiques</h2>
        <div style="display: flex; gap: 0.5rem;">
          <button class="header-action">7 jours</button>
          <button class="header-action">30 jours</button>
          <button class="header-action">90 jours</button>
        </div>
      </div>

      <div class="card-grid">
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Vues Totales</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">24,850</div>
          <div style="margin-top: 0.6rem; color: #047857;">+12.5% vs mois dernier</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Taux de conversion</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">3.2%</div>
          <div style="margin-top: 0.6rem; color: #dc2626;">-0.4% vs WhatsApp</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Messages reçus</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">142</div>
          <div style="margin-top: 0.6rem; color: #047857;">+18.2% nouveaux prospects</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Produits actifs</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">28</div>
          <div style="margin-top: 0.6rem; color: #047857;">+2 ce mois-ci</div>
        </div>
      </div>
    </section>

    <section class="page-card">
      <div class="section-title">
        <h2>Top produits performants</h2>
      </div>
      <div class="card-grid">
        <div class="page-card" style="border-radius: 24px;">
          <strong>Boubou Traditionnel Brodé</strong>
          <p style="margin: 0.75rem 0 0.5rem; color: #6b7280;">1,240 vues • +12%</p>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Statue en Bronze de Dakar</strong>
          <p style="margin: 0.75rem 0 0.5rem; color: #6b7280;">980 vues • +8%</p>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Collier Perles Traditionnelles</strong>
          <p style="margin: 0.75rem 0 0.5rem; color: #6b7280;">850 vues • +6%</p>
        </div>
      </div>
    </section>
  `,
})
export class StatsComponent {}
