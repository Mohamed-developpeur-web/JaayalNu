<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'administrateur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}input,select{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Modifier l'administrateur</h1>

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

    <form action="{{ route('administrateurs.update', $administrateur) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nom">Nom</label>
        <input id="nom" name="nom" value="{{ old('nom', $administrateur->nom) }}" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $administrateur->email) }}" required>

        <label for="user_id">Utilisateur associé</label>
        <select id="user_id" name="user_id" required>
            <option value="">Sélectionnez un utilisateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $administrateur->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <p><a href="{{ route('administrateurs.show', $administrateur) }}">Retour à l'administrateur</a></p>
</body>
</html>
