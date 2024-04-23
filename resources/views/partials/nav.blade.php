<nav class="navbar bg-secondary-subtle navbar-expand-lg bg-body-tertiary" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img id="logo-navbar" width="100px" height="100px" src="/images/image-logo.png" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/events">Eventos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/players">Jugadores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/maps">¿Dónde estamos?</a>
            </li>
            @if (Auth::check() && Auth::user()->rol=='member')
                <li class="nav-item">
                    <a class="nav-link" href="/messages/create">Contacto</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/products">Tienda</a>
            </li>
            @if (Auth::check() && Auth::user()->rol=='admin')
                <li class="nav-item">
                    <a class="nav-link" href="/messages">Mensajes</a>
                </li>
            @endif
            </ul>
            <ul>
            @auth
                <div class="container-fluid mr-10">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{Auth::user()->name}} </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/account">Cuenta</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </div>
            @else
                <div class="d-flex align-items-center">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-secondary" role="button" href="/loginForm" aria-disabled="true">Login</a>
                        <a class="btn btn-secondary" role="button" href="/signupForm" aria-disabled="true">Sign up</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
