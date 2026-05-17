import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.html',
  styleUrls: ['./footer.css'],
  standalone: true,
  imports: [CommonModule, RouterLink],
})
export class FooterComponent {
  currentYear = new Date().getFullYear();

  footerLinks = {
    about: [
      { label: 'À propos de nous', link: '/public' },
      { label: 'Comment ça marche', link: '/public' },
      { label: 'Nos vendeurs', link: '/public' },
      { label: 'Blog', link: '/public' },
    ],
    support: [
      { label: 'Centre d\'aide', link: '/public' },
      { label: 'Contact', link: '/public' },
      { label: 'FAQ', link: '/public' },
      { label: 'Suivre ma commande', link: '/public' },
    ],
    sellers: [
      { label: 'Devenir vendeur', link: '/public/inscription' },
      { label: 'Guide du vendeur', link: '/public' },
      { label: 'Outils de vente', link: '/public' },
      { label: 'Tarification', link: '/public' },
    ],
    legal: [
      { label: 'Politique de confidentialité', link: '/public' },
      { label: 'Conditions d\'utilisation', link: '/public' },
      { label: 'Mentions légales', link: '/public' },
      { label: 'Politique de cookies', link: '/public' },
    ],
  };

  socialLinks = [
    { icon: '📘', label: 'Facebook', link: '#' },
    { icon: '🐦', label: 'Twitter', link: '#' },
    { icon: '📷', label: 'Instagram', link: '#' },
    { icon: '▶️', label: 'YouTube', link: '#' },
  ];

  contactInfo = [
    { icon: '📍', label: 'Adresse', value: 'Dakar, Sénégal' },
    { icon: '📧', label: 'Email', value: 'support@jaayal.com' },
    { icon: '📱', label: 'Téléphone', value: '+221 78 123 45 67' },
  ];

  scrollToTop(): void {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
}
