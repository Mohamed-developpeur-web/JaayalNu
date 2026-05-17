<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'abonnement premium</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}select,input{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Modifier l'abonnement premium</h1>

    @if($errors->any())
        <div style="margin-bottom:16px;padding:12px;background:#fdecea;color:#c0392b;border:1px solid #f5c6cb;">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('abonnements-premium.update', $abonnementPremium) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="vendeur_id">Vendeur</label>
        <select id="vendeur_id" name="vendeur_id" required>
            @foreach($vendeurs as $vendeur)
                <option value="{{ $vendeur->id }}" {{ old('vendeur_id', $abonnementPremium->vendeur_id) == $vendeur->id ? 'selected' : '' }}>{{ optional($vendeur->user)->name ?? 'Vendeur #' . $vendeur->id }}</option>
            @endforeach
        </select>

        <label for="date_debut">Date de début</label>
        <input id="date_debut" name="date_debut" type="date" value="{{ old('date_debut', $abonnementPremium->date_debut) }}" required>

        <label for="date_fin">Date de fin</label>
        <input id="date_fin" name="date_fin" type="date" value="{{ old('date_fin', $abonnementPremium->date_fin) }}">

        <label for="est_actif">Actif</label>
        <select id="est_actif" name="est_actif" required>
            <option value="1" {{ old('est_actif', $abonnementPremium->est_actif) ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ !old('est_actif', $abonnementPremium->est_actif) ? 'selected' : '' }}>Non</option>
        </select>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <p><a href="{{ route('abonnements-premium.show', $abonnementPremium) }}">Retour à l'abonnement</a></p>
</body>
</html>
