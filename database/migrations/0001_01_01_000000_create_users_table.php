<?php

/* Migration initiale créant les tables users, password_reset_tokens et sessions. */
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
        Schema::create('users', function (Blueprint $table) {
            // Identifiant unique de l'utilisateur.
            $table->id();

            // Nom complet de l'utilisateur.
            $table->string('name');

            // Adresse email unique utilisée pour l'authentification.
            $table->string('email')->unique();

            // Date de vérification de l'email si l'utilisateur a confirmé son compte.
            $table->timestamp('email_verified_at')->nullable();

            // Mot de passe chiffré.
            $table->string('password');

            // Jeton de session pour le "remember me".
            $table->rememberToken();

            // Dates de création et de mise à jour automatique.
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            // L'email associé au jeton sert de clé primaire.
            $table->string('email')->primary();

            // Jeton de réinitialisation de mot de passe.
            $table->string('token');

            // Date de création du jeton.
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            // Identifiant unique de la session.
            $table->string('id')->primary();

            // Référence vers l'utilisateur connecté, facultative.
            $table->foreignId('user_id')->nullable()->index();

            // Adresse IP de la session.
            $table->string('ip_address', 45)->nullable();

            // Informations du navigateur ou de l'agent utilisateur.
            $table->text('user_agent')->nullable();

            // Données de session sérialisées.
            $table->longText('payload');

            // Timestamp de la dernière activité pour la gestion de la session.
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

