<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CollectionsRequest;
use App\Http\Requests\CommentsRequest;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    /**
     * Muestra todas las colecciones con comentarios y usuarios, y calcula el tiempo transcurrido desde su creación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $collections = Collection::with(['comments', 'user'])->orderBy('created_at', 'desc')->get();

        foreach ($collections as $collection) {
            $createdAt = Carbon::parse($collection->created_at);
            $timeElapsed = $createdAt->diffForHumans([
                'locale' => 'es',
            ]);
            $collection->timeElapsed = $timeElapsed;
        }

        return view('collections.index', compact('collections'));
    }

    /**
     * Muestra la vista para crear una nueva colección, solo accesible vía AJAX.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (!request()->ajax()) {
            return redirect()->route('collections')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('collections.create');
    }

    /**
     * Almacena una nueva colección en la base de datos.
     *
     * @param \App\Http\Requests\CollectionsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollectionsRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'sell' => 'boolean',
            'image_collection' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return $this->handleFailedValidation($validator);
        }

        $collection = new Collection();
        $collection->description = $request->input('description');
        $collection->user_id = Auth::user()->id;
        $collection->tags = $request->input('tags');
        $collection->sell = $request->get('sell') ? 1 : 0;
        $collection->image_collection = '';

        $collection->save();

        if ($request->hasFile('image_collection')) {
            $image = $request->file('image_collection');
            $extension = $image->getClientOriginalExtension();
            $filename = $collection->id . '.' . $extension;

            // Guardar la imagen en el sistema de archivos
            $path = $image->storeAs('public/img/collection_images', $filename);

            // Actualizar la ruta de la imagen en el modelo Collection
            $collection->image_collection = '/storage/img/collection_images/' . $filename;
        }

        $collection->save();

        return redirect()->route('account')->with('success', 'Your work has been saved');
    }

    /**
     * Maneja la validación fallida.
     *
     * @param \Illuminate\Support\Facades\Validator $validator
     * @return \Illuminate\Http\RedirectResponse
    */

    protected function handleFailedValidation($validator)
    {
        $errors = $validator->errors()->all();
        return redirect()->route('account')->withErrors($errors)->withInput();
    }

    /**
     * Muestra una colección específica con sus comentarios y usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        if (!request()->ajax()) {
            return redirect()->route('collections')->withErrors(['error' => 'Acceso no permitido']);
        }

        $collection = Collection::with('comments.user')->findOrFail($id);
        $createdAt = Carbon::parse($collection->created_at);
        $collection->timeElapsed = $createdAt->diffForHumans([
            'locale' => 'es',
        ]);

        return view('collections.show', compact('collection'));
    }

    /**
     * Muestra la vista para editar una colección, solo accesible vía AJAX.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Collection $collection)
    {
        if (!request()->ajax()) {
            return redirect()->route('collections')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('collections.edit', compact('collection'));
    }

    /**
     * Actualiza una colección existente en la base de datos.
     *
     * @param \App\Http\Requests\CollectionsRequest $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CollectionsRequest $request, Collection $collection)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->handleFailedValidation($validator);
        }

        $collection->description = $request->input('description');
        $collection->tags = $request->input('tags');
        $collection->save();

        return response()->json(['success' => true, 'message' => 'Your work has been updated']);
    }

    /**
     * Permite a un usuario dar o quitar 'me gusta' a una colección.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Collection $collection)
    {
        $user = Auth::user();

        $liked = false;
        if ($user->likedCollections()->where('collection_id', $collection->id)->exists()) {
            $user->likedCollections()->detach($collection->id);
        } else {
            $user->likedCollections()->attach($collection->id);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }

    /**
     * Elimina una colección de la base de datos.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('collections');
    }

    /**
     * Muestra la cuenta del usuario y sus colecciones, así como el número de seguidores y seguidos.
     *
     * @param int|null $userId
     * @return \Illuminate\View\View
     */
    public function account($userId = null)
    {
        $user = $userId ? User::findOrFail($userId) : Auth::user();
        $collections = Collection::where('user_id', $user->id)
            ->orderBy('created_at')
            ->get();

        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        $collectionsCount = $collections->count();

        return view('users.account', compact('user', 'collections', 'followersCount', 'followingCount', 'collectionsCount'));
    }

    /**
     * Permite a un usuario agregar un comentario a una colección.
     *
     * @param \App\Http\Requests\CommentsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(CommentsRequest $request)
    {
        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->user_id = Auth::user()->id;
        $comment->collection_id = $request->input('collection_id');
        $comment->save();

        $comment = Comment::with('user')->find($comment->id);

        return response()->json([
            'success' => true,
            'comment' => $comment,
            'message' => 'Comentario añadido exitosamente.'
        ]);
    }
}
