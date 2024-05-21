@extends('layout')

@section('title')

@section('content')
    <div class="container-news">
        <div class="header-news">
            <nav>
                <span class="cat">Tecnología</span>
                <span class="cat">Programación</span>
                <span class="cat">Deportes</span>
                <span class="cat">Economía</span>
                <span class="cat">Educación</span>
            </nav>
            <button class="btn show-popup" data-edit-url="{{ route('users/edit', Auth::user()) }}">
                Editar perfil
            </button>
            <div class="busqueda">
                <input type="text" placeholder="Qué desea buscar" id="busqueda">
                <button>Buscar</button>
            </div>
        </div>

        <br><br>
        <div class="container-noticias">
            <div class="popup-container">
                <div class="popup-box"></div>
                <button class="close-btn"></button>
            </div>
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="container-noticias">
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="container-noticias">
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="container-noticias">
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                  <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
@vite(['resources/js/new.js', 'resources/css/new.css'])
@endsection
