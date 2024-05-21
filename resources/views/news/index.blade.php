@extends('layout')

@section('title')

@section('content')
    <div class="container">
        <h1>NOTICIAS</h1>
        <header>
            <nav>
                <span class="cat" onclick="buscar('Tecnología')">Tecnología</span>
                <span class="cat" onclick="buscar('programación')">Programación</span>
                <span class="cat" onclick="buscar('deportes')">Deportes</span>
                <span class="cat" onclick="buscar('economía')">Economía</span>
                <span class="cat" onclick="buscar('educación')">Educación</span>
            </nav>
            <div class="busqueda">
                <input type="text" placeholder="Qué desea buscar" id="busqueda">
                <button onclick="buscarTema()">Buscar</button>
            </div>
        </header>


        <div class="container-noticias">

        </div>
    </div>
@vite(['resources/js/new.js', 'resources/css/new.css'])
@endsection
