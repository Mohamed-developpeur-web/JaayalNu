<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des abonnements premium</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}.action-form{display:inline;}</style>
</head>
<body>
    <h1>Liste des abonnements premium</h1>

    <p><a class="button" href="{{ route('abonnements-premium.create') }}">Ajouter un abonnement premium</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($abonnements->isEmpty())
        <p>Aucun abonnement trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Vendeur</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abonnements as $abonnement)
                    <tr>
                        <td>{{ $abonnement->vendeur ? optional($abonnement->vendeur->user)->name ?? 'Vendeur #' . $abonnement->vendeur->id : 'N/A' }}</td>
                        <td>{{ $abonnement->date_debut }}</td>
                        <td>{{ $abonnement->date_fin ?? '-' }}</td>
                        <td>{{ $abonnement->est_actif ? 'Oui' : 'Non' }}</td>
                        <td>
                            <a href="{{ route('abonnements-premium.show', $abonnement) }}">Voir</a> |
                            <a href="{{ route('abonnements-premium.edit', $abonnement) }}">Modifier</a> |
                            <form action="{{ route('abonnements-premium.destroy', $abonnement) }}" method="POST" class="action-form">
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
