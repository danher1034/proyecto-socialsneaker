<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionsRequest;
use App\Models\Collection;
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
        $collections = Collection::orderBy('created_at', 'desc')->get();

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
    public function show(Collection $collection) // Muestra la información detallada del evento seleccionado
    {
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

        // Toggle the like (add/remove like)
        if ($user->likedCollections()->where('collection_id', $collection->id)->exists()) {
            $user->likedCollections()->detach($collection->id); // Remover el like
        } else {
            $user->likedCollections()->attach($collection->id); // Agregar el like
        }

        return redirect()->route('collections');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection) // Funcion para eliminar el evento
    {
        $collection->delete();
        return redirect()->route('collections');
    }

    public function account()
    {
        $collections = Collection::where('user_id', Auth::user()->id)
        ->orderBy('date')
        ->get();

        return view('users.account', compact('collections'));
    }
}
