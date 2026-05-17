<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des vendeurs</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}.action-form{display:inline;}</style>
</head>
<body>
    <h1>Liste des vendeurs</h1>

    <p><a class="button" href="{{ route('vendeurs.create') }}">Ajouter un vendeur</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($vendeurs->isEmpty())
        <p>Aucun vendeur trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Statut</th>
                    <th>Premium</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendeurs as $vendeur)
                    <tr>
                        <td>{{ $vendeur->user ? $vendeur->user->name : 'N/A' }}</td>
                        <td>{{ $vendeur->status_compte }}</td>
                        <td>{{ $vendeur->est_premium ? 'Oui' : 'Non' }}</td>
                        <td>
                            <a href="{{ route('vendeurs.show', $vendeur) }}">Voir</a> |
                            <a href="{{ route('vendeurs.edit', $vendeur) }}">Modifier</a> |
                            <form action="{{ route('vendeurs.destroy', $vendeur) }}" method="POST" class="action-form">
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
