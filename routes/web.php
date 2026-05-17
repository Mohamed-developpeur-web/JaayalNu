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
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

// Groupe de routes API pour que le frontend Angular puisse appeler /api/produits, /api/categories, etc.
// Ces routes renvoient du JSON quand Angular en fait la requête.
Route::prefix('api')->as('api.')->withoutMiddleware(VerifyCsrfToken::class)->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('me', [UserController::class, 'me']);

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
});


