# 🔗 Intégration Frontend-Backend - Guide Complet

Ce document montre comment les routes Angular du frontend communiquent avec les routes et contrôleurs Laravel du backend.

---

## 🏗️ Architecture Frontend-Backend

```
┌─────────────────────────────────────────────────────┐
│            FRONTEND ANGULAR (localhost:4200)        │
│                                                     │
│  ┌──────────────────────────────────────────────┐  │
│  │        Routes & Composants Angular           │  │
│  │  /vendeur, /admin, /public, etc.             │  │
│  └───────────────┬────────────────────────────┘  │
│                  │                                │
│             HttpClient                           │
│           (services)                              │
│                  │                                │
│                  ▼                                │
│  ┌──────────────────────────────────────────────┐  │
│  │        API Calls (JSON)                       │  │
│  │  GET/POST /api/produits, /api/users, etc.    │  │
│  └───────────────┬────────────────────────────┘  │
│                  │                                │
└──────────────────┼────────────────────────────────┘
                   │
                   │ HTTP/HTTPS
                   │
┌──────────────────▼────────────────────────────────┐
│           BACKEND LARAVEL (localhost:8000)        │
│                                                     │
│  ┌──────────────────────────────────────────────┐  │
│  │      Routes & Contrôleurs Laravel             │  │
│  │  /api/produits, /api/users, etc.              │  │
│  │  + /users, /produits (routes web)             │  │
│  └───────────────┬────────────────────────────┘  │
│                  │                                │
│                  ▼                                │
│  ┌──────────────────────────────────────────────┐  │
│  │        Base de Données (MySQL)                │  │
│  │  produits, users, categories, etc.            │  │
│  └──────────────────────────────────────────────┘  │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## 📋 Mappage des Routes

### 1. Gestion des Produits

#### Frontend (Angular)
```
GET  /public/produits              → Affiche liste
GET  /public/produits/:id          → Détails produit
GET  /vendeur/mes-produits         → Mes produits (vendeur)
GET  /vendeur/ajouter-produit      → Formulaire ajout
POST /vendeur/ajouter-produit      → Soumettre
GET  /vendeur/modifier-produit/:id → Formulaire edit
PUT  /vendeur/modifier-produit/:id → Soumettre
GET  /admin/produits               → Gestion admin
```

#### Backend (Laravel)

**Routes définies dans `routes/web.php` :**
```php
Route::resources([
    'produits' => ProduitController::class,
]);
```

**Routes API définies dans `routes/web.php` :**
```php
Route::prefix('api')->as('api.')->group(function () {
    Route::resources([
        'produits' => ProduitController::class,
    ]);
});
```

**Contrôleur : `app/Http/Controllers/ProduitController.php`**
```php
class ProduitController extends Controller {
    public function index()      // GET /api/produits
    public function create()     // GET /produits/create
    public function store()      // POST /api/produits
    public function show($id)    // GET /api/produits/:id
    public function edit($id)    // GET /produits/:id/edit
    public function update()     // PUT /api/produits/:id
    public function destroy()    // DELETE /api/produits/:id
}
```

---

### 2. Authentification

#### Frontend (Angular)
```
GET  /public/connexion    → Formulaire login
POST /public/connexion    → Soumettre credentials
GET  /public/inscription  → Formulaire register
POST /public/inscription  → Soumettre registration
```

#### Backend (Laravel)
- **Modèle** : `app/Models/User.php`
- **Routes** : Utilise les routes Laravel par défaut
- **Contrôleurs** : `AuthController` (à créer)

---

### 3. Gestion Vendeur

#### Frontend (Angular)
```
GET  /vendeur                    → Dashboard vendeur
GET  /vendeur/mes-produits       → List produits
GET  /vendeur/ajouter-produit    → Formulaire
POST /vendeur/ajouter-produit    → Créer
GET  /vendeur/messages           → Messages reçus
GET  /vendeur/statistiques       → Stats
GET  /vendeur/modifier-profil    → Profil
PUT  /vendeur/modifier-profil    → Mettre à jour
```

#### Backend (Laravel)
- **Modèle** : `app/Models/Vendeur.php`
- **Contrôleur** : `VendeurController.php`
- **Routes API** :
```php
Route::apiResource('vendeurs', VendeurController::class);
Route::post('vendeurs/{id}/produits', 'VendeurController@addProduct');
Route::get('vendeurs/{id}/statistiques', 'VendeurController@stats');
```

---

### 4. Administration

#### Frontend (Angular)
```
GET  /admin                        → Dashboard admin
GET  /admin/utilisateurs           → Gestion users
GET  /admin/produits               → Gestion produits
GET  /admin/categories             → Gestion catégories
GET  /admin/abonnements            → Gestion abonnements
GET  /admin/validation-vendeur     → Valider vendeurs
GET  /admin/statistiques           → Stats globales
```

#### Backend (Laravel)
- **Modèles** : `User.php`, `Produit.php`, `Categorie.php`, etc.
- **Contrôleurs** :
  - `AdministrateurController.php`
  - `UserController.php`
  - `ProduitController.php`
  - `CategorieController.php`
  - `AbonnementPremiumController.php`

---

## 🔄 Flux de Communication Exemple

### Scénario : Un vendeur ajoute un produit

```
1. FRONTEND - Utilisateur
   └─→ Navigate to /vendeur/ajouter-produit
       └─→ AjouterProduit component loads

2. FRONTEND - Formulaire
   User fills: nom, prix, description
   └─→ Clique "Ajouter"

3. FRONTEND - Service
   ProduitService.create(produit)
   └─→ POST /api/produits
       Headers: 'Content-Type: application/json'
       Body: { nom: "...", prix: 100, ... }

4. BACKEND - Route
   POST /api/produits → ProduitController@store()

5. BACKEND - Contrôleur
   ProduitController.store()
   ├─→ Valide les données
   ├─→ Crée le produit en DB
   └─→ Retourne produit créé (JSON)

6. FRONTEND - Réponse
   Service reçoit: { id: 123, nom: "...", ... }
   ├─→ Notifie l'utilisateur (toast)
   ├─→ Navigate to /vendeur/mes-produits
   └─→ Affiche le nouveau produit

7. FRONTEND - Liste Mise à Jour
   MesProduits component
   ├─→ GET /api/vendeurs/:id/produits
   ├─→ Reçoit la liste mise à jour
   └─→ Affiche les produits (y compris le nouveau)
```

---

## 🔌 Services Angular (HttpClient)

### Exemple 1 : ProduitService

**Fichier : `client/src/app/produit.service.ts`**
```typescript
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class ProduitService {
  private apiUrl = '/api/produits';

  constructor(private http: HttpClient) {}

  // Lister tous les produits
  list(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  // Obtenir un produit
  getById(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }

  // Créer un produit
  create(produit: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, produit);
  }

  // Modifier un produit
  update(id: number, produit: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, produit);
  }

  // Supprimer un produit
  delete(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}
```

### Exemple 2 : Utilisation dans un Composant

**Fichier : `client/src/app/vendeur/mes-produits/mes-produits.ts`**
```typescript
import { Component, OnInit } from '@angular/core';
import { ProduitService } from '../../produit.service';

export class MesProduits implements OnInit {
  produits: any[] = [];
  loading = true;
  error: string | null = null;

  constructor(private produitService: ProduitService) {}

  ngOnInit() {
    this.loadProduits();
  }

  loadProduits() {
    this.produitService.list().subscribe(
      (data) => {
        this.produits = data;
        this.loading = false;
      },
      (err) => {
        this.error = 'Erreur lors du chargement';
        this.loading = false;
      }
    );
  }

  deleteProduit(id: number) {
    if (confirm('Confirmer la suppression ?')) {
      this.produitService.delete(id).subscribe(() => {
        this.produits = this.produits.filter(p => p.id !== id);
      });
    }
  }
}
```

---

## 🛠️ Configuration du Backend

### 1. CORS (Cross-Origin)

**Fichier : `config/cors.php`**
```php
'allowed_origins' => ['localhost:4200', '127.0.0.1:4200'],
'allowed_origins_patterns' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

Ou middleware personnalisé :
```php
// routes/api.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
```

### 2. API Resources

**Exemple : `app/Http/Resources/ProduitResource.php`**
```php
<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduitResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prix' => $this->prix,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
```

### 3. Validations

**Exemple : `app/Http/Requests/StoreProduitRequest.php`**
```php
<?php
namespace App\Http\Requests;

class StoreProduitRequest extends FormRequest {
    public function authorize() {
        return auth()->check();
    }

    public function rules() {
        return [
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }
}
```

---

## 🔐 Authentification API

### Exemple avec Token (Sanctum)

**Installation :**
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

**Utilisation dans Frontend :**
```typescript
// auth.service.ts
login(email: string, password: string): Observable<any> {
  return this.http.post('/api/login', { email, password });
}

// Enregistrer le token
localStorage.setItem('token', response.token);

// Utiliser dans les requêtes
headers = new HttpHeaders({
  'Authorization': `Bearer ${localStorage.getItem('token')}`
});
```

---

## 📊 Structure des Données

### Produit
```json
{
  "id": 1,
  "nom": "Laptop",
  "prix": 999.99,
  "description": "High-performance laptop",
  "categorie_id": 1,
  "vendeur_id": 1,
  "image": "path/to/image.jpg",
  "created_at": "2026-05-15T10:00:00Z"
}
```

### Utilisateur
```json
{
  "id": 1,
  "nom": "Jean Dupont",
  "email": "jean@example.com",
  "role": "vendeur|visiteur|administrateur",
  "created_at": "2026-05-15T10:00:00Z"
}
```

### Vendeur
```json
{
  "id": 1,
  "user_id": 1,
  "boutique_nom": "Ma Boutique",
  "description": "Description de la boutique",
  "rating": 4.5,
  "status": "actif|suspendu|validé_en_attente"
}
```

---

## 🧪 Test de Communication

### 1. Avec Postman

**GET `/api/produits`**
```
URL: http://localhost:8000/api/produits
Method: GET
Headers: Accept: application/json
Response:
{
  "data": [
    { "id": 1, "nom": "Laptop", "prix": 999.99 },
    { "id": 2, "nom": "Phone", "prix": 599.99 }
  ]
}
```

### 2. Avec cURL
```bash
# Lister les produits
curl -H "Accept: application/json" http://localhost:8000/api/produits

# Créer un produit
curl -X POST http://localhost:8000/api/produits \
  -H "Content-Type: application/json" \
  -d '{"nom":"Laptop","prix":999.99}'
```

### 3. Console Browser

```javascript
// Dans la console Chrome
fetch('http://localhost:8000/api/produits')
  .then(r => r.json())
  .then(data => console.log(data));
```

---

## 🚀 Déploiement

### Frontend Build
```bash
ng build --prod
# Les fichiers sont dans dist/jaayal
```

### Backend Deployment
```bash
# Préparer l'environnement
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations
php artisan migrate --force
```

---

## 📞 Dépannage Courant

### 1. Erreur CORS
```
Error: Access to XMLHttpRequest at 'http://localhost:8000/api/produits'
from origin 'http://localhost:4200' has been blocked by CORS policy
```
**Solution** : Ajouter les headers CORS dans Laravel

### 2. 401 Unauthorized
```
Error: { "message": "Unauthenticated." }
```
**Solution** : Vérifier le token d'authentification

### 3. 404 Not Found
```
Error: The requested resource was not found
```
**Solution** : Vérifier la route Laravel et l'URL du service

### 4. Timeout
```
Error: Network timeout
```
**Solution** : Ajouter un timeout plus long
```typescript
timeout(5000)  // 5 secondes
```

---

## 📚 Ressources

- [Laravel API Documentation](https://laravel.com/docs/api-resources)
- [Angular HttpClient](https://angular.io/guide/http)
- [CORS Guide](https://enable-cors.org/)
- [RESTful API Best Practices](https://restfulapi.net/)

---

**Dernière mise à jour** : 15 mai 2026  
**Version** : 1.0 - Frontend Backend Integration
