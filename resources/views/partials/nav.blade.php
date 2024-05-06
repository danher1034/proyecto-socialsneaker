<nav class="navbar bg-secondary-subtle navbar-expand-lg bg-body-tertiary" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img id="logo-navbar" width="100px" height="100px" src="/storage/img/logo.png" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/events">Eventos</a>
            </li>
            </ul>
            <ul>
            <div class="container-fluid mr-10">
                <div class="logo">
                    <a href="/account"><img src="{{ asset(Auth::user()->image_user) }}" alt="Imagen de Perfil"></a>
                </div>
            </div>
        </div>
    </div>
</nav>
