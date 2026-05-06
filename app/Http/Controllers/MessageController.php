<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Retourne la liste de tous les messages.
     */
    public function index()
    {
        return response()->json(Message::all());
    }

    /**
     * Crée un message après validation des champs.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => ['required', 'integer', 'exists:users,id'],
            'receiver_id' => ['required', 'integer', 'exists:users,id'],
            'contenu' => ['required', 'string', 'max:2000'],
            'date_envoi' => ['required', 'date'],
            'lu' => ['required', 'boolean'],
        ]);

        $message = Message::create($validated);

        return response()->json($message, 201);
    }

    /**
     * Affiche un message unique.
     */
    public function show(Message $message)
    {
        return response()->json($message);
    }

    /**
     * Met à jour un message existant.
     */
    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'sender_id' => ['required', 'integer', 'exists:users,id'],
            'receiver_id' => ['required', 'integer', 'exists:users,id'],
            'contenu' => ['required', 'string', 'max:2000'],
            'date_envoi' => ['required', 'date'],
            'lu' => ['required', 'boolean'],
        ]);

        $message->update($validated);

        return response()->json($message);
    }

    /**
     * Supprime un message.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(null, 204);
    }
}
