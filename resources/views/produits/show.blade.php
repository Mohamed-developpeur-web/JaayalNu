<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du produit</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    {{-- Vue Blade pour afficher les informations complètes d'un produit. --}}
    <h1>Détail du produit</h1>

    <dl>
        <dt>Nom</dt>
        <dd>{{ $produit->nom }}</dd>

        <dt>Description</dt>
        <dd>{{ $produit->description ?? 'Aucune description' }}</dd>

        <dt>Catégorie</dt>
        <dd>{{ optional($produit->categorie)->nom ?? 'Non définie' }}</dd>

        <dt>Vendeur</dt>
        <dd>{{ optional($produit->vendeur)->id ?? 'Non défini' }}</dd>

        <dt>Prix</dt>
        <dd>{{ number_format($produit->prix, 2, ',', ' ') }} €</dd>

        <dt>Stock</dt>
        <dd>{{ $produit->stock }}</dd>

        <dt>Date d'ajout</dt>
        <dd>{{ $produit->date_ajout ? $produit->date_ajout->format('d/m/Y') : '-' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('produits.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('produits.edit', $produit) }}">Modifier</a>
    </p>
</body>
</html>
