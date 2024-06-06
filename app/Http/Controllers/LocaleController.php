<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Establece el idioma de la aplicación según la selección del usuario.
     *
     * @param string $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($lang)
    {
        if (in_array($lang, ['en', 'es', 'cn'])) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return back();
    }
}

