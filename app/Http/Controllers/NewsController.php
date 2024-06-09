<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
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

        // Filtrar por tipo de noticia si se ha especificado
        if ($request->has('type') && $request->get('type') !== 'all' && $request->get('type') !== 'novisible') {
            $query->where('type', $request->get('type'));
        }

        // Filtrar por término de búsqueda si se ha especificado
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('tags', 'LIKE', '%' . $search . '%')
                ->orWhere('title', 'LIKE', '%' . $search . '%');
            });
        }

        // Filtrar por visibilidad si se ha especificado
        if ($request->get('type') === 'novisible') {
            $query->where('visible', 0);
        } else {
            $query->where('visible', 1);
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
            return redirect()->route('news')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('news.create');
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

        return redirect()->route('news')->with('success', __('alert.all_good'));
    }

     /**
     * Muestra la vista para editar una noticia, solo accesible vía AJAX.
     *
     * @param \App\Models\News $collection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        if (!request()->ajax()) {
            return redirect()->route('news')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('news.edit', compact('news'));
    }

    /**
     * Actualiza una colección existente en la base de datos.
     *
     * @param \App\Http\Requests\NewsRequest $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->url = $request->input('url');
        $news->type = $request->input('type');
        $news->tags = $request->input('tags');
        $news->visible = $request->input('visible') ? 1 : 0;
        $news->save();
    
        return redirect()->route('news')->with('success', __('alert.all_good'));
    }
    

    /**
     * Elimina una colección de la base de datos.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        if ($news->image_news) {
            $imagePath = str_replace('/storage', 'public', $news->image_news);
            Storage::delete($imagePath);
        }

        $news->delete();
        return redirect()->route('news');
    }
}
