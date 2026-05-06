<?php

/* Commentaire en français : Définition des routes HTTP de l'application. */
use App\Http\Controllers\AbonnementPremiumController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\VisiteurController;
use Illuminate\Support\Facades\Route;

// Route HTTP GET définie pour la page d'accueil
Route::get('/', function () {
    // Retourne la vue principale welcome
    return view('welcome');
});

Route::resources([
    'users' => UserController::class,
    'produits' => ProduitController::class,
    'categories' => CategorieController::class,
    'administrateurs' => AdministrateurController::class,
    'vendeurs' => VendeurController::class,
    'visiteurs' => VisiteurController::class,
    'abonnements-premium' => AbonnementPremiumController::class,
    'messages' => MessageController::class,
    'notifications' => NotificationController::class,
]);


