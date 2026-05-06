<?php

namespace App\Http\Controllers;

use App\Models\AbonnementPremium;
use Illuminate\Http\Request;

class AbonnementPremiumController extends Controller
{
    /**
     * Retourne tous les abonnements premium.
     */
    public function index()
    {
        return response()->json(AbonnementPremium::all());
    }

    /**
     * Crée un nouvel abonnement premium avec validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendeur_id' => ['required', 'integer', 'exists:vendeurs,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'est_actif' => ['required', 'boolean'],
        ]);

        $abonnement = AbonnementPremium::create($validated);

        return response()->json($abonnement, 201);
    }

    /**
     * Retourne le détail d'un abonnement premium.
     */
    public function show(AbonnementPremium $abonnementPremium)
    {
        return response()->json($abonnementPremium);
    }

    /**
     * Met à jour un abonnement premium existant.
     */
    public function update(Request $request, AbonnementPremium $abonnementPremium)
    {
        $validated = $request->validate([
            'vendeur_id' => ['required', 'integer', 'exists:vendeurs,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'est_actif' => ['required', 'boolean'],
        ]);

        $abonnementPremium->update($validated);

        return response()->json($abonnementPremium);
    }

    /**
     * Supprime un abonnement premium.
     */
    public function destroy(AbonnementPremium $abonnementPremium)
    {
        $abonnementPremium->delete();

        return response()->json(null, 204);
    }
}
