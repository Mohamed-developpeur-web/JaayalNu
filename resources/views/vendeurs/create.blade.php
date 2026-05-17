<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un vendeur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}select,input{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Ajouter un vendeur</h1>

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

    <form action="{{ route('vendeurs.store') }}" method="POST">
        @csrf

        <label for="user_id">Utilisateur</label>
        <select id="user_id" name="user_id" required>
            <option value="">Sélectionnez un utilisateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <label for="status_compte">Statut du compte</label>
        <input id="status_compte" name="status_compte" value="{{ old('status_compte') }}" required>

        <label for="est_premium">Est premium</label>
        <select id="est_premium" name="est_premium" required>
            <option value="1" {{ old('est_premium') == '1' ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ old('est_premium') == '0' ? 'selected' : '' }}>Non</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="{{ route('vendeurs.index') }}">Retour à la liste des vendeurs</a></p>
</body>
</html>
