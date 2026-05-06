<?php

/*  Migration créant la table des visiteurs. */
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
        Schema::create('visiteurs', function (Blueprint $table) {
            // Identifiant unique du profil visiteur.
            $table->id();

            // Référence vers l'utilisateur associé au profil visiteur.
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();

            // Dates de création et de mise à jour du profil visiteur.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs');
    }
};

