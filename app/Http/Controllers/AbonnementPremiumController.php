<?php

namespace App\Http\Controllers;

use App\Models\AbonnementPremium;
use App\Models\Vendeur;
use Illuminate\Http\Request;

class AbonnementPremiumController extends Controller
{
    /**
     * Retourne tous les abonnements premium.
     */
    public function index(Request $request)
    {
        $abonnements = AbonnementPremium::with('vendeur')->get();

        if ($request->wantsJson()) {
            return response()->json($abonnements);
        }

        return view('abonnements-premium.index', compact('abonnements'));
    }

    /**
     * Affiche le formulaire de création d'un abonnement premium.
     */
    public function create()
    {
        $vendeurs = Vendeur::orderBy('id')->get();

        return view('abonnements-premium.create', compact('vendeurs'));
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

        if ($request->wantsJson()) {
            return response()->json($abonnement, 201);
        }

        return redirect()->route('abonnements-premium.index')->with('success', 'Abonnement premium créé avec succès.');
    }

    /**
     * Retourne le détail d'un abonnement premium.
     */
    public function show(Request $request, AbonnementPremium $abonnementPremium)
    {
        $abonnementPremium->load('vendeur');

        if ($request->wantsJson()) {
            return response()->json($abonnementPremium);
        }

        return view('abonnements-premium.show', compact('abonnementPremium'));
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

        if ($request->wantsJson()) {
            return response()->json($abonnementPremium);
        }

        return redirect()->route('abonnements-premium.show', $abonnementPremium)->with('success', 'Abonnement premium mis à jour.');
    }

    /**
     * Affiche le formulaire d'édition d'un abonnement premium.
     */
    public function edit(AbonnementPremium $abonnementPremium)
    {
        $vendeurs = Vendeur::orderBy('id')->get();

        return view('abonnements-premium.edit', compact('abonnementPremium', 'vendeurs'));
    }

    /**
     * Supprime un abonnement premium.
     */
    public function destroy(Request $request, AbonnementPremium $abonnementPremium)
    {
        $abonnementPremium->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('abonnements-premium.index')->with('success', 'Abonnement premium supprimé.');
    }
}
