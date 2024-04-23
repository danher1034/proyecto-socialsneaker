@extends('layout')

@section('title')
    <h1 class="h2">Crea tu cuenta</h1>
    <br>
@endsection

@section('content')
    <form action="{{route('signup')}}" method="POST">
        @csrf

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="name">Nombre usuario</label>
            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email address</label>
            <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="birthday">Cumpleaños:</label><br>
            <input type="date" name="birthday" id="birthday" max="{{ now()->subYears(16)->format('Y-m-d') }}"><br>
        </div>


        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
                La contraseña debe tener minimo 8, preferiblemente deberia contener letras y números, y no contener espacios, caracteres especiales ni emoji.
            </div>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="password_confirmation">Repite la contraseña:</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <br><br>

        <input type="submit" value="Enviar"><br><br>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
@endsection
