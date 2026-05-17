<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'abonnement premium</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}dl{max-width:700px;}dt{font-weight:bold;margin-top:12px;}dd{margin:0 0 12px 0;}a.button{display:inline-block;padding:8px 14px;background:#2d6ca2;color:#fff;text-decoration:none;border-radius:4px;}a.button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Détail de l'abonnement premium</h1>

    <dl>
        <dt>Vendeur</dt>
        <dd>{{ $abonnementPremium->vendeur ? optional($abonnementPremium->vendeur->user)->name ?? 'Vendeur #' . $abonnementPremium->vendeur->id : 'N/A' }}</dd>

        <dt>Date de début</dt>
        <dd>{{ $abonnementPremium->date_debut }}</dd>

        <dt>Date de fin</dt>
        <dd>{{ $abonnementPremium->date_fin ?? '-' }}</dd>

        <dt>Actif</dt>
        <dd>{{ $abonnementPremium->est_actif ? 'Oui' : 'Non' }}</dd>
    </dl>

    <p>
        <a class="button" href="{{ route('abonnements-premium.index') }}">Retour à la liste</a>
        <a class="button" href="{{ route('abonnements-premium.edit', $abonnementPremium) }}">Modifier</a>
    </p>
</body>
</html>
