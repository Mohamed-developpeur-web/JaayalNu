<?php

/* Commentaire en français : Définition des routes HTTP de l'application. */
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Définition d une commande Artisan exécutable en ligne de commande


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


