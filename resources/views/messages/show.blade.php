<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du message</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Détail du message</h1>

    <dl>
        <dt>Expéditeur</dt>
        <dd>{{ $message->sender ? $message->sender->name : 'N/A' }}</dd>

        <dt>Destinataire</dt>
        <dd>{{ $message->receiver ? $message->receiver->name : 'N/A' }}</dd>

        <dt>Contenu</dt>
        <dd>{{ $message->contenu }}</dd>

        <dt>Date d'envoi</dt>
        <dd>{{ $message->date_envoi }}</dd>

        <dt>Lu</dt>
        <dd>{{ $message->lu ? 'Oui' : 'Non' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('messages.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('messages.edit', $message) }}">Modifier</a>
    </p>
</body>
</html>
