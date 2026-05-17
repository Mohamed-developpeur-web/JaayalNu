<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des visiteurs</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}.action-form{display:inline;}</style>
</head>
<body>
    <h1>Liste des visiteurs</h1>

    <p><a class="button" href="{{ route('visiteurs.create') }}">Ajouter un visiteur</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($visiteurs->isEmpty())
        <p>Aucun visiteur trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visiteurs as $visiteur)
                    <tr>
                        <td>{{ $visiteur->user ? $visiteur->user->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('visiteurs.show', $visiteur) }}">Voir</a> |
                            <a href="{{ route('visiteurs.edit', $visiteur) }}">Modifier</a> |
                            <form action="{{ route('visiteurs.destroy', $visiteur) }}" method="POST" class="action-form">
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
