<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    /**
     * Retourne tous les profils administrateur.
     */
    public function index(Request $request)
    {
        $administrateurs = Administrateur::with('user')->get();

        if ($request->wantsJson()) {
            return response()->json($administrateurs);
        }

        return view('administrateurs.index', compact('administrateurs'));
    }

    /**
     * Affiche le formulaire de création d'un administrateur.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('administrateurs.create', compact('users'));
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

        if ($request->wantsJson()) {
            return response()->json($administrateur, 201);
        }

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur créé avec succès.');
    }

    /**
     * Retourne les détails d'un profil administrateur.
     */
    public function show(Request $request, Administrateur $administrateur)
    {
        $administrateur->load('user');

        if ($request->wantsJson()) {
            return response()->json($administrateur);
        }

        return view('administrateurs.show', compact('administrateur'));
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

        if ($request->wantsJson()) {
            return response()->json($administrateur);
        }

        return redirect()->route('administrateurs.show', $administrateur)->with('success', 'Administrateur mis à jour.');
    }

    /**
     * Affiche le formulaire d'édition d'un administrateur.
     */
    public function edit(Administrateur $administrateur)
    {
        $users = User::orderBy('name')->get();

        return view('administrateurs.edit', compact('administrateur', 'users'));
    }

    /**
     * Supprime un profil administrateur.
     */
    public function destroy(Request $request, Administrateur $administrateur)
    {
        $administrateur->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur supprimé.');
    }
}
