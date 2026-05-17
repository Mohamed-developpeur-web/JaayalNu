<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un message</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}select,textarea,input{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}textarea{min-height:120px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Ajouter un message</h1>

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

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf

        <label for="sender_id">Expéditeur</label>
        <select id="sender_id" name="sender_id" required>
            <option value="">Sélectionnez un expéditeur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('sender_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <label for="receiver_id">Destinataire</label>
        <select id="receiver_id" name="receiver_id" required>
            <option value="">Sélectionnez un destinataire</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <label for="contenu">Contenu</label>
        <textarea id="contenu" name="contenu" required>{{ old('contenu') }}</textarea>

        <label for="date_envoi">Date d'envoi</label>
        <input id="date_envoi" name="date_envoi" type="date" value="{{ old('date_envoi') }}" required>

        <label for="lu">Lu</label>
        <select id="lu" name="lu" required>
            <option value="1" {{ old('lu') == '1' ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ old('lu') == '0' ? 'selected' : '' }}>Non</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="{{ route('messages.index') }}">Retour à la liste des messages</a></p>
</body>
</html>
