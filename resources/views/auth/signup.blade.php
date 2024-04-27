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
                                <form action="{{ route('signup') }}" method="post" onsubmit="return validateForm(event)">
                                    @csrf
                                    <div class="socialsneaker-text">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="name_sign"><h5>Nombre de usuario</h5></label>
                                            <input type="text" name="name" id="name_sign" value="{{old('name')}}" class="form-control" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="email_sign"><h5>Email address</h5></label>
                                            <input type="email" name="email" id="email_sign" value="{{old('email')}}" class="form-control" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="birthday_sign"><h5>Cumpleaños</h5></label><br>
                                            <input type="date" name="birthday" id="birthday_sign" max="{{ now()->subYears(16)->format('Y-m-d') }}"><br>
                                        </div>


                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password_sign"><h5>Contraseña</h5></label>
                                            <input type="password" id="password" name="password_sign" class="form-control" aria-describedby="passwordHelpBlock">
                                            <div id="passwordHelpBlock" class="form-text socialsneaker-text">
                                                La contraseña debe tener minimo 8 caracteres, preferiblemente deberia contener letras y números, y no contener espacios, caracteres especiales ni emoji.
                                            </div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label for="password_confirmation"><h5>Repite la contraseña</h5></label><br>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    @if ($errors->any())
                                        <ul>
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    {{$error}} <br>
                                                @endforeach
                                            </div>
                                        </ul>
                                    @endif
                                    <br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-login socialsneaker-textbold">Registrarse</button>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <div class="form-text socialsneaker-text">¿Tiene ya cuenta? <br><br><a class="socialsneaker-textbold"  href="/loginForm">Inicia sesión</a></div>
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
@endsection
