<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Retourne toutes les catégories de produit.
     */
    public function index(Request $request)
    {
        $categories = Categorie::all();

        if ($request->wantsJson()) {
            return response()->json($categories);
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une catégorie.
     */
    public function create()
    {
        return view('categories.create');
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

        if ($request->wantsJson()) {
            return response()->json($categorie, 201);
        }

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche le détail d'une catégorie.
     */
    public function show(Request $request, Categorie $categorie)
    {
        if ($request->wantsJson()) {
            return response()->json($categorie);
        }

        return view('categories.show', compact('categorie'));
    }

    /**
     * Affiche le formulaire d'édition d'une catégorie.
     */
    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
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

        if ($request->wantsJson()) {
            return response()->json($categorie);
        }

        return redirect()->route('categories.show', $categorie)->with('success', 'Catégorie mise à jour.');
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy(Request $request, Categorie $categorie)
    {
        $categorie->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }
}
