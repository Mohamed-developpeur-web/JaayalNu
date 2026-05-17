<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un visiteur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}select{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Ajouter un visiteur</h1>

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

    <form action="{{ route('visiteurs.store') }}" method="POST">
        @csrf

        <label for="user_id">Utilisateur</label>
        <select id="user_id" name="user_id" required>
            <option value="">Sélectionnez un utilisateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="{{ route('visiteurs.index') }}">Retour à la liste des visiteurs</a></p>
</body>
</html>
