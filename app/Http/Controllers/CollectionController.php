<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionsRequest;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Collection::orderBy('date')->get();

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
        $collection=new Collection();
        $collection->description=$request->get('description');
        $collection->date=$request->get('date');
        $collection->tags=$request->get('tags');
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
        $collection->date=$request->get('date');
        $collection->tags=$request->get('tags');    
        $collection->save();

        return view('collections.edited', compact('collection'));
    }

    public function like(Collection $collection) // Funcion para dar like a los eventos
    {
        $collection->user()->toggle(Auth::user()->id); // Toggle permite quitar el like si ya existe
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
}
