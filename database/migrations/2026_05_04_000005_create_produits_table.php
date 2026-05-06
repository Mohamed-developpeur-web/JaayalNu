<?php

/* Migration créant la table des produits proposés par les vendeurs. */
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
        Schema::create('produits', function (Blueprint $table) {
            // Identifiant unique du produit.
            $table->id();

            // Référence vers le vendeur qui propose le produit.
            $table->foreignId('vendeur_id')->constrained('vendeurs')->cascadeOnDelete();

            // Référence vers la catégorie de produit.
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete();

            // Nom du produit.
            $table->string('nom');

            // Description détaillée du produit.
            $table->text('description');

            // Prix unitaire avec deux décimales.
            $table->decimal('prix', 10, 2);

            // Quantité disponible en stock.
            $table->integer('stock')->default(0);

            // Date d'ajout du produit sur la plateforme.
            $table->timestamp('date_ajout')->useCurrent();

            // Dates de création et de mise à jour.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};

