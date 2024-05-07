@extends('layout')

@section('title')
@endsection

@section('content')
    <div class="mb-4 mt-4 row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
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
        @empty
        <p>No hay colecciones disponibles.</p>
        @endforelse
    </div>

@endsection