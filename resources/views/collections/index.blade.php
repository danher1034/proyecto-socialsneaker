@extends('layout')

@section('title')
@endsection

@section('content')
<div class="mb-5 mt-5 row row-cols-1 row-cols-md-1 row-cols-xl-1 g-2 row justify-content-center">
    @forelse ($collections as $collection)
        <div class="card mb-3 colleccion_card">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle" style="max-width: 50px;">
                            <div class="ms-3 flex-grow-1 d-flex flex-column">
                                <a href="/account/{{ $collection->user->id}}"><h5 class="card-title mb-0">{{ $collection->user->name }}</h5></a>
                                <small class="text-muted">{{ $collection->timeElapsed }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <img src="{{ $collection->image_collection }}" alt="{{ $collection->image_collection }}" class="img-fluid rounded-start d-block mx-auto img-collection" />
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <p class="card-text">
                            <div class="row">
                                <div class="col-1">
                                    @if (Auth::user()->likedCollections()->where('collection_id', $collection->id)->exists())
                                        <a href="javascript:void(0)" class="like-button" data-id="{{ $collection->id }}"><i class="bi bi-heart-fill corazon-lleno"></i></a>
                                    @else
                                        <a href="javascript:void(0)" class="like-button" data-id="{{ $collection->id }}"><i class="bi bi-heart corazon"></i></a>
                                    @endif
                                </div>
                                &nbsp;&nbsp;&nbsp;
                                <div class="col-1">
                                    <a href="javascript:void(0)" class="show-popup-collection" data-edit-url="{{ route('collections/show', $collection) }}"><i class="bi bi-chat chat"></i></a>
                                </div>
                            </div>
                            <br>
                            <strong>{{ $collection->user->name }} </strong>{{ $collection->description }}
                            <br>
                            @if ($collection->comments->count() > 0)
                                <br>
                                <a href="javascript:void(0)" class="show-popup-collection" data-edit-url="{{ route('collections/show', $collection) }}">
                                    @if ($collection->comments->count() < 2)
                                        @lang('collection.see') {{ $collection->comments->count() }} @lang('collection.comment')
                                    @else
                                        @lang('collection.sees') {{ $collection->comments->count() }} @lang('collection.comments')
                                    @endif
                                </a>
                                <br>
                            @endif
                            <div class="comment-container">
                                <form action="{{ route('collections/comment') }}" method="post" class="coment_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                                    <input type="text" name="text" id="input-coment-{{ $collection->id }}" placeholder="@lang('collection.addcomment')">
                                    <button type="submit" id="comment-{{ $collection->id }}" class="hidden">Enviar</button>
                                </form>
                            </div>
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
    @vite(['resources/js/showcollection.js', 'resources/css/collection.css'])
</div>
@endsection


