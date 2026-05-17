<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendeur_id',
        'categorie_id',
        'nom',
        'description',
        'prix',
        'stock',
        'date_ajout',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'date_ajout' => 'datetime',
    ];

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
