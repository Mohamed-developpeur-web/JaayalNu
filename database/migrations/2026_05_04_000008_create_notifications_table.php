<?php

/* Migration créant la table des notifications utilisateurs. */
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
        Schema::create('notifications', function (Blueprint $table) {
            // Identifiant unique de la notification.
            $table->id();

            // Destinataire de la notification.
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Type de notification (par exemple message, alerte, mise à jour).
            $table->string('type');

            // Contenu textuel de la notification.
            $table->text('contenu');

            // Date et heure de création de la notification.
            $table->timestamp('date_creation')->useCurrent();

            // Indicateur de notification lue ou non.
            $table->boolean('vue')->default(false);

            // Dates de création et de mise à jour.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

