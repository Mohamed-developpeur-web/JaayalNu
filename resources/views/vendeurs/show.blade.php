<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du vendeur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Détail du vendeur</h1>

    <dl>
        <dt>Utilisateur</dt>
        <dd>{{ $vendeur->user ? $vendeur->user->name : 'N/A' }}</dd>

        <dt>Statut</dt>
        <dd>{{ $vendeur->status_compte }}</dd>

        <dt>Premium</dt>
        <dd>{{ $vendeur->est_premium ? 'Oui' : 'Non' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('vendeurs.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('vendeurs.edit', $vendeur) }}">Modifier</a>
    </p>
</body>
</html>
