<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    /**
     * Retourne tous les vendeurs.
     */
    public function index(Request $request)
    {
        $vendeurs = Vendeur::with('user')->get();

        if ($request->wantsJson()) {
            return response()->json($vendeurs);
        }

        return view('vendeurs.index', compact('vendeurs'));
    }

    /**
     * Affiche le formulaire de création d'un vendeur.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('vendeurs.create', compact('users'));
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

        if ($request->wantsJson()) {
            return response()->json($vendeur, 201);
        }

        return redirect()->route('vendeurs.index')->with('success', 'Vendeur créé avec succès.');
    }

    /**
     * Affiche les informations d'un vendeur.
     */
    public function show(Request $request, Vendeur $vendeur)
    {
        $vendeur->load('user');

        if ($request->wantsJson()) {
            return response()->json($vendeur);
        }

        return view('vendeurs.show', compact('vendeur'));
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

        if ($request->wantsJson()) {
            return response()->json($vendeur);
        }

        return redirect()->route('vendeurs.show', $vendeur)->with('success', 'Vendeur mis à jour.');
    }

    /**
     * Affiche le formulaire d'édition d'un vendeur.
     */
    public function edit(Vendeur $vendeur)
    {
        $users = User::orderBy('name')->get();

        return view('vendeurs.edit', compact('vendeur', 'users'));
    }

    /**
     * Supprime un vendeur.
     */
    public function destroy(Request $request, Vendeur $vendeur)
    {
        $vendeur->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('vendeurs.index')->with('success', 'Vendeur supprimé.');
    }
}
