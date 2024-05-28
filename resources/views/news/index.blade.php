@extends('layout')

@section('title')

@section('content')
<div class="container-news">
    <div class="header-news">
        <nav class="nav-news">
            <span class="cat" data-type="all">Todas</span>
            <span class="cat" data-type="news">Noticias</span>
            <span class="cat" data-type="launch">Lanzamientos</span>
            <span class="cat" data-type="event">Eventos</span>
        </nav>
        <button class="btn show-popup-edit" data-edit-url="{{ route('news/create') }}">
            Añadir noticia
        </button>
        <div class="busqueda">
            <input type="text" placeholder="Qué desea buscar" id="busqueda">
            <button id="searchButton">Buscar</button>
        </div>
    </div>

    <br><br>
    <div class="container-noticias">
        @forelse ($news as $new)
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <img src="{{ $new->image_news }}" class="img-fluid image-news"/>
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <a href="{{ $new->url }}"><h5 class="card-title">{{ $new->title }}</h5></a>
                    <p class="card-text">{{ $new->description }}</p>
                </div>
            </div>
        @empty
            <p>No hay colecciones disponibles.</p>
        @endforelse
    </div>
</div>
@vite(['resources/js/new.js', 'resources/css/new.css'])
@endsection

