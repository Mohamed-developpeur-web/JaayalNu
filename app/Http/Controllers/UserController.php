<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Retourne la liste de tous les utilisateurs.
     */
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->wantsJson()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Crée un nouvel utilisateur après validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        if ($request->wantsJson()) {
            return response()->json($user, 201);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Messages de validation personnalisés pour les erreurs en français.
     */
    protected function validationMessages(): array
    {
        return [
            'name.required' => 'Le nom complet est requis.',
            'name.string' => 'Le nom complet doit être une chaîne de caractères.',
            'name.max' => 'Le nom complet ne doit pas dépasser 255 caractères.',
            'email.required' => 'L’adresse e-mail est requise.',
            'email.email' => 'L’adresse e-mail doit être valide.',
            'email.max' => 'L’adresse e-mail ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'role.required' => 'Le rôle est requis.',
            'role.string' => 'Le rôle doit être une chaîne de caractères.',
            'role.max' => 'Le rôle ne doit pas dépasser 50 caractères.',
            'date_inscription.date' => "La date d'inscription doit être une date valide.",
        ];
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(Request $request, User $user)
    {
        if ($request->wantsJson()) {
            return response()->json($user);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Authentifie un utilisateur et renvoie un token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Identifiants invalides.'], 422);
        }

        $token = bin2hex(random_bytes(40));
        $user->api_token = $token;
        $user->save();

        return response()->json(['user' => $user, 'token' => $token]);
    }

    /**
     * Déconnecte l'utilisateur en invalidant son token.
     */
    public function logout(Request $request)
    {
        $authorization = $request->header('Authorization');
        $token = $authorization && str_starts_with($authorization, 'Bearer ')
            ? substr($authorization, 7)
            : null;

        if (! $token) {
            return response()->json(['message' => 'Token non fourni.'], 401);
        }

        $user = User::where('api_token', $token)->first();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['message' => 'Déconnecté avec succès.']);
    }

    /**
     * Renvoie l'utilisateur authentifié à partir du token.
     */
    public function me(Request $request)
    {
        $authorization = $request->header('Authorization');
        $token = $authorization && str_starts_with($authorization, 'Bearer ')
            ? substr($authorization, 7)
            : null;

        if (! $token) {
            return response()->json(['message' => 'Token non fourni.'], 401);
        }

        $user = User::where('api_token', $token)->first();

        if (! $user) {
            return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
        }

        return response()->json($user);
    }

    /**
     * Met à jour un utilisateur existant.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate($this->validationRules($user));

        if (! $request->filled('password')) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json($user);
        }

        return redirect()->route('users.show', $user)->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Définit les règles de validation pour la création et la mise à jour.
     */
    protected function validationRules(User $user = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:50'],
            'date_inscription' => ['nullable', 'date'],
        ];
    }
}
