<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     * Le rôle d'administrateur est géré ici comme un profil lié à un utilisateur.
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Chaque administrateur est un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
