<?php

namespace App\Models;

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
     * Les attributs assignables en masse.
     * Le champ `name` représente le nom de l'utilisateur.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'date_inscription',
        'api_token',
    ];

    /**
     * Les attributs qui ne doivent pas être exposés.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * Les casts de colonnes pour obtenir les bons types PHP.
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
     * Profil administrateur lié à cet utilisateur.
     */
    public function administrateur()
    {
        return $this->hasOne(Administrateur::class);
    }

    /**
     * Profil vendeur lié à cet utilisateur.
     */
    public function vendeur()
    {
        return $this->hasOne(Vendeur::class);
    }

    /**
     * Profil visiteur lié à cet utilisateur.
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
     * Notifications métier liées à cet utilisateur.
     *
     * Attention : nous conservons le trait Notifiable de Laravel,
     * donc cette relation utilise un nom différent.
     */
    public function customNotifications()
    {
        return $this->hasMany(Notification::class);
    }
}
