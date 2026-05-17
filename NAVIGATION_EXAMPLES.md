# 📚 Guide d'Utilisation - Navigation et Routes

Ce guide montre comment utiliser les routes et la navigation dans l'application Jaayal Marketplace.

---

## 🔗 Utilisation de RouterLink dans les Templates

### Exemple 1 : Lien Simple
```html
<!-- Navigation vers la page des produits -->
<a routerLink="/public/produits">Voir tous les produits</a>
```

### Exemple 2 : Lien avec Paramètre
```html
<!-- Navigation vers les détails d'un produit avec ID -->
<a [routerLink]="['/public/produits', produit.id]">
  Voir détails
</a>

<!-- Équivalent à : /public/produits/123 -->
```

### Exemple 3 : Navigation avec Classe Active
```html
<!-- Le lien est stylisé en bleu quand la route est active -->
<a 
  routerLink="/vendeur/mes-produits" 
  routerLinkActive="active"
  [routerLinkActiveOptions]="{ exact: true }"
>
  Mes Produits
</a>
```

### Exemple 4 : Navigation Conditionnelle
```html
<!-- Navigation en fonction de l'état -->
<button [routerLink]="userRole === 'vendeur' ? '/vendeur' : '/admin'">
  Accéder à mon espace
</button>
```

---

## 🎯 Navigation Programmatique (dans TypeScript)

### Exemple 1 : Navigation Simple
```typescript
import { Router } from '@angular/router';

constructor(private router: Router) {}

goToDashboard() {
  this.router.navigate(['/vendeur']);
}
```

### Exemple 2 : Navigation avec Paramètre
```typescript
editProduct(productId: number) {
  this.router.navigate(['/vendeur/modifier-produit', productId]);
}

// Génère l'URL : /vendeur/modifier-produit/123
```

### Exemple 3 : Navigation avec Query Parameters
```typescript
searchProducts(query: string) {
  this.router.navigate(['/public/produits'], {
    queryParams: { search: query, page: 1 }
  });
}

// Génère l'URL : /public/produits?search=laptop&page=1
```

### Exemple 4 : Récupérer les Paramètres
```typescript
import { ActivatedRoute } from '@angular/router';

constructor(private route: ActivatedRoute) {}

ngOnInit() {
  // Récupérer le paramètre :id de la route
  this.route.params.subscribe(params => {
    const productId = params['id'];
    console.log('ID du produit :', productId);
  });
  
  // Récupérer les query parameters
  this.route.queryParams.subscribe(params => {
    const search = params['search'];
    const page = params['page'];
  });
}
```

---

## 📋 Cas d'Usage Pratiques

### 1️⃣ Vendeur Ajoutant un Produit

**Template (ajouter-produit.html) :**
```html
<form (ngSubmit)="saveProduit()">
  <input [(ngModel)]="produit.nom" placeholder="Nom du produit" />
  <input [(ngModel)]="produit.prix" placeholder="Prix" />
  <button type="submit">Ajouter le produit</button>
</form>
```

**Composant (ajouter-produit.ts) :**
```typescript
import { Router } from '@angular/router';

export class AjouterProduit {
  produit = { nom: '', prix: 0 };

  constructor(
    private produitService: ProduitService,
    private router: Router
  ) {}

  saveProduit() {
    this.produitService.create(this.produit).subscribe(() => {
      // Après enregistrement, rediriger vers la liste
      this.router.navigate(['/vendeur/mes-produits']);
    });
  }
}
```

### 2️⃣ Affichage des Détails d'un Produit

**Template (liste-produits.html) :**
```html
<div *ngFor="let produit of produits">
  <h3>{{ produit.nom }}</h3>
  <p>{{ produit.prix }}€</p>
  <a [routerLink]="['/public/produits', produit.id]">
    Voir détails
  </a>
</div>
```

**Composant (details-produits.ts) :**
```typescript
import { ActivatedRoute } from '@angular/router';

export class DetailsProduits {
  produit: any;

  constructor(
    private route: ActivatedRoute,
    private produitService: ProduitService
  ) {}

  ngOnInit() {
    // Récupérer l'ID depuis l'URL
    this.route.params.subscribe(params => {
      const id = params['id'];
      
      // Charger le produit
      this.produitService.getById(id).subscribe(produit => {
        this.produit = produit;
      });
    });
  }
}
```

### 3️⃣ Menu de Navigation

**Template (app.html) :**
```html
<nav class="app-nav">
  <!-- Lien vers la vitrine -->
  <a routerLink="/public" routerLinkActive="active">
    🏪 Accueil
  </a>

  <!-- Lien vers le catalogue -->
  <a routerLink="/public/produits" routerLinkActive="active">
    📦 Catalogue
  </a>

  <!-- Lien conditionnel pour vendeur -->
  <a 
    *ngIf="isVendeur" 
    routerLink="/vendeur" 
    routerLinkActive="active"
  >
    🏢 Mon Espace
  </a>

  <!-- Lien conditionnel pour admin -->
  <a 
    *ngIf="isAdmin" 
    routerLink="/admin" 
    routerLinkActive="active"
  >
    ⚙️ Administration
  </a>
</nav>
```

---

## 🔐 Navigation Sécurisée (Avec Guards)

### Exemple : Protection des Routes Admin

**auth.guard.ts :**
```typescript
import { Injectable } from '@angular/core';
import { Router, CanActivate } from '@angular/router';

@Injectable({ providedIn: 'root' })
export class AdminGuard implements CanActivate {
  constructor(
    private authService: AuthService,
    private router: Router
  ) {}

  canActivate(): boolean {
    if (this.authService.isAdmin()) {
      return true;
    }
    this.router.navigate(['/public/connexion']);
    return false;
  }
}
```

**app.routes.ts :**
```typescript
export const routes: Routes = [
  {
    path: 'admin',
    loadChildren: () => import('./admin/admin.module').then(m => m.AdminModule),
    canActivate: [AdminGuard]  // ← Protection ajoutée
  },
];
```

---

## 📊 Navigation avec Données

### Exemple : Passer des Données entre Composants

**De : mes-produits.html**
```html
<button 
  (click)="editProduct(produit)"
  [routerLink]="['/vendeur/modifier-produit', produit.id]"
  [state]="{ produit: produit }"
>
  Modifier
</button>
```

**À : modifier-produit.ts**
```typescript
export class ModifierProduit {
  produit: any;

  constructor(private router: Router) {}

  ngOnInit() {
    // Récupérer les données transmises
    const navigation = this.router.getCurrentNavigation();
    if (navigation?.extras.state) {
      this.produit = navigation.extras.state.produit;
    }
  }
}
```

---

## 🚦 Redirection et Fallback

### Exemple : Redirection par Défaut

**Dans app.routes.ts :**
```typescript
export const routes: Routes = [
  // Routes spécifiques
  { path: '', component: DashboardComponent },
  { path: 'public', loadChildren: () => import('./public/public.module').then(m => m.PublicModule) },
  
  // Fallback : redirection vers l'accueil
  { path: '**', redirectTo: '' }
];
```

Quand un utilisateur accède à une route inexistante comme `/inexistant`, il est redirigé vers `/`.

---

## 🎯 Bonnes Pratiques

### ✅ À Faire

```html
<!-- ✅ Bon : Utiliser routerLink pour la navigation -->
<a routerLink="/public/produits">Produits</a>

<!-- ✅ Bon : Ajouter routerLinkActive pour le style actif -->
<a routerLink="/vendeur" routerLinkActive="active">Vendeur</a>

<!-- ✅ Bon : Utiliser [routerLink] avec paramètres dynamiques -->
<a [routerLink]="['/public/produits', id]">Détails</a>
```

### ❌ À Éviter

```html
<!-- ❌ Mauvais : Utiliser href pour la navigation interne -->
<a href="/public/produits">Produits</a>
<!-- Cause un rechargement de la page -->

<!-- ❌ Mauvais : Laisser des routes orphelines -->
<!-- Toutes les routes doivent être déclarées dans les modules -->

<!-- ❌ Mauvais : Oublier les paramètres requis -->
<a routerLink="/public/produits/undefined">Détails</a>
```

---

## 🧪 Test de Navigation

### Test Simple
```bash
# Vérifier que tous les liens fonctionnent
ng serve

# Cliquer sur chaque lien du menu
# Vérifier que :
# - La page se change sans rechargement
# - L'URL change correctement
# - Le lien actif est souligné
```

### Test Programmatique
```typescript
import { TestBed } from '@angular/core/testing';
import { Router } from '@angular/router';

describe('Navigation', () => {
  let router: Router;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      // configuration
    }).compileComponents();
    router = TestBed.inject(Router);
  });

  it('devrait naviguer vers /vendeur', async () => {
    await router.navigate(['/vendeur']);
    expect(router.url).toBe('/vendeur');
  });
});
```

---

## 📞 Débogage

### Chrome DevTools
1. Ouvrir les DevTools (F12)
2. Aller à l'onglet **Network**
3. Cliquer sur les liens
4. Vérifier qu'il n'y a pas de requête pour `.html`
5. Vérifier que l'URL change

### Console Angular
```typescript
// Dans le composant
constructor(private router: Router) {
  console.log('URL actuelle :', this.router.url);
}
```

### Router Events
```typescript
constructor(private router: Router) {
  this.router.events.subscribe(event => {
    console.log('Event router:', event);
  });
}
```

---

## 📚 Ressources

- [Documentation Angular Router](https://angular.io/guide/router)
- [RouterLink API](https://angular.io/api/router/RouterLink)
- [ActivatedRoute API](https://angular.io/api/router/ActivatedRoute)

---

**Dernière mise à jour** : 15 mai 2026  
**Version** : 1.0
