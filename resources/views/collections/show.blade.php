
@extends('layout')

@section('title')
@endsection

@section('content')
      <div class="card text-center">
        <div class="card-body">
          <p class="card-text">{{$collection->description}}</p>
        </div>
        <ul class="list-group list-group-light list-group-small">
            <li class="list-group-item px-4"> Etiquetas: {{$collection->tags}}</li>
            <li class="list-group-item px-4">{{$collection->date}}</li>
        </ul>
        <div class="card-footer text-muted"> 
          @auth
            @if (Auth::user()->rol==='admin') 
              <button type="button" class="btn btn-warning" href="">Editar eventos</button>
              &nbsp;
              <button type="button" class="btn btn-danger">Eliminar eventos</button> 
            @endif 
            <a type="button" class="btn btn-success"><i class="bi bi-heart"></i></a>
          @endauth
        </div>
      </div>
@endsection
