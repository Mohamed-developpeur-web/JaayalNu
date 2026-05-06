<?php

/*  Migration créant la table des catégories de produits. */
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
        Schema::create('categories', function (Blueprint $table) {
            // Identifiant unique de la catégorie.
            $table->id();

            // Nom ou libellé de la catégorie de produits.
            $table->string('nom');

            // Dates de création et de mise à jour.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

