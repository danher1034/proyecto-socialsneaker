<!-- <nav class="navbar bg-secondary-subtle navbar-expand-lg bg-body-tertiary" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img id="logo-navbar" width="100px" height="100px" src="/storage/img/logo.png" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/collections">Collecciones</a>
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
</nav> -->

<!-- Navbar -->
<header class="header">
    <div class="logo">
        <a href="/account"><img src="{{ asset(Auth::user()->image_user) }}" alt="Imagen de Perfil"></a>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a class="nav-link" href="/collections">Colecciones</a></li>
        </ul>
    </nav>
    <a class="btn" href="#"><button>Contact</button></a>
    <a onclick="openNav()" class="menu" href="#"><button>Menu</button></a>
    <div id="mobile-menu" class="overlay">
        <a onclick="closeNav()" href="#" class="close">&times;</a>
        <div class="overlay-content">
            <a href="#">Services</a>
            <a href="#">Projects</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </div>
</header>

