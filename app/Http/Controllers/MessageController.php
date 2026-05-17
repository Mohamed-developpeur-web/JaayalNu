<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Retourne la liste de tous les messages.
     */
    public function index(Request $request)
    {
        $messages = Message::with(['sender', 'receiver'])->get();

        if ($request->wantsJson()) {
            return response()->json($messages);
        }

        return view('messages.index', compact('messages'));
    }

    /**
     * Affiche le formulaire de création d'un message.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('messages.create', compact('users'));
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

        if ($request->wantsJson()) {
            return response()->json($message, 201);
        }

        return redirect()->route('messages.index')->with('success', 'Message créé avec succès.');
    }

    /**
     * Affiche un message unique.
     */
    public function show(Request $request, Message $message)
    {
        $message->load(['sender', 'receiver']);

        if ($request->wantsJson()) {
            return response()->json($message);
        }

        return view('messages.show', compact('message'));
    }

    /**
     * Affiche le formulaire d'édition d'un message.
     */
    public function edit(Message $message)
    {
        $users = User::orderBy('name')->get();

        return view('messages.edit', compact('message', 'users'));
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

        if ($request->wantsJson()) {
            return response()->json($message);
        }

        return redirect()->route('messages.show', $message)->with('success', 'Message mis à jour.');
    }

    /**
     * Supprime un message.
     */
    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('messages.index')->with('success', 'Message supprimé.');
    }
}
