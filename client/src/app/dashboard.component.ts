import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  standalone: true,
  imports: [CommonModule],
  selector: 'app-dashboard',
  template: `
    <section class="page-card">
      <div class="section-title">
        <div>
          <h2>Tableau de bord analytique</h2>
          <p>Suivi des performances, du trafic et des revenus de la plateforme.</p>
        </div>
        <button class="cta-button">Exporter rapport</button>
      </div>

      <div class="card-grid">
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Visites totales</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">124,5K</div>
          <div style="margin-top: 0.6rem; color: #047857;">+18,4% vs mois dernier</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Nouvelles commandes</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">4 800</div>
          <div style="margin-top: 0.6rem; color: #047857;">+9,8% vs mois dernier</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Revenu total</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">45,2M FCFA</div>
          <div style="margin-top: 0.6rem; color: #047857;">+6,1% vs mois dernier</div>
        </div>
        <div class="page-card" style="background: #ecfdf5; border-radius: 24px;">
          <strong>Panier moyen</strong>
          <div style="margin-top: 1rem; font-size: 2rem; font-weight: 700;">9 400 FCFA</div>
          <div style="margin-top: 0.6rem; color: #047857;">+3,2% vs mois dernier</div>
        </div>
      </div>
    </section>

    <section class="page-card">
      <div class="section-title">
        <div>
          <h2>Aperçu du trafic & ventes</h2>
          <p>Analyse de la fréquentation, des conversions et du chiffre d’affaires.</p>
        </div>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
          <button class="header-action">7 jours</button>
          <button class="header-action">30 jours</button>
          <button class="header-action">90 jours</button>
        </div>
      </div>

      <div class="traffic-summary-grid">
        <div class="traffic-stat-card">
          <span>Visites</span>
          <strong>124 500</strong>
          <p>Trafic total sur la période sélectionnée.</p>
        </div>
        <div class="traffic-stat-card">
          <span>Commandes</span>
          <strong>4 800</strong>
          <p>Nombre de transactions validées par les clients.</p>
        </div>
        <div class="traffic-stat-card">
          <span>Revenu</span>
          <strong>45,2M FCFA</strong>
          <p>Montant total généré par les ventes.</p>
        </div>
        <div class="traffic-stat-card">
          <span>Conversion</span>
          <strong>4.1%</strong>
          <p>Taux de conversion moyen de la période.</p>
        </div>
      </div>

      <div class="traffic-chart-box">
        <div class="traffic-chart-title">Tendance du trafic et des ventes</div>
        <div class="traffic-chart-bars">
          <div class="traffic-bar-item">
            <span>Jan</span>
            <div class="traffic-bar-wrapper"><div class="traffic-bar" style="width: 90%;"></div></div>
            <strong>90%</strong>
          </div>
          <div class="traffic-bar-item">
            <span>Fév</span>
            <div class="traffic-bar-wrapper"><div class="traffic-bar" style="width: 78%;"></div></div>
            <strong>78%</strong>
          </div>
          <div class="traffic-bar-item">
            <span>Mar</span>
            <div class="traffic-bar-wrapper"><div class="traffic-bar" style="width: 87%;"></div></div>
            <strong>87%</strong>
          </div>
          <div class="traffic-bar-item">
            <span>Avr</span>
            <div class="traffic-bar-wrapper"><div class="traffic-bar" style="width: 94%;"></div></div>
            <strong>94%</strong>
          </div>
          <div class="traffic-bar-item">
            <span>Mai</span>
            <div class="traffic-bar-wrapper"><div class="traffic-bar" style="width: 81%;"></div></div>
            <strong>81%</strong>
          </div>
        </div>
      </div>
    </section>

    <section class="page-card">
      <div class="section-title">
        <h2>Top vendeurs de la période</h2>
        <a class="label-pill" routerLink="/utilisateurs">Voir tout</a>
      </div>
      <div class="card-grid">
        <div class="page-card" style="border-radius: 24px;">
          <strong>Tissus de Dakar</strong>
          <p style="margin: 0.75rem 0 0; color: #6b7280;">Mode • 1.2M CFA</p>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Artisans du Nord</strong>
          <p style="margin: 0.75rem 0 0; color: #6b7280;">Artisanat • 950K CFA</p>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Saveurs Locales</strong>
          <p style="margin: 0.75rem 0 0; color: #6b7280;">Alimentation • 820K CFA</p>
        </div>
        <div class="page-card" style="border-radius: 24px;">
          <strong>Bijoux Touareg</strong>
          <p style="margin: 0.75rem 0 0; color: #6b7280;">Décoration • 740K CFA</p>
        </div>
      </div>
    </section>
  `,
})
export class DashboardComponent {}
