@extends('layout')

@section('title')

@endsection

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-3">
            <img src="{{ asset(Auth::user()->image_user) }}" alt="Imagen de Perfil" class="img-fluid img_user_account">
        </div>
        <div class="col">
            <div class="row align-items-center mb-3"> <!-- Aquí se ha añadido la clase mb-3 para reducir el margen inferior -->
                <div class="col"><h2>{{ Auth::user()->name }}</h2></div>
                <!-- Contenido principal de la página -->
                <button class="btn show-popup"
                    data-edit-url="{{route('users/edit', Auth::user())}}">
                    Editar perfil
                </button>
                <!-- Contenedor del popup -->
                <div class="popup-container">
                    <div class="popup-box"></div>
                    <button class="close-btn">Cerrar</button>
                </div>
            </div>
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
    </div>
    <br>
    <hr class="line-account">
</div>
    @vite(['resources/js/account.js'])
@endsection

