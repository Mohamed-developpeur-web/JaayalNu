<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Vendeur;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits.
     * Retourne JSON pour les requêtes API, ou une vue Blade pour les utilisateurs web.
     */
    public function index(Request $request)
    {
        $produits = Produit::with(['categorie', 'vendeur'])->get();

        if ($request->wantsJson()) {
            return response()->json($produits);
        }

        return view('produits.index', compact('produits'));
    }

    /**
     * Affiche le formulaire de création d'un produit.
     */
    public function create()
    {
        $categories = Categorie::orderBy('nom')->get();
        $vendeurs = Vendeur::orderBy('id')->get();

        return view('produits.create', compact('categories', 'vendeurs'));
    }

    /**
     * Valide les données et crée un nouveau produit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $produit = Produit::create($validated);

        if ($request->wantsJson()) {
            return response()->json($produit, 201);
        }

        return redirect()->route('produits.show', $produit)->with('success', 'Produit créé avec succès.');
    }

    /**
     * Affiche un produit précis.
     */
    public function show(Request $request, Produit $produit)
    {
        $produit->load(['categorie', 'vendeur']);

        if ($request->wantsJson()) {
            return response()->json($produit);
        }

        return view('produits.show', compact('produit'));
    }

    /**
     * Affiche le formulaire d'édition d'un produit.
     */
    public function edit(Produit $produit)
    {
        $categories = Categorie::orderBy('nom')->get();
        $vendeurs = Vendeur::orderBy('id')->get();

        return view('produits.edit', compact('produit', 'categories', 'vendeurs'));
    }

    /**
     * Valide les données et met à jour un produit existant.
     */
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate($this->validationRules());

        $produit->update($validated);

        if ($request->wantsJson()) {
            return response()->json($produit);
        }

        return redirect()->route('produits.show', $produit)->with('success', 'Produit mis à jour.');
    }

    /**
     * Supprime un produit.
     */
    public function destroy(Request $request, Produit $produit)
    {
        $produit->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }

    /**
     * Règles de validation partagées pour store et update.
     */
    protected function validationRules(): array
    {
        return [
            'vendeur_id' => ['required', 'integer', 'exists:vendeurs,id'],
            'categorie_id' => ['required', 'integer', 'exists:categories,id'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'prix' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'date_ajout' => ['required', 'date'],
        ];
    }
}
