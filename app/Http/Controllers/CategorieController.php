<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Retourne toutes les catégories de produit.
     */
    public function index()
    {
        return response()->json(Categorie::all());
    }

    /**
     * Crée une nouvelle catégorie après validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $categorie = Categorie::create($validated);

        return response()->json($categorie, 201);
    }

    /**
     * Affiche le détail d'une catégorie.
     */
    public function show(Categorie $categorie)
    {
        return response()->json($categorie);
    }

    /**
     * Met à jour une catégorie existante.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $categorie->update($validated);

        return response()->json($categorie);
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return response()->json(null, 204);
    }
}
