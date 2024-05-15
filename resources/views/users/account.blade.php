@extends('layout')

@section('title')
<br><br>
@endsection

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-3">
            <img src="{{ asset(Auth::user()->image_user) }}" alt="Imagen de Perfil" class="img-fluid img_user_account">
        </div>
        <div class="col">
            <div class="row align-items-center mb-3">
                <div class="col"><h2 class="fs-1">{{ Auth::user()->name }}</h2></div>

                <div class="col-6">
                    <button class="btn show-popup" data-edit-url="{{ route('users/edit', Auth::user()) }}">
                        Editar perfil
                    </button>
                </div>

                <div class="popup-container">
                    <div class="popup-box"></div>
                    <button class="close-btn"></button>
                </div>
                @if(Session::has('success_message'))
                    <script>
                        var successMessage = "{{ Session::get('success_message') }}";
                    </script>
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <strong>Colecciones</strong><br>
                    20
                </div>
                <div class="col-4">
                    <strong>Seguidores</strong><br>
                    425
                </div>
                <div class="col-3">
                    <strong>Seguidos</strong><br>
                    34
                </div>
            </div>
        </div>
        <br>
        <hr class="line-account">
        <br><br>
    </div>
    <div>
        @forelse ($collections as $collection)
            <div class="card text-center">
                <div class="card-header"><h2 class="card-title"><a class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('collections/show', $collection)}}">{{$collection->name}}</a></h2></div>
                    <div class="card-body">
                        <h5 class="card-title">Hola</h5>
                        <p class="card-text">{{$collection->description}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <a type="button" class="btn btn-warning" href="{{ route('collections/edit', $collection) }}">Editar</a>
                        &nbsp;&nbsp;&nbsp;
                        <a type="button" class="btn btn-danger" href="{{route('collections/destroy', $collection)}}">Eliminar</a>
                        &nbsp;&nbsp;&nbsp;
                        @if (Auth::user()->collection()->where('collection_id', $collection->id)->count()>0)
                            <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart-fill"></i></a>
                        @else
                            <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
        <br><br><br>
            <div class="text-center">
                <img width="100px" height="100px" src="/storage/img/camara.png" alt="camara">
                <br><br>
                <p>No tienes colecciones aún</p>
            </div>
        <br><br><br>
        @endforelse
    </div>
</div>
    @vite(['resources/js/account.js'])
@endsection
