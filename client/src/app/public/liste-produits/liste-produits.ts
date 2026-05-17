import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { CommonModule, DecimalPipe } from '@angular/common';
import { ProductService } from '../../product.service';
import { CategoryService } from '../../category.service';
import { Product } from '../../product.model';
import { Category } from '../../category.model';

@Component({
  selector: 'app-liste-produits',
  templateUrl: './liste-produits.html',
  styleUrls: ['./liste-produits.css'],
  standalone: true,
  imports: [CommonModule, RouterLink, DecimalPipe],
})
export class ListeProduits implements OnInit {
  produits: Product[] = [];
  categories: Category[] = [];
  loading = true;
  errorMessage = '';

  constructor(
    private readonly productService: ProductService,
    private readonly categoryService: CategoryService,
    private readonly route: ActivatedRoute,
    public readonly router: Router,
  ) {}

  ngOnInit(): void {
    this.loadCategories();
    this.route.queryParams.subscribe((params) => {
      const cat = params['categorie'];
      this.loadProducts(cat ? Number(cat) : undefined);
    });
  }

  private loadCategories(): void {
    this.categoryService.list().subscribe({
      next: (categories) => (this.categories = categories),
      error: () => (this.errorMessage = 'Impossible de charger les catégories.'),
    });
  }

  private loadProducts(categorieId?: number): void {
    this.loading = true;
    this.productService.list().subscribe({
      next: (produits) => {
        this.produits = categorieId ? produits.filter((p) => p.categorie.id === categorieId) : produits;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger les produits.';
        this.loading = false;
      },
    });
  }
}
