@extends('layout')

@section('title')

@endsection

@section('content')
    Nombre de usuario:{{Auth::user()->name}}
    <br><br>
    Email: {{Auth::user()->email}}
    <br><br>
    Año de nacimiento: {{Auth::user()->birthday}}
    <br><br>
    <a type="button" class="btn btn-warning" href="{{ route('users/edit', Auth::user()) }}">Editar</a>
@endsection
