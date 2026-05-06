<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Retourne la liste des notifications.
     */
    public function index()
    {
        return response()->json(Notification::all());
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

        return response()->json($notification, 201);
    }

    /**
     * Affiche le détail d'une notification.
     */
    public function show(Notification $notification)
    {
        return response()->json($notification);
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

        return response()->json($notification);
    }

    /**
     * Supprime une notification.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json(null, 204);
    }
}
