<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des messages</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:10px;border:1px solid #ddd;text-align:left;}th{background:#f4f4f4;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}.action-form{display:inline;}</style>
</head>
<body>
    <h1>Liste des messages</h1>

    <p><a class="button" href="{{ route('messages.create') }}">Ajouter un message</a></p>

    @if(session('success'))
        <div style="margin-bottom:16px;padding:10px;background:#e6ffed;color:#1a7f37;border:1px solid #c4e8c4;">
            {{ session('success') }}
        </div>
    @endif

    @if($messages->isEmpty())
        <p>Aucun message trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Expéditeur</th>
                    <th>Destinataire</th>
                    <th>Date d'envoi</th>
                    <th>Lu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->sender ? $message->sender->name : 'N/A' }}</td>
                        <td>{{ $message->receiver ? $message->receiver->name : 'N/A' }}</td>
                        <td>{{ $message->date_envoi }}</td>
                        <td>{{ $message->lu ? 'Oui' : 'Non' }}</td>
                        <td>
                            <a href="{{ route('messages.show', $message) }}">Voir</a> |
                            <a href="{{ route('messages.edit', $message) }}">Modifier</a> |
                            <form action="{{ route('messages.destroy', $message) }}" method="POST" class="action-form">
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
