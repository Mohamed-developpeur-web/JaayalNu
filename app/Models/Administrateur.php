<?php

/* Commentaire en français : Modèle Eloquent représentant le profil administrateur d'un utilisateur. */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * Ce profil est lié directement à un enregistrement dans la table users.
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Relation vers l'utilisateur qui possède ce profil d'administrateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


