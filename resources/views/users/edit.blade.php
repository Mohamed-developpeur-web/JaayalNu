<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'utilisateur</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;}label{display:block;margin-top:12px;}input,select{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px;}button{margin-top:16px;padding:10px 16px;background:#2d6ca2;color:#fff;border:none;border-radius:4px;cursor:pointer;}button:hover{background:#234f7b;}</style>
</head>
<body>
    <h1>Modifier l'utilisateur</h1>

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

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nom</label>
        <input id="name" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>

        <label for="password">Mot de passe (laisser vide pour conserver)</label>
        <input id="password" name="password" type="password">

        <label for="role">Rôle</label>
        <input id="role" name="role" value="{{ old('role', $user->role) }}" required>

        <label for="date_inscription">Date d'inscription</label>
        <input id="date_inscription" name="date_inscription" type="date" value="{{ old('date_inscription', $user->date_inscription ? $user->date_inscription->format('Y-m-d') : '') }}">

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <p><a href="{{ route('users.show', $user) }}">Retour à l'utilisateur</a></p>
</body>
</html>
