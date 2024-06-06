<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Muestra una lista de los chats abiertos del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function index() // Mostrar los chat abierto del usuario
    {
        $userId = Auth::id();

        // Subconsulta para obtener el último mensaje de cada conversación
        $latestMessages = DB::table('messages as m1')
            ->select('m1.*')
            ->whereIn('m1.id', function ($query) use ($userId) {
                $query->select(DB::raw('MAX(m2.id)'))
                    ->from('messages as m2')
                    ->where(function ($query) use ($userId) {
                        $query->where('m2.user_id', $userId)
                            ->orWhere('m2.receiver_id', $userId);
                    })
                    ->groupBy(DB::raw('LEAST(m2.user_id, m2.receiver_id), GREATEST(m2.user_id, m2.receiver_id)'));
            });

        // Obtener los usuarios con los que el usuario autenticado tiene conversaciones
        $chats = User::where('users.id', '!=', $userId)
            ->joinSub($latestMessages, 'latest_messages', function ($join) use ($userId) {
                $join->on('users.id', '=', 'latest_messages.user_id')
                     ->orOn('users.id', '=', 'latest_messages.receiver_id');
            })
            ->select('users.*', 'latest_messages.text as last_message_text', 'latest_messages.created_at as last_message_time')
            ->orderBy('last_message_time', 'desc')
            ->get();

        return view('chat.index', compact('chats'));
    }

    /**
     * Muestra el chat especificado.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id) // Mostrar el chat
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

    /**
     * Almacena un nuevo mensaje en el almacenamiento.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id) // Guardar el mensaje
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

        // Retornar respuesta JSON
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Busca chats abiertos con usuarios.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request) //Buscar chat abiertos con usuarios
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        return response()->json($users);
    }

}


