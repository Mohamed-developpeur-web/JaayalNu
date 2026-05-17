<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des administrateurs</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}.action-form{display:inline;}</style>
</head>
<body>
    <h1>Liste des administrateurs</h1>

    <p><a class="button" href="{{ route('administrateurs.create') }}">Ajouter un administrateur</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($administrateurs->isEmpty())
        <p>Aucun administrateur trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($administrateurs as $administrateur)
                    <tr>
                        <td>{{ $administrateur->nom }}</td>
                        <td>{{ $administrateur->email }}</td>
                        <td>{{ $administrateur->user ? $administrateur->user->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('administrateurs.show', $administrateur) }}">Voir</a> |
                            <a href="{{ route('administrateurs.edit', $administrateur) }}">Modifier</a> |
                            <form action="{{ route('administrateurs.destroy', $administrateur) }}" method="POST" class="action-form">
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
