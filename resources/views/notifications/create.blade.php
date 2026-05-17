<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une notification</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}select,textarea,input{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}textarea{min-height:120px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Ajouter une notification</h1>

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

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf

        <label for="user_id">Utilisateur</label>
        <select id="user_id" name="user_id" required>
            <option value="">Sélectionnez un utilisateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <label for="type">Type</label>
        <input id="type" name="type" value="{{ old('type') }}" required>

        <label for="contenu">Contenu</label>
        <textarea id="contenu" name="contenu" required>{{ old('contenu') }}</textarea>

        <label for="date_creation">Date de création</label>
        <input id="date_creation" name="date_creation" type="date" value="{{ old('date_creation') }}" required>

        <label for="vue">Vue</label>
        <select id="vue" name="vue" required>
            <option value="1" {{ old('vue') == '1' ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ old('vue') == '0' ? 'selected' : '' }}>Non</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="{{ route('notifications.index') }}">Retour à la liste des notifications</a></p>
</body>
</html>
