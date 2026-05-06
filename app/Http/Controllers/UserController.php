<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Retourne la liste de tous les utilisateurs.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Crée un nouvel utilisateur après validation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(User $user)
    {
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
        }

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
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
