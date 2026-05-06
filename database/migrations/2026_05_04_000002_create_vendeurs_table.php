<?php
/* Migration créant la table des vendeurs. */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendeurs', function (Blueprint $table) {
            // Identifiant unique du profil vendeur.
            $table->id();

            // Référence vers l'utilisateur propriétaire du compte vendeur.
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();

            // Statut fonctionnel du compte vendeur (par exemple actif, suspendu).
            $table->string('status_compte')->default('active');

            // Indique si le vendeur a souscrit à un abonnement premium.
            $table->boolean('est_premium')->default(false);

            // Dates de création et de mise à jour du profil vendeur.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendeurs');
    }
};

