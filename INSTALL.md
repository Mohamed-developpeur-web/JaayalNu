# Guide d'Installation - Projet JaayalNu

## Prérequis
- PHP 8.1 ou supérieur
- MySQL 5.7 ou MariaDB
- Composer
- Node.js et npm (optionnel, pour Vite)

## Installation locale

### 1. Cloner le repository
```bash
git clone https://github.com/Mohamed-developpeur-web/JaayalNu.git
cd JaayalNu
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Copier le fichier .env
```bash
copy .env.example .env
```
*(Sur Linux/Mac : `cp .env.example .env`)*

### 4. Générer la clé d'application
```bash
php artisan key:generate
```

### 5. Configurer la base de données
Éditer le fichier `.env` et remplir les variables :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jaayal_db
DB_USERNAME=root
DB_PASSWORD=votreMotDePasse
```

### 6. Créer la base de données
```bash
mysql -u root -p
CREATE DATABASE jaayal_db;
EXIT;
```

### 7. Exécuter les migrations
```bash
php artisan migrate
```

### 8. Remplir la base de données (optionnel)
```bash
php artisan db:seed
```

### 9. Installer les dépendances Node (optionnel)
```bash
npm install
npm run dev
```

### 10. Lancer le serveur Laravel
```bash
php artisan serve
```

L'application sera accessible sur : **http://localhost:8000**

---

## Variables d'environnement importantes
- `APP_KEY` : Clé secrète (générée automatiquement)
- `APP_DEBUG` : Mettre à `false` en production
- `APP_ENV` : `local`, `testing`, ou `production`
- `DB_DATABASE` : Nom de la base de données
- `DB_USERNAME` : Utilisateur MySQL
- `DB_PASSWORD` : Mot de passe MySQL

---

## Workflow collaboratif

### Pour ajouter une feature
```bash
git checkout -b feature/ma-fonctionnalite
# ... faire les modifications ...
git add .
git commit -m "Descriptif de la modification"
git push origin feature/ma-fonctionnalite
```

### Pour synchroniser avec main
```bash
git pull origin main
```

### Créer une Pull Request
1. Aller sur GitHub
2. Cliquer sur "New Pull Request"
3. Sélectionner la branche de feature
4. Ajouter une description
5. Soumettre pour review

---

## ⚠️ Sécurité
- **Ne jamais commiter `.env`** (il est dans `.gitignore`)
- Les données sensibles restent locales
- Chaque développeur a son propre `.env`

---

## Troubleshooting

### "Database connection refused"
- Vérifier que MySQL est lancé
- Vérifier les credentials dans `.env`

### "No application encryption key has been specified"
- Lancer : `php artisan key:generate`

### "Class not found"
- Lancer : `composer dump-autoload`

---

## Support
Pour toute question, contacte l'équipe de développement.
