<?php

/* Commentaire en français : Modèle Eloquent représentant un visiteur simple de la marketplace. */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * Le visiteur est un profil lié à un utilisateur sans rôle vendeur ou admin.
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Relation vers l'utilisateur associé au profil visiteur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


