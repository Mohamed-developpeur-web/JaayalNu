<?php
namespace App\Models;

/* Commentaire en français : Modèle Eloquent représentant un message privé échangé entre utilisateurs. */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être remplis en masse.
     * - sender_id : expéditeur du message.
     * - receiver_id : destinataire du message.
     * - contenu : texte du message.
     * - date_envoi : date et heure d'envoi.
     * - lu : indique si le message a été lu.
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'contenu',
        'date_envoi',
        'lu',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP appropriés.
     */
    protected $casts = [
        'date_envoi' => 'datetime',
        'lu' => 'boolean',
    ];

    /**
     * Utilisateur qui envoie le message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Utilisateur qui reçoit le message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}


