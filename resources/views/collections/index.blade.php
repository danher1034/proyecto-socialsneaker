@extends('layout')

@section('title')
@endsection

@section('content')
    <div class="mb-5 mt-5 row row-cols-1 row-cols-md-2 row-cols-xl-1 g-4">
        @forelse ($collections as $collection)
            <div class="card mb-3" style="max-width: 1040px;">
                <div class="row g-0">
                  <div class="col-md-5">
                    <img
                      src="{{$collection->image_collection}}"
                      alt="{{$collection->image_collection}}"
                      class="img-fluid rounded-start"
                    />
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle" style="max-width: 50px;">
                            <h5 class="card-title">{{ $collection->user->name }}</h5>
                        </div>
                      <p class="card-text">
                        {{$collection->description}}
                        <br><br>
                        @if (Auth::user()->collection()->where('collection_id', $collection->id)->count()>0)
                            <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart-fill"></i></a>
                        @else
                            <a href="{{route('collections/like', $collection)}}"><i class="bi bi-heart"></i></a>
                        @endif
                      </p>
                      <p class="card-text">
                        <small class="text-muted">{{$collection->date}}</small>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
        @empty
        <p>No hay colecciones disponibles.</p>
        @endforelse
    </div>

@endsection
