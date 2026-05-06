<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}input,select,textarea{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}.error{color:#c0392b;margin-top:4px;font-size:0.9rem;}</style>
</head>
<body>
    {{-- Formulaire Blade pour créer un produit. --}}
    <h1>Ajouter un produit</h1>

    @if($errors->any())
        <div style="margin-bottom:16px;padding:12px;background:#fdecea;color:#c0392b;border:1px solid #f5c6cb;">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produits.store') }}" method="POST">
        @csrf

        <label for="nom">Nom du produit</label>
        <input id="nom" name="nom" value="{{ old('nom') }}" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>

        <label for="categorie_id">Catégorie</label>
        <select id="categorie_id" name="categorie_id" required>
            <option value="">Sélectionnez une catégorie</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
            @endforeach
        </select>

        <label for="vendeur_id">Vendeur</label>
        <select id="vendeur_id" name="vendeur_id" required>
            <option value="">Sélectionnez un vendeur</option>
            @foreach($vendeurs as $vendeur)
                <option value="{{ $vendeur->id }}" {{ old('vendeur_id') == $vendeur->id ? 'selected' : '' }}>{{ $vendeur->id }}</option>
            @endforeach
        </select>

        <label for="prix">Prix</label>
        <input id="prix" name="prix" type="number" step="0.01" min="0" value="{{ old('prix') }}" required>

        <label for="stock">Stock</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock') ?? 0 }}" required>

        <label for="date_ajout">Date d'ajout</label>
        <input id="date_ajout" name="date_ajout" type="date" value="{{ old('date_ajout') }}" required>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="{{ route('produits.index') }}">Retour à la liste des produits</a></p>
</body>
</html>
