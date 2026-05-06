<?php

/* Migration créant la table des messages privés entre utilisateurs. */
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
        Schema::create('messages', function (Blueprint $table) {
            // Identifiant unique du message.
            $table->id();

            // Expéditeur du message.
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();

            // Destinataire du message.
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();

            // Contenu textuel du message.
            $table->text('contenu');

            // Date et heure d'envoi, initialisée à maintenant.
            $table->timestamp('date_envoi')->useCurrent();

            // Indicateur de lecture du message.
            $table->boolean('lu')->default(false);

            // Dates de création et de mise à jour.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

