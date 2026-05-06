<?php

/*  Seeder métier initialisant les utilisateurs et les données de base de la marketplace. */
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Remplit la base de données avec les données de démarrage nécessaires
     * pour l'administration, les vendeurs et les visiteurs de la marketplace.
     */
    public function run(): void
    {
        // Crée l'utilisateur de base requis pour l'administration et les tests initiaux.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Optionnel : exécuter un seeder métier pour remplir les tables du diagramme.
        if (class_exists(MarketplaceSeeder::class)) {
            $this->call(MarketplaceSeeder::class);
        }
    }
}

