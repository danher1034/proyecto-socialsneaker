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
                &nbsp;
                <div class="col-4">
                    <strong>Seguidores</strong><br>
                    425
                </div>
                &nbsp;
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
                <img
                    src="{{$collection->image_collection}}"
                    alt="{{$collection->image_collection}}"
                    class="img-fluid rounded-start d-block mx-auto img-collection"
                />
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
    @vite(['resources/js/account.js','resources/css/account.css'])
@endsection
