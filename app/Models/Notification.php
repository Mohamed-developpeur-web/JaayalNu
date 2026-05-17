<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'contenu',
        'date_creation',
        'vue',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'vue' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
