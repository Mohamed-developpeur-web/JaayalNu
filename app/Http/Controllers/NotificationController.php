<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Retourne la liste des notifications.
     */
    public function index(Request $request)
    {
        $notifications = Notification::with('user')->get();

        if ($request->wantsJson()) {
            return response()->json($notifications);
        }

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Affiche le formulaire de création d'une notification.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('notifications.create', compact('users'));
    }

    /**
     * Crée une notification valide et l'enregistre.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'type' => ['required', 'string', 'max:100'],
            'contenu' => ['required', 'string', 'max:2000'],
            'date_creation' => ['required', 'date'],
            'vue' => ['required', 'boolean'],
        ]);

        $notification = Notification::create($validated);

        if ($request->wantsJson()) {
            return response()->json($notification, 201);
        }

        return redirect()->route('notifications.index')->with('success', 'Notification créée avec succès.');
    }

    /**
     * Affiche le détail d'une notification.
     */
    public function show(Request $request, Notification $notification)
    {
        $notification->load('user');

        if ($request->wantsJson()) {
            return response()->json($notification);
        }

        return view('notifications.show', compact('notification'));
    }

    /**
     * Affiche le formulaire d'édition d'une notification.
     */
    public function edit(Notification $notification)
    {
        $users = User::orderBy('name')->get();

        return view('notifications.edit', compact('notification', 'users'));
    }

    /**
     * Met à jour une notification existante.
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'type' => ['required', 'string', 'max:100'],
            'contenu' => ['required', 'string', 'max:2000'],
            'date_creation' => ['required', 'date'],
            'vue' => ['required', 'boolean'],
        ]);

        $notification->update($validated);

        if ($request->wantsJson()) {
            return response()->json($notification);
        }

        return redirect()->route('notifications.show', $notification)->with('success', 'Notification mise à jour.');
    }

    /**
     * Supprime une notification.
     */
    public function destroy(Request $request, Notification $notification)
    {
        $notification->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('notifications.index')->with('success', 'Notification supprimée.');
    }
}
