@extends('layout')

@section('title')
    <br>
@endsection

@section('content')
<section class="h-100 gradient-form d-flex justify-content-center">
    <div class="container-fluid py-5 my-auto">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card rounded-3 text-black socialsneaker-login">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h1 class="mt-1 mb-5 pb-1 socialsneaker-titletext">SOCIALSNEAKER</h1>
                                <h3 class="mt-1 mb-5 pb-1 socialsneaker-text">Inicia sesión</h3>
                            </div>
                            <form action="{{ route('login') }}" method="POST"> <!-- Formulario para iniciar sesión -->
                                @csrf
                                <div class="socialsneaker-text">
                                    <div class="mb-3"> <!-- Campo para el nombre del usuario -->
                                        <label class="form-label" for="name"><h5>Nombre de usuario</h5></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                                        <div class="form-text socialsneaker-text">Introduce tu nombre de usuario</div>
                                    </div>
                                    <br><br>
                                    <div class="mb-3"> <!-- Campo para la contraseña del usuario -->
                                        <label class="form-label" for="password"><h5>Contraseña</h5></label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <div class="form-text socialsneaker-text">Introduce tu contraseña</div>
                                    </div>
                                </div>
                                <br>
                                @if(isset($error))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endif
                                <br>
                                <div class="text-center">
                                    <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-login socialsneaker-textbold">
                                </div>
                                <br><br>
                                <div class="text-center">
                                    <div class="form-text socialsneaker-text">¿No tienes cuenta aún? <br><br><a class="socialsneaker-textbold" href="/signupForm">Registrate gratis</a></div>
                                </div>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@vite(['resources/css/signup.css'])
@endsection
