<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Luckiest+Guy&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    @if (Auth::check())
            <body class="d-flex flex-column min-vh-100 backgroud-check">
        @else
            <body class="d-flex flex-column min-vh-100 backgroud-nocheck">
        @endif

        @auth
            @include('partials.nav')  {{-- Para poner el navbar en el layout de la aplicacion --}}
        @endauth


        <div class="container">
            <div class="popup-container">
                <div class="popup-box"></div>
                <button class="close-btn"></button>
            </div>
            @yield('title')
        </div>

        <div class="container">
            @yield('content')
        </div>
        @auth
            @include('partials.footer') {{-- Para poner el footer en el layout de la aplicacion --}}
        @endauth
    </body>
</html>
