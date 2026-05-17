import { Component, OnInit, ViewChild, ElementRef, AfterViewInit } from '@angular/core';
import { ProductService } from '../../product.service';
import { CategoryService } from '../../category.service';
import { Product } from '../../product.model';
import { Category } from '../../category.model';
import { CommonModule, DecimalPipe } from '@angular/common';
import { RouterLink } from '@angular/router';

interface TrafficData {
  labels: string[];
  values: number[];
}

@Component({
  selector: 'app-accueil',
  templateUrl: './accueil.html',
  styleUrls: ['./accueil.css'],
  standalone: true,
  imports: [CommonModule, RouterLink, DecimalPipe],
})
export class Accueil implements OnInit, AfterViewInit {
  @ViewChild('trafficChart') trafficChart!: ElementRef<HTMLCanvasElement>;

  categories: Category[] = [];
  produits: Product[] = [];
  loading = true;
  errorMessage = '';

  // Statistiques KPI
  totalProduits = 0;
  totalVendeurs = 0;
  totalCategories = 0;
  produitEnVente = 0;

  // Données du graphique de trafic
  trafficData: TrafficData = {
    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
    values: [120, 190, 150, 170, 140, 200, 180],
  };

  chartOptions = {
    responsive: true,
    maintainAspectRatio: true,
    padding: 20,
  };

  constructor(
    private readonly productService: ProductService,
    private readonly categoryService: CategoryService,
  ) {}

  ngOnInit(): void {
    this.loadContent();
  }

  ngAfterViewInit(): void {
    if (this.trafficChart) {
      setTimeout(() => this.drawTrafficChart(), 100);
    }
  }

  private loadContent(): void {
    this.loading = true;
    
    this.categoryService.list().subscribe({
      next: (categories) => {
        this.categories = categories;
        this.totalCategories = categories.length;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger les catégories.';
      },
    });

    this.productService.list().subscribe({
      next: (produits) => {
        this.totalProduits = produits.length;
        this.produitEnVente = produits.filter(p => p.stock > 0).length;
        
        // Calculer nombre de vendeurs uniques
        const vendeurs = new Set(produits.map(p => p.vendeur.id));
        this.totalVendeurs = vendeurs.size;

        this.produits = produits
          .sort((a, b) => b.id - a.id)
          .slice(0, 6);
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Impossible de charger les produits.';
        this.loading = false;
      },
    });
  }

  private drawTrafficChart(): void {
    const canvas = this.trafficChart?.nativeElement;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const chartWidth = canvas.offsetWidth;
    const chartHeight = canvas.offsetHeight;
    canvas.width = chartWidth;
    canvas.height = chartHeight;

    const padding = 40;
    const maxValue = Math.max(...this.trafficData.values);
    const graphWidth = chartWidth - padding * 2;
    const graphHeight = chartHeight - padding * 2;
    const barWidth = graphWidth / this.trafficData.values.length;

    // Fond blanc
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, chartWidth, chartHeight);

    // Grille horizontale
    ctx.strokeStyle = '#e0e0e0';
    ctx.lineWidth = 1;
    for (let i = 0; i <= 5; i++) {
      const y = padding + (graphHeight / 5) * i;
      ctx.beginPath();
      ctx.moveTo(padding, y);
      ctx.lineTo(chartWidth - padding, y);
      ctx.stroke();
    }

    // Barres avec gradient
    const gradient = ctx.createLinearGradient(0, padding, 0, chartHeight - padding);
    gradient.addColorStop(0, '#4f46e5');
    gradient.addColorStop(1, '#7c3aed');

    this.trafficData.values.forEach((value, index) => {
      const barHeight = (value / maxValue) * graphHeight;
      const x = padding + index * barWidth + barWidth * 0.1;
      const y = chartHeight - padding - barHeight;

      ctx.fillStyle = gradient;
      ctx.fillRect(x, y, barWidth * 0.8, barHeight);
    });

    // Labels X
    ctx.fillStyle = '#666';
    ctx.font = '12px Arial';
    ctx.textAlign = 'center';
    this.trafficData.labels.forEach((label, index) => {
      const x = padding + index * barWidth + barWidth / 2;
      ctx.fillText(label, x, chartHeight - padding + 20);
    });

    // Labels Y (valeurs)
    ctx.textAlign = 'right';
    ctx.fillStyle = '#999';
    for (let i = 0; i <= 5; i++) {
      const value = Math.round((maxValue / 5) * i);
      const y = chartHeight - padding - (graphHeight / 5) * i + 4;
      ctx.fillText(value.toString(), padding - 10, y);
    }

    // Titre
    ctx.fillStyle = '#333';
    ctx.font = 'bold 16px Arial';
    ctx.textAlign = 'left';
    ctx.fillText('Trafic hebdomadaire', padding, 25);
  }
}
