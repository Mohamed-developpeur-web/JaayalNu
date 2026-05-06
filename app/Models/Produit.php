<?php

/* Commentaire en français : Modèle Eloquent représentant un produit vendu sur la marketplace. */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * - vendeur_id : référence vers le vendeur qui propose le produit.
     * - categorie_id : catégorie à laquelle appartient le produit.
     * - nom : nom du produit.
     * - description : description détaillée du produit.
     * - prix : prix de vente unitaire avec 2 décimales.
     * - stock : quantité disponible à la vente.
     * - date_ajout : date d'ajout du produit sur la plateforme.
     */
    protected $fillable = [
        'vendeur_id',
        'categorie_id',
        'nom',
        'description',
        'prix',
        'stock',
        'date_ajout',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP appropriés.
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'date_ajout' => 'datetime',
    ];

    /**
     * Vendeur qui propose ce produit.
     */
    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class);
    }

    /**
     * Catégorie à laquelle ce produit appartient.
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}


