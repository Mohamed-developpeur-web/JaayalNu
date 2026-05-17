<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonnementPremium extends Model
{
    use HasFactory;

    protected $table = 'abonnement_premiums';

    protected $fillable = [
        'vendeur_id',
        'date_debut',
        'date_fin',
        'est_actif',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'est_actif' => 'boolean',
    ];

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class);
    }
}
