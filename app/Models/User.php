<?php
namespace App\Models;

/* Commentaire en français : Modèle Eloquent représentant un utilisateur du système. */

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Utilisateur authentifié de l'application.
     * Il peut être lié à un profil administrateur, vendeur ou visiteur.
     */

    /**
     * Attributs qui peuvent être remplis en masse.
     * - name : nom affiché de l'utilisateur.
     * - email : adresse email unique.
     * - password : mot de passe haché.
     * - role : rôle fonctionnel dans l'application.
     * - date_inscription : date d'inscription du compte.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'date_inscription',
    ];

    /**
     * Attributs sensibles qui ne doivent pas être exposés dans les tableaux ou JSON.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversions automatiques des attributs vers des types PHP sécurisés.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_inscription' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Profil administrateur associé à cet utilisateur.
     */
    public function administrateur()
    {
        return $this->hasOne(Administrateur::class);
    }

    /**
     * Profil vendeur associé à cet utilisateur.
     */
    public function vendeur()
    {
        return $this->hasOne(Vendeur::class);
    }

    /**
     * Profil visiteur associé à cet utilisateur.
     */
    public function visiteur()
    {
        return $this->hasOne(Visiteur::class);
    }

    /**
     * Messages envoyés par cet utilisateur.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Messages reçus par cet utilisateur.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Notifications métier associées à cet utilisateur.
     * Le nom est volontairement différent du trait Notifiable de Laravel.
     */
    public function customNotifications()
    {
        return $this->hasMany(Notification::class);
    }
}


