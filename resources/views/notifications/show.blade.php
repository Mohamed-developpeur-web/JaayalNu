<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la notification</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Détail de la notification</h1>

    <dl>
        <dt>Utilisateur</dt>
        <dd>{{ $notification->user ? $notification->user->name : 'N/A' }}</dd>

        <dt>Type</dt>
        <dd>{{ $notification->type }}</dd>

        <dt>Contenu</dt>
        <dd>{{ $notification->contenu }}</dd>

        <dt>Date de création</dt>
        <dd>{{ $notification->date_creation }}</dd>

        <dt>Vue</dt>
        <dd>{{ $notification->vue ? 'Oui' : 'Non' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('notifications.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('notifications.edit', $notification) }}">Modifier</a>
    </p>
</body>
</html>
