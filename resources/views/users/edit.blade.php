@extends('layout')

@section('title')
    <h1>Editar usuario</h1>
@endsection

@section('content')
    <form action="{{route('users/update',$user)}}" method="POST">
        @csrf
        @method('put')
        <br>
        <div data-mdb-input-init class="form-outline mb-4">
            <label for="birthday">Cumpleaños:</label><br>
            <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}" class="form-control"><br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="newpassword"><div class="badge bg-secondary text-wrap" style="width: 6rem;">Opcional</div> Nueva contraseña:</label>
            <input type="password" id="newpassword" name="newpassword" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
                La contraseña debe tener minimo 8, preferiblemente deberia contener letras y números, y no contener espacios, caracteres especiales ni emoji.
            </div>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="newpassword_confirmation"><div class="badge bg-secondary text-wrap" style="width: 6rem;">Opcional</div> Repite la nueva contraseña:</label><br><br>
            <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control">
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Contraseña Actual:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>


        <br><br>

        @if($errors->any())
            Hay errores en el formulario: <br>
            @foreach ($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        @elseif(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        <input type="submit" value="enviar">
    </form>
@endsection
