@extends('layout')

@section('title')

@endsection

@section('content')
    <h1>Se ha editado con exito</h1>
    <br>
    <br>
    <a href="{{ route('account')}}">Volver</a>

    <div class="center">
        <button id="show-login">Login</button>
    </div>
    <div class="popup">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2>Log in</h2>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Enter email">
            </div>
            <div>

            </div>
        </div>
    </div>

@endsection
