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
                                    <h3 class="mt-1 mb-5 pb-1 socialsneaker-text">Crea tu cuenta</h3>
                                </div>
                                <form action="{{ route('signup') }}" method="post" id="formulario">
                                    @csrf
                                    <div class="socialsneaker-text">
                                        <!-- Grupo: Nombre -->
                                        <div class="form-outline mb-4" id="grupo__name">
                                            <label for="name" class="form-label"><h5>Nombre</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" name="name" id="name">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras, números y guion bajo.</p>
                                        </div>
                                        <br>
                                        <!-- Grupo: Correo Electrónico -->
                                        <div class="formulario__grupo" id="grupo__email">
                                            <label for="email" class="form-label"><h5>Correo Electrónico</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="email" class="formulario__input" name="email" id="email">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">El correo solo puede contener letras, números, puntos, guiones y guion bajo.</p>
                                        </div>
                                        <br><br>
                                        <!-- Grupo: Fecha de Nacimiento -->
                                        <div class="formulario__grupo" id="grupo__fechaNacimiento">
                                            <label for="birthday" class="form-label"><h5>Fecha de Nacimiento</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="date" class="formulario__input" name="birthday" id="birthday" max="{{ now()->subYears(16)->format('Y-m-d') }}">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">Necesita tener mínimo 16 años para usar socialsneaker.</p>
                                        </div>
                                        <br><br>
                                        <!-- Grupo: Contraseña -->
                                        <div class="formulario__grupo" id="grupo__password">
                                            <label for="password" class="form-label"><h5>Contraseña</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password" id="password">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                                        </div>
                                        <br><br>
                                        <!-- Grupo: Contraseña 2 -->
                                        <!-- Grupo: Contraseña 2 (Confirmar Contraseña) -->
                                        <div class="formulario__grupo" id="grupo__password_confirmation">
                                            <label for="password_confirmation" class="form-label"><h5>Repetir Contraseña</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password_confirmation" id="password_confirmation">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                                        </div>
                                        <br><br>
                                        <!-- Grupo: Terminos y Condiciones -->
                                        <div class="formulario__grupo" id="grupo__terminos">
                                            <label class="form-label">
                                                <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
                                                Acepto los <a href="" class="socialsneaker-text">Terminos y Condiciones</a>
                                            </label>
                                        </div>
                                        <br><br>
                                        <div class="formulario__mensaje" id="formulario__mensaje">
                                            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
                                        </div>

                                        @if ($errors->any())
                                            <ul>
                                                <div class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                        {{$error}} <br>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        @endif

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-login socialsneaker-textbold">Registrarse</button>
                                            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
                                        </div>
                                    </div>
                                </form>

                                <br><br>
                                    <div class="text-center">
                                        <div class="form-text socialsneaker-text">¿Tiene ya cuenta? <br><br><a class="socialsneaker-textbold"  href="/loginForm">Inicia sesión</a></div>
                                    </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
