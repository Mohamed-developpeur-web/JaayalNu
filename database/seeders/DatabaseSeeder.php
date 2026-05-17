<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the base user required by l'application.
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
