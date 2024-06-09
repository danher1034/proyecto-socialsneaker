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
                                    <h3 class="mt-1 mb-5 pb-1 socialsneaker-text">@lang('login.sign')</h3>
                                </div>
                                <form action="{{ route('signup') }}" method="post" id="formulario">
                                    @csrf
                                    <div class="socialsneaker-text">
                                        <div class="form-outline mb-4" id="grupo__name">
                                            <label for="name" class="form-label"><h5>@lang('login.namesign')</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" name="name" id="name">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">@lang('login.errorname')</p>
                                        </div>
                                        <br>
                                        <div class="formulario__grupo" id="grupo__email">
                                            <label for="email" class="form-label"><h5>@lang('login.emailsign')</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="email" class="formulario__input" name="email" id="email">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">@lang('login.erroremail')</p>
                                        </div>
                                        <br><br>
                                        <div class="formulario__grupo" id="grupo__fechaNacimiento">
                                            <label for="birthday" class="form-label"><h5>@lang('login.datesign')</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="date" class="formulario__input" name="birthday" id="birthday" max="{{ now()->subYears(16)->format('Y-m-d') }}">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">@lang('login.errordate')</p>
                                        </div>
                                        <br><br>
                                        <div class="formulario__grupo" id="grupo__password">
                                            <label for="password" class="form-label"><h5>@lang('login.passwordsign')</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password" id="password">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">@lang('login.errorpassword')</p>
                                        </div>
                                        <br><br>
                                        <div class="formulario__grupo" id="grupo__password_confirmation">
                                            <label for="password_confirmation" class="form-label"><h5>@lang('login.passwordrepeatsign')</h5></label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password_confirmation" id="password_confirmation">
                                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                            </div>
                                            <p class="formulario__input-error">@lang('login.errorrepeat')</p>
                                        </div>
                                        <br><br>
                                        <div class="formulario__grupo" id="grupo__terminos">
                                            <label class="form-label">
                                                <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
                                                @lang('login.acept') <a href="https://european-union.europa.eu/privacy-policy-european-union-website_es" class="socialsneaker-text">@lang('login.termsandconditions')</a>
                                            </label>
                                        </div>
                                        <br><br>
                                        <div class="formulario__mensaje" id="formulario__mensaje">
                                            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> @lang('login.errorform') </p>
                                        </div>

                                        @if ($errors->any())
                                            <ul>
                                                <div class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                        {{$error}} <br>
                                                    @endforeach
                                                </div>
                                            </ul>
                                            <br>
                                        @endif

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-login socialsneaker-textbold">@lang('login.btnsign')</button>
                                            <div class="dropdown-i">
                                                <button type="button" class="dropbtn-i"><img alt="es" class="img-fluid img_lang_account" src="/storage/img/world.png"></button>
                                                <div class="dropdown-content-i">
                                                    <a class="dropdown-item" href="locale/es"><img alt="es" class="img-fluid img_lang_account" src="/storage/img/espana.png"></a>
                                                    <a class="dropdown-item" href="locale/en"><img alt="en" class="img-fluid img_lang_account" src="/storage/img/estados-unidos.png"></a>
                                                    <a class="dropdown-item" href="locale/cn"><img alt="cn" class="img-fluid img_lang_account" src="/storage/img/chino.png"></a>
                                                </div>
                                            </div>
                                            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">@lang('login.exitform')</p>
                                        </div>
                                    </div>
                                </form>

                                <br><br>
                                    <div class="text-center">
                                        <div class="form-text socialsneaker-text">@lang('login.questionsign') <br><br><a class="socialsneaker-textbold"  href="/loginForm">@lang('login.loginaccess')</a></div>
                                    </div>
                                <br><br>
                            </div>
                        </div>                                                                                                                                                  
                    </div>
                </div>
            </div>
        </div>
        @vite(['resources/js/signup.js','resources/css/signup.css'])
    </section>
@endsection
