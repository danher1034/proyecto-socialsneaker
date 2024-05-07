@extends('layout')

@section('title')
    <h1>Editar collectiono</h1>
@endsection

@section('content')
    <form action="{{route('collections/update',$collection)}}" method="POST">
        @csrf
        @method('put')

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" value="{{$collection->description}}" class="form-control">
            <br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="date" class="form-label" min="{{ now()->format('Y-m-d') }}">Fecha del collectiono:</label><br>
            <input type="date" name="date" id="date" value="{{$collection->date}}" class="form-control"><br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="tags" class="form-label">Etiquetas:</label>
            <input type="text" name="tags" id="tags" value="{{$collection->tags}}" class="form-control">
            <br>
        </div>

        @if($errors->any())
            Hay errores en el formulario: <br>
            @foreach ($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        @endif

        <input type="submit" value="enviar">
    </form>
@endsection