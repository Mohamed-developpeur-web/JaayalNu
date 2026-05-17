<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    /**
     * Retourne tous les profils visiteur.
     */
    public function index(Request $request)
    {
        $visiteurs = Visiteur::with('user')->get();

        if ($request->wantsJson()) {
            return response()->json($visiteurs);
        }

        return view('visiteurs.index', compact('visiteurs'));
    }

    /**
     * Affiche le formulaire de création d'un visiteur.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('visiteurs.create', compact('users'));
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

        if ($request->wantsJson()) {
            return response()->json($visiteur, 201);
        }

        return redirect()->route('visiteurs.index')->with('success', 'Visiteur créé avec succès.');
    }

    /**
     * Affiche les détails d'un visiteur.
     */
    public function show(Request $request, Visiteur $visiteur)
    {
        $visiteur->load('user');

        if ($request->wantsJson()) {
            return response()->json($visiteur);
        }

        return view('visiteurs.show', compact('visiteur'));
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

        if ($request->wantsJson()) {
            return response()->json($visiteur);
        }

        return redirect()->route('visiteurs.show', $visiteur)->with('success', 'Visiteur mis à jour.');
    }

    /**
     * Affiche le formulaire d'édition d'un visiteur.
     */
    public function edit(Visiteur $visiteur)
    {
        $users = User::orderBy('name')->get();

        return view('visiteurs.edit', compact('visiteur', 'users'));
    }

    /**
     * Supprime un profil visiteur.
     */
    public function destroy(Request $request, Visiteur $visiteur)
    {
        $visiteur->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('visiteurs.index')->with('success', 'Visiteur supprimé.');
    }
}
