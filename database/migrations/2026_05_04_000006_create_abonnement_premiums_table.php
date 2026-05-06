<?php

/*  Migration créant la table des abonnements premium des vendeurs. */
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
        Schema::create('abonnement_premiums', function (Blueprint $table) {
            // Identifiant unique de l'abonnement premium.
            $table->id();

            // Référence vers le vendeur bénéficiaire de l'abonnement.
            $table->foreignId('vendeur_id')->constrained('vendeurs')->cascadeOnDelete();

            // Plage de validité de l'abonnement premium.
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();

            // Statut actif/inactif de l'abonnement.
            $table->boolean('est_actif')->default(false);

            // Dates de création et de mise à jour.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnement_premiums');
    }
};

