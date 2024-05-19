<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionsRequest;
use App\Http\Requests\CommentsRequest;
use App\Models\Collection;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionsRequest $request)
    {
        $collection = new Collection();
        $collection->description = $request->input('description');
        $collection->user_id = Auth::user()->id;
        $collection->tags = $request->input('tags');
        $collection->image_collection = '';

        $collection->save();

        if ($request->hasFile('image_collection')) {
            $image = $request->file('image_collection');
            $extension = $image->getClientOriginalExtension();
            $filename = $collection->id . '.' . $extension; // Nuevo nombre de archivo

            // Guardar la imagen en el sistema de archivos
            $path = $image->storeAs('public/img/collection_images', $filename);

            // Actualizar la ruta de la imagen en el modelo Collection
            $collection->image_collection = '/storage/img/collection_images/' . $filename;
        }

        $collection->save();
        return view('collections.stored', compact('collection'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $collection = Collection::with('comments.user')->findOrFail($id);
        return view('collections.show', compact('collection'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection) // Formulario para editar el evento
    {
        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CollectionsRequest $request, Collection $collection)
    {
        $collection->description=$request->get('description');
        $collection->tags=$request->get('tags');
        $collection->save();

        return view('collections.edited', compact('collection'));
    }

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
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('collections');
    }

    public function account()
    {
        $collections = Collection::where('user_id', Auth::user()->id)
        ->orderBy('created_at')
        ->get();

        return view('users.account', compact('collections'));
    }

    public function comment(CommentsRequest $request)
    {
        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->user_id = Auth::user()->id;
        $comment->collection_id = $request->input('collection_id');

        $comment->save();

        return redirect()->route('collections')->with('success', 'Comentario añadido exitosamente.');
    }

}
