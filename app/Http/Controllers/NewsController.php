<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Auth;

class NewsController extends Controller
{
    /**
     * Muestra todas las noticias y aplica los filtros si es necesario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('type') && $request->get('type') !== 'all') {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('tags', 'LIKE', '%' . $search . '%')
                ->orWhere('title', 'LIKE', '%' . $search . '%');
            });
        }

        $news = $query->get();
        return view('news.index', compact('news'));
    }

    /**
     * Muestra el formulario de creación de noticias.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (!request()->ajax()) {
            return redirect()->route('news.index')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('news.create'); // Asegúrate de que esta vista sea una vista parcial sin el layout completo
    }


    /**
     * Almacena una nueva noticia en la base de datos.
     *
     * @param \App\Http\Requests\NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $news->title = $request->get('title');
        $news->description = $request->get('description');
        $news->url = $request->get('url');
        $news->type = $request->get('type');
        $news->tags = $request->get('tags');
        $news->visible = $request->get('visible') ? 1 : 0;
        $news->image_news = '';


        $news->save();

        if ($request->hasFile('image_news')) {
            $image = $request->file('image_news');
            $extension = $image->getClientOriginalExtension();
            $filename = $news->id . '.' . $extension;
            $path = $image->storeAs('public/img/news_images', $filename);
            $news->image_news = '/storage/img/news_images/' . $filename;
        }

        $news->save();

        return redirect()->route('news.index');
    }

    /**
     * Muestra el formulario de edición de una noticia específica.
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Actualiza una noticia específica en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return void
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Elimina una noticia específica de la base de datos.
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        //
    }
}
