<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'utilisateur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Détail de l'utilisateur</h1>

    <dl>
        <dt>Nom</dt>
        <dd>{{ $user->name }}</dd>

        <dt>Email</dt>
        <dd>{{ $user->email }}</dd>

        <dt>Rôle</dt>
        <dd>{{ $user->role }}</dd>

        <dt>Date d'inscription</dt>
        <dd>{{ $user->date_inscription ? $user->date_inscription->format('d/m/Y') : '-' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('users.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('users.edit', $user) }}">Modifier</a>
    </p>
</body>
</html>
