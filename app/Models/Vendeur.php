<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_compte',
        'est_premium',
    ];

    protected $casts = [
        'est_premium' => 'boolean',
    ];

    /**
     * Le vendeur est lié à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un vendeur possède plusieurs produits.
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Un vendeur peut avoir un abonnement premium actif.
     */
    public function abonnementPremium()
    {
        return $this->hasOne(AbonnementPremium::class);
    }
}
