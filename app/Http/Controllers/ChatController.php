<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios menos el usuario actual
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    public function show($id)
    {
        // Obtener todos los mensajes entre el usuario autenticado y el usuario seleccionado
        $messages = Message::where(function($query) use ($id) {
            $query->where('user_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })->where(function($query) use ($id) {
            $query->where('user_id', $id)
                  ->orWhere('receiver_id', $id);
        })->with('user', 'receiver')->get();

        $receiver = User::find($id);

        return view('chat.show', compact('messages', 'receiver'));
    }

    public function store(Request $request, $id)
    {
        // Validar y almacenar un nuevo mensaje
        $request->validate([
            'text' => 'required|string',
        ]);

        $message = Message::create([
            'text' => $request->text,
            'date' => now()->format('Y-m-d'),
            'hour' => now()->format('H:i:s'),
            'user_id' => Auth::id(),
            'receiver_id' => $id,
        ]);

        return redirect()->route('chat.show', $id);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        return response()->json($users);
    }

}


