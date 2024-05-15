@extends('layout')

@section('title')
@endsection

@section('content')
    <div class="mb-5 mt-5 row row-cols-1 row-cols-md-1 row-cols-xl-1 g-2 row justify-content-center">
        @forelse ($collections as $collection)
            <div class="card mb-3 colleccion_card">
                <div class="row g-0">
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle" style="max-width: 50px;">
                                <div class="ms-3 flex-grow-1 d-flex flex-column">
                                    <h5 class="card-title mb-0">{{ $collection->user->name }}</h5>
                                    <small class="text-muted">{{ $collection->timeElapsed }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <img
                                src="{{$collection->image_collection}}"
                                alt="{{$collection->image_collection}}"
                                class="img-fluid rounded-start d-block mx-auto"
                            />
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="card-text">
                                <div class="row">
                                    <div class="col-2">
                                        @if (Auth::user()->collection()->where('collection_id', $collection->id)->count()>0)
                                        <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart-fill corazon-lleno"></i></a>
                                        @else
                                            <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart corazon"></i></a>
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        <i class="bi bi-chat comentario" data-edit-url="{{ route('collections/show', $collection) }}"></i>
                                    </div>
                                </div>
                                <br><br>
                                {{$collection->description}}
                                <br>
                                    <a class="btn show-popup-collection" data-edit-url="{{ route('collections/show', $collection) }}">
                                        Editar perfil
                                    </a>

                                <div class="popup-container-collection">
                                    <div class="popup-box-collection"></div>
                                    <button class="close-btn-collection"></button>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <p>No hay colecciones disponibles.</p>
        @endforelse
        @vite(['resources/js/showcollection.js'])
    </div>

@endsection
