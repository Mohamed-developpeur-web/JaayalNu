<?php

/* Seeder métier pour créer les entités principales de la marketplace et leurs relations. */
namespace Database\Seeders;

use App\Models\AbonnementPremium;
use App\Models\Administrateur;
use App\Models\Categorie;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Produit;
use App\Models\User;
use App\Models\Vendeur;
use App\Models\Visiteur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Crée des données métier représentatives pour catégories, vendeurs, visiteurs,
     * abonnements premium, produits, messages et notifications.
     */
    public function run(): void
    {
        // Création de catégories de produits.
        $categorieElectromenager = Categorie::create(['nom' => 'Électroménager']);
        $categorieMode = Categorie::create(['nom' => 'Mode']);

        // Utilisateurs de base.
        $adminUser = User::factory()->create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'role' => 'administrateur',
        ]);

        $vendeurUser = User::factory()->create([
            'name' => 'Vendeur Exemple',
            'email' => 'vendeur@example.com',
            'role' => 'vendeur',
        ]);

        $visiteurUser = User::factory()->create([
            'name' => 'Visiteur Exemple',
            'email' => 'visiteur@example.com',
            'role' => 'visiteur',
        ]);

        Administrateur::create(['user_id' => $adminUser->id]);

        $vendeur = Vendeur::create([
            'user_id' => $vendeurUser->id,
            'status_compte' => 'actif',
            'est_premium' => true,
        ]);

        Visiteur::create(['user_id' => $visiteurUser->id]);

        AbonnementPremium::create([
            'vendeur_id' => $vendeur->id,
            'date_debut' => now(),
            'date_fin' => now()->addMonth(),
            'est_actif' => true,
        ]);

        Produit::create([
            'vendeur_id' => $vendeur->id,
            'categorie_id' => $categorieElectromenager->id,
            'nom' => 'Machine à café premium',
            'description' => 'Machine à café automatique avec options avancées.',
            'prix' => 249.99,
            'stock' => 12,
            'date_ajout' => now(),
        ]);

        Message::create([
            'sender_id' => $visiteurUser->id,
            'receiver_id' => $vendeurUser->id,
            'contenu' => 'Bonjour, je voudrais en savoir plus sur votre produit.',
            'date_envoi' => now(),
            'lu' => false,
        ]);

        Notification::create([
            'user_id' => $vendeurUser->id,
            'type' => 'message',
            'contenu' => 'Vous avez reçu un nouveau message d’un visiteur.',
            'date_creation' => now(),
            'vue' => false,
        ]);
    }
}

