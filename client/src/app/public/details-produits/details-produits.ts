import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../product.service';
import { Product } from '../../product.model';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-details-produits',
  templateUrl: './details-produits.html',
  styleUrls: ['./details-produits.css'],
  standalone: true,
  imports: [CommonModule],
})
export class DetailsProduits implements OnInit {
  produit: Product | null = null;
  loading = true;
  errorMessage = '';

  constructor(
    private readonly route: ActivatedRoute,
    private readonly productService: ProductService,
  ) {}

  ngOnInit(): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    if (isNaN(id)) {
      this.errorMessage = 'Identifiant de produit invalide.';
      this.loading = false;
      return;
    }

    this.productService.get(id).subscribe({
      next: (p) => {
        this.produit = p;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger le produit.';
        this.loading = false;
      },
    });
  }
}
