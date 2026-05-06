<?php
namespace App\Models;

/* Commentaire en français : Modèle Eloquent représentant une notification métier pour un utilisateur. */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * - user_id : destinataire de la notification.
     * - type : catégorie de notification (message, commande, etc.).
     * - contenu : texte affiché à l'utilisateur.
     * - date_creation : date de génération de la notification.
     * - vue : indique si la notification a été lue.
     */
    protected $fillable = [
        'user_id',
        'type',
        'contenu',
        'date_creation',
        'vue',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP appropriés.
     */
    protected $casts = [
        'date_creation' => 'datetime',
        'vue' => 'boolean',
    ];

    /**
     * Utilisateur destinataire de la notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


