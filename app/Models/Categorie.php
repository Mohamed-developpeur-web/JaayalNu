<?php

/* Commentaire en français : Modèle Eloquent représentant une catégorie de produits. */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * Le champ nom contient le libellé de la catégorie.
     */
    protected $fillable = [
        'nom',
    ];

    /**
     * Produits associés à cette catégorie.
     * Une catégorie peut contenir plusieurs produits.
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}


