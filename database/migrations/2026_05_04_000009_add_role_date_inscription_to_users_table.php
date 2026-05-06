<?php

/* Migration ajoutant les colonnes de rôle et de date d'inscription aux utilisateurs. */
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
        Schema::table('users', function (Blueprint $table) {
            // Rôle fonctionnel de l'utilisateur dans l'application.
            $table->string('role')->default('visiteur')->after('email');

            // Date d'inscription initiale du compte utilisateur.
            $table->timestamp('date_inscription')->useCurrent()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'date_inscription']);
        });
    }
};

