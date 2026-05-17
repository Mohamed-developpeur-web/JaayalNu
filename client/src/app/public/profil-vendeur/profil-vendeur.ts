import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { VendeurService } from '../../vendeur.service';
import { Vendeur } from '../../vendeur.model';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-profil-vendeur',
  templateUrl: './profil-vendeur.html',
  styleUrls: ['./profil-vendeur.css'],
  standalone: true,
  imports: [CommonModule],
})
export class ProfilVendeur implements OnInit {
  vendeur: Vendeur | null = null;
  loading = true;
  errorMessage = '';

  constructor(
    private readonly route: ActivatedRoute,
    private readonly vendeurService: VendeurService,
  ) {}

  ngOnInit(): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    if (isNaN(id)) {
      this.errorMessage = 'Identifiant vendeur invalide.';
      this.loading = false;
      return;
    }

    this.vendeurService.get(id).subscribe({
      next: (v) => {
        this.vendeur = v;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger le profil vendeur.';
        this.loading = false;
      },
    });
  }
}
