<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    {{-- Vue Blade qui affiche tous les produits disponibles. --}}
    <h1>Liste des produits</h1>

    <p><a class="button" href="{{ route('produits.create') }}">Ajouter un produit</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($produits->isEmpty())
        <p>Aucun produit disponible pour le moment.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Vendeur</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Date d'ajout</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ optional($produit->categorie)->nom }}</td>
                        <td>{{ optional($produit->vendeur)->id }}</td>
                        <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                        <td>{{ $produit->stock }}</td>
                        <td>{{ $produit->date_ajout ? $produit->date_ajout->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('produits.show', $produit) }}">Voir</a> |
                            <a href="{{ route('produits.edit', $produit) }}">Modifier</a> |
                            <form action="{{ route('produits.destroy', $produit) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none;background:none;color:#c0392b;cursor:pointer;padding:0;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
