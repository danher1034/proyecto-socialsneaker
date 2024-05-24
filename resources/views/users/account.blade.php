@extends('layout')

@section('title')
<br><br>
@endsection

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-3">
            <img src="{{ asset($user->image_user) }}" alt="Imagen de Perfil" class="img-fluid img_user_account">
        </div>
        <div class="col">
            <div class="row align-center-row mb-1">
                <div class="col-2 title-user"><strong>{{ $user->name }}</strong></div>
                <div class="col-1 col-md-4 d-flex align-items-center justify-content-end actions">
                    @if ($user->id == Auth::id())
                        <button class="btn show-popup-edit" data-edit-url="{{ route('users/edit', $user) }}">
                            Editar perfil
                        </button>
                        <div class="dropdown">
                            <button class="dropbtn"><strong>⋮</strong></button>
                            <div class="dropdown-content">
                                <a href="{{ route('logout') }}">Cerrar sesión</a>
                                <a href="#" id="delete-account">Eliminar cuenta</a>
                            </div>
                        </div>
                        <form id="delete-account-form" action="{{ route('users/delete', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <button type="button" class="btn btn-primary me-3" id="follow-button" data-user-id="{{ $user->id }}">
                            {{ Auth::user()->following()->where('user_id', $user->id)->exists() ? 'Siguiendo' : 'Seguir' }}
                        </button>
                        <a href="{{ route('chat.show', $user->id) }}" class="btn btn-secondary">Enviar mensaje</a>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <strong>Colecciones</strong><br>
                    {{ $collectionsCount }}
                </div>
                &nbsp;
                <div class="col-4">
                    <strong>Seguidores</strong><br>
                    {{ $followersCount }}
                </div>
                &nbsp;
                <div class="col-3">
                    <strong>Seguidos</strong><br>
                    {{ $followingCount }}
                </div>
            </div>
        </div>
        <br>
        <hr class="line-account">
        <br><br>
    </div>
    <div class="container-account">
        @forelse ($collections as $collection)
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <img
                        src="{{$collection->image_collection}}"
                        alt="{{$collection->image_collection}}"
                        class="img-fluid rounded-start d-block mx-auto img-collection"
                    />
                </div>
            </div>
        @empty
            <div class="text-center">
                <i class="bi bi-camera icon-camera"></i>
                <br><br>
                <p>No tienes colecciones aún</p>
            </div>
        @endforelse
    </div>
</div>
@vite(['resources/js/account.js','resources/css/account.css'])
@endsection
