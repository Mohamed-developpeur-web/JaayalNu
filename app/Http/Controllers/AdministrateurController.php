<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    /**
     * Retourne tous les profils administrateur.
     */
    public function index()
    {
        return response()->json(Administrateur::all());
    }

    /**
     * Crée un nouveau profil administrateur après validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $administrateur = Administrateur::create($validated);

        return response()->json($administrateur, 201);
    }

    /**
     * Retourne les détails d'un profil administrateur.
     */
    public function show(Administrateur $administrateur)
    {
        return response()->json($administrateur);
    }

    /**
     * Met à jour un profil administrateur existant.
     */
    public function update(Request $request, Administrateur $administrateur)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $administrateur->update($validated);

        return response()->json($administrateur);
    }

    /**
     * Supprime un profil administrateur.
     */
    public function destroy(Administrateur $administrateur)
    {
        $administrateur->delete();

        return response()->json(null, 204);
    }
}
