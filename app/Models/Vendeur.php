<?php
namespace App\Models;

/* Commentaire en français : Modèle Eloquent représentant un vendeur sur la marketplace. */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * - user_id : référence vers l'utilisateur associé.
     * - status_compte : état du compte vendeur.
     * - est_premium : indique si le vendeur bénéficie d'un abonnement premium.
     */
    protected $fillable = [
        'user_id',
        'status_compte',
        'est_premium',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP appropriés.
     */
    protected $casts = [
        'est_premium' => 'boolean',
    ];

    /**
     * Relation vers l'utilisateur propriétaire du compte vendeur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Liste des produits proposés par ce vendeur.
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Abonnement premium lié au vendeur.
     * Permet de savoir si le vendeur bénéficie d'options premium.
     */
    public function abonnementPremium()
    {
        return $this->hasOne(AbonnementPremium::class);
    }
}


