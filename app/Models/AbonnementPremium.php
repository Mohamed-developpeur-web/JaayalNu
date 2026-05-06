<?php

/* Commentaire en français : Modèle Eloquent représentant la période d'abonnement premium d'un vendeur. */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonnementPremium extends Model
{
    use HasFactory;

    protected $table = 'abonnement_premiums';

    /**
     * Attributs qui peuvent être remplis en masse.
     * - vendeur_id : référence vers le compte vendeur lié.
     * - date_debut : début de validité de l'abonnement premium.
     * - date_fin : fin de validité de l'abonnement premium.
     * - est_actif : indique si l'abonnement est actuellement actif.
     */
    protected $fillable = [
        'vendeur_id',
        'date_debut',
        'date_fin',
        'est_actif',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP appropriés.
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'est_actif' => 'boolean',
    ];

    /**
     * Relation vers le vendeur possédant cet abonnement premium.
     */
    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class);
    }
}


