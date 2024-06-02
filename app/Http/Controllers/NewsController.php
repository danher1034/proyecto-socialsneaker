<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!request()->ajax()) {
            return redirect()->route('news.index')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('news.create'); // Asegúrate de que esta vista sea una vista parcial sin el layout completo
    }


    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
