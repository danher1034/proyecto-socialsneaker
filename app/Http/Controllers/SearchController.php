<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Busca todos los usuarios de la aplicación que cumplan con la condición de la búsqueda.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        })->get();

        return view('search.index', compact('users', 'searchTerm'));
    }
}


