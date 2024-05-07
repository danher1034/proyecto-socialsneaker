@extends('layout')

@section('title')
    <h1 class="h2">Crear collectiono</h1>
    <br>
@endsection

@section('content')
    <form action="{{route('collections/store')}}" method="POST">
        @csrf

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="description" class="form-label">Descripcion:</label>
            <textarea name="description" id="description" value="{{old('description')}}" rows="3" class="form-control"></textarea>
            <br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="date" class="form-label">Fecha del collectiono:</label><br>
            <input type="date" name="date" id="date" class="form-control" min="{{ now()->format('Y-m-d') }}"><br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="tags" class="form-label">Etiquetas:</label>
            <textarea name="tags" id="tags" value="{{old('tags')}}"  rows="3" class="form-control"></textarea>
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
    <br><br>
@endsection