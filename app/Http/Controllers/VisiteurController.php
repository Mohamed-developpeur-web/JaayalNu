<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    /**
     * Retourne tous les profils visiteur.
     */
    public function index()
    {
        return response()->json(Visiteur::all());
    }

    /**
     * Crée un profil visiteur après validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $visiteur = Visiteur::create($validated);

        return response()->json($visiteur, 201);
    }

    /**
     * Affiche les détails d'un visiteur.
     */
    public function show(Visiteur $visiteur)
    {
        return response()->json($visiteur);
    }

    /**
     * Met à jour un profil visiteur existant.
     */
    public function update(Request $request, Visiteur $visiteur)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $visiteur->update($validated);

        return response()->json($visiteur);
    }

    /**
     * Supprime un profil visiteur.
     */
    public function destroy(Visiteur $visiteur)
    {
        $visiteur->delete();

        return response()->json(null, 204);
    }
}
