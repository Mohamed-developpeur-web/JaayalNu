<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    /**
     * Retourne tous les vendeurs.
     */
    public function index()
    {
        return response()->json(Vendeur::all());
    }

    /**
     * Crée un vendeur valide.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status_compte' => ['required', 'string', 'max:100'],
            'est_premium' => ['required', 'boolean'],
        ]);

        $vendeur = Vendeur::create($validated);

        return response()->json($vendeur, 201);
    }

    /**
     * Affiche les informations d'un vendeur.
     */
    public function show(Vendeur $vendeur)
    {
        return response()->json($vendeur);
    }

    /**
     * Met à jour un vendeur existant.
     */
    public function update(Request $request, Vendeur $vendeur)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status_compte' => ['required', 'string', 'max:100'],
            'est_premium' => ['required', 'boolean'],
        ]);

        $vendeur->update($validated);

        return response()->json($vendeur);
    }

    /**
     * Supprime un vendeur.
     */
    public function destroy(Vendeur $vendeur)
    {
        $vendeur->delete();

        return response()->json(null, 204);
    }
}
