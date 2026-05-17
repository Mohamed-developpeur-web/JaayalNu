# 📍 Guide de Navigation - Jaayal Marketplace

## Vue d'ensemble de l'architecture

L'application Jaayal utilise une architecture d'**application une seule page (SPA)** avec Angular 16+ en tant que frontend et Laravel comme backend API. Les routes sont organisées en trois modules principaux : **Public**, **Vendeur** et **Admin**.

---

## 🏠 Routes Principales

### Route Racine
```
/               → Dashboard (Vue d'ensemble générale)
```

---

## 🌐 Module Public (Vitrine Numérique)

Le module public permet aux visiteurs et aux utilisateurs non connectés de naviguer et consulter la plateforme.

| Chemin | Composant | Description |
|--------|-----------|-------------|
| `/public` | Accueil | Page d'accueil de la vitrine |
| `/public/produits` | ListeProduits | Catalogue de tous les produits |
| `/public/produits/:id` | DetailsProduits | Détails d'un produit spécifique |
| `/public/vendeur/:id` | ProfilVendeur | Profil et boutique d'un vendeur |
| `/public/inscription` | Inscription | Formulaire d'inscription |
| `/public/connexion` | Connexion | Formulaire de connexion |

### Exemple de navigation :
```
1. Visiteur accède à /public/produits
2. Clique sur un produit → /public/produits/123
3. Clique sur le vendeur → /public/vendeur/456
```

---

## 🏢 Module Vendeur (Espace Vendeur)

Espace réservé aux vendeurs pour gérer leurs boutiques et leurs produits.

| Chemin | Composant | Description |
|--------|-----------|-------------|
| `/vendeur` | Dashboard | Tableau de bord du vendeur |
| `/vendeur/dashboard` | Dashboard | Dashboard (alias) |
| `/vendeur/mes-produits` | MesProduits | Liste des produits du vendeur |
| `/vendeur/ajouter-produit` | AjouterProduit | Formulaire d'ajout de produit |
| `/vendeur/modifier-produit/:id` | ModifierProduit | Formulaire de modification d'un produit |
| `/vendeur/messages` | Messages | Messages reçus des clients |
| `/vendeur/statistiques` | Statistiques | Statistiques de vente et d'activité |
| `/vendeur/modifier-profil` | ModifierProfil | Modification du profil vendeur |

### Flux d'utilisation type :
```
1. Vendeur se connecte → /public/connexion
2. Accède à son espace → /vendeur
3. Ajoute un produit → /vendeur/ajouter-produit
4. Voit ses produits → /vendeur/mes-produits
5. Vérifie les stats → /vendeur/statistiques
6. Répond aux messages → /vendeur/messages
```

---

## ⚙️ Module Admin (Administration)

Espace d'administration pour les administrateurs système avec gestion complète de la plateforme.

| Chemin | Composant | Description |
|--------|-----------|-------------|
| `/admin` | Dashboard | Dashboard administrateur |
| `/admin/dashboard` | Dashboard | Dashboard (alias) |
| `/admin/utilisateurs` | Utilisateurs | Gestion de tous les utilisateurs |
| `/admin/produits` | Produits | Gestion de tous les produits |
| `/admin/categories` | Categories | Gestion des catégories |
| `/admin/abonnements` | Abonnements | Gestion des abonnements premium |
| `/admin/validation-vendeur` | ValidationVendeur | Validation des nouveaux vendeurs |
| `/admin/statistiques` | Statistiques | Statistiques globales de la plateforme |

### Flux d'utilisation type :
```
1. Admin se connecte → /public/connexion
2. Accède au dashboard → /admin
3. Gère les produits → /admin/produits
4. Valide les vendeurs → /admin/validation-vendeur
5. Consulte les stats → /admin/statistiques
```

---

## 🎯 Hiérarchie des Routes

```
/ (racine)
├── public (Module public)
│   ├── / (Accueil)
│   ├── produits (ListeProduits)
│   ├── produits/:id (DetailsProduits)
│   ├── vendeur/:id (ProfilVendeur)
│   ├── inscription (Inscription)
│   └── connexion (Connexion)
│
├── vendeur (Module vendeur)
│   ├── / (Dashboard)
│   ├── dashboard (Dashboard - alias)
│   ├── mes-produits (MesProduits)
│   ├── ajouter-produit (AjouterProduit)
│   ├── modifier-produit/:id (ModifierProduit)
│   ├── messages (Messages)
│   ├── statistiques (Statistiques)
│   └── modifier-profil (ModifierProfil)
│
└── admin (Module admin)
    ├── / (Dashboard)
    ├── dashboard (Dashboard - alias)
    ├── utilisateurs (Utilisateurs)
    ├── produits (Produits)
    ├── categories (Categories)
    ├── abonnements (Abonnements)
    ├── validation-vendeur (ValidationVendeur)
    └── statistiques (Statistiques)
```

---

## 📱 Menu de Navigation

Le menu latéral (`app.html`) contient tous les liens de navigation organisés par sections :

### Sections du Menu
1. **ACCUEIL** - Vue d'ensemble générale
2. **VITRINE PUBLIQUE** - Navigation publique
3. **ESPACE VENDEUR** - Fonctionnalités vendeur
4. **ADMINISTRATION** - Fonctionnalités admin

### Styles d'État des Liens
- **Normal** : Couleur grise
- **Hover** : Fond gris foncé, couleur plus claire
- **Actif** (routerLinkActive) : Fond bleu, couleur blanche

---

## 🔗 Intégration Backend (Laravel)

Les routes Angular communiquent avec le backend Laravel via l'API REST :

### Endpoints API disponibles
- `/api/produits` - Gestion des produits
- `/api/categories` - Gestion des catégories
- `/api/utilisateurs` - Gestion des utilisateurs
- `/api/vendeurs` - Gestion des vendeurs
- `/api/abonnements-premium` - Gestion des abonnements
- `/api/messages` - Gestion des messages
- `/api/notifications` - Gestion des notifications
- `/api/administrateurs` - Gestion des administrateurs

### Routes Web Laravel
- `/` - Accueil (vue welcome.blade.php)
- `/users`, `/produits`, `/categories`, etc. - Routes CRUD

---

## 🎨 Composants Utilisés

### Page d'Accueil
- `DashboardComponent` - Vue d'ensemble générale

### Module Public
- `Accueil` - Page d'accueil
- `ListeProduits` - Affichage des produits
- `DetailsProduits` - Détails d'un produit
- `ProfilVendeur` - Profil du vendeur
- `Inscription` - Formulaire d'inscription
- `Connexion` - Formulaire de connexion

### Module Vendeur
- `Dashboard` - Tableau de bord
- `MesProduits` - Liste des produits
- `AjouterProduit` - Formulaire d'ajout
- `ModifierProduit` - Formulaire de modification
- `Messages` - Messagerie
- `Statistiques` - Statistiques
- `ModifierProfil` - Profil

### Module Admin
- `Dashboard` - Tableau de bord
- `Utilisateurs` - Gestion des utilisateurs
- `Produits` - Gestion des produits
- `Categories` - Gestion des catégories
- `Abonnements` - Gestion des abonnements
- `ValidationVendeur` - Validation des vendeurs
- `Statistiques` - Statistiques globales

---

## 🚀 Points de Redirection par Défaut

```typescript
// Redirection pour les routes non trouvées
path: '**', redirectTo: ''    // Vers le dashboard principal
```

---

## 📋 Fichiers de Configuration

### Fichiers clés
- `app.routes.ts` - Routes principales (lazy loading)
- `public/public-routing.module.ts` - Routes du module public
- `vendeur/vendeur-routing.module.ts` - Routes du module vendeur
- `admin/admin-routing.module.ts` - Routes du module admin
- `app.html` - Template avec menu latéral
- `app.css` - Styles du menu et de la navigation

---

## 🎯 Prochaines Étapes

1. ✅ Routes configurées et fonctionnelles
2. ✅ Menu de navigation complet
3. ✅ Tous les composants déclarés
4. ⏳ Ajouter l'authentification/guards
5. ⏳ Ajouter les services pour les appels API
6. ⏳ Tester la navigation complète

---

**Dernière mise à jour** : 15 mai 2026
