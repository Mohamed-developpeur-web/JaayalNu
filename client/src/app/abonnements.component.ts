import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  standalone: true,
  imports: [CommonModule],
  selector: 'app-abonnements',
  template: `
    <section class="page-card">
      <div class="section-title">
        <h2>Gestion des abonnements</h2>
        <p>Suivez les ventes premium et les forfaits des vendeurs.</p>
      </div>

      <div class="card-grid">
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Abonnements actifs</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">1,284</div>
          <div style="margin-top: 0.6rem; color: #047857;">+12% ce mois-ci</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Expirations à 30j</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">42</div>
          <div style="margin-top: 0.6rem; color: #047857;">Relancer les vendeurs</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Revenus Mensuels</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">4.2M FCFA</div>
          <div style="margin-top: 0.6rem; color: #047857;">+15.4% croissance</div>
        </div>
        <div class="page-card" style="background: #fff1f2; border-radius: 24px;">
          <strong>Paiements échoués</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">08</div>
          <div style="margin-top: 0.6rem; color: #b91c1c;">À vérifier rapidement</div>
        </div>
      </div>
    </section>

    <section class="page-card">
      <div class="section-title">
        <h2>Forfaits disponibles</h2>
      </div>
      <div class="card-grid">
        <div class="page-card" style="border-radius: 24px;">
          <strong>Basique</strong>
          <p style="margin: 0.75rem 0 1rem; color: #6b7280;">Gratuit jusqu'à 3 produits, messagerie standard.</p>
          <div style="font-size: 1.75rem; font-weight: 700;">0 FCFA/mois</div>
        </div>
        <div class="page-card" style="border-radius: 24px; background: #ecfdf5;">
          <strong>Premium Pro</strong>
          <p style="margin: 0.75rem 0 1rem; color: #6b7280;">Visibilité prioritaire, statistiques avancées.</p>
          <div style="font-size: 1.75rem; font-weight: 700;">15 000 FCFA/mois</div>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Pack Annuel</strong>
          <p style="margin: 0.75rem 0 1rem; color: #6b7280;">Économisez 20% avec paiement annuel.</p>
          <div style="font-size: 1.75rem; font-weight: 700;">150 000 FCFA/an</div>
        </div>
      </div>
    </section>
  `,
})
export class AbonnementsComponent {}
