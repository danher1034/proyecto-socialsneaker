<header class="header">
    <div class="logo">
        <a href="/account"><img src="{{ asset(Auth::user()->image_user) }}" alt="Imagen de Perfil" class="nav-img-account"></a>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a class="nav-link" href="/collections"><i class="bi bi-house-door-fill"></i>&nbsp;&nbsp;<strong>@lang('partials.collection')</strong></a></li>
            <li><a class="nav-link" href="/news"><i class="bi bi-newspaper"></i>&nbsp;&nbsp;<strong>@lang('partials.news')</strong></a></li>
            <li><a class="show-popup-edit nav-link" data-edit-url="{{ route('collections/create') }}"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;<strong>@lang('partials.add')</strong></a></li>
            <li><a class="nav-link" href="/search"><i class="bi bi-search"></i>&nbsp;&nbsp;<strong>@lang('partials.search')</strong></a></li>
        </ul>
    </nav>
    <a class="btn-nav" href="/chat"><button>@lang('partials.chat')</button></a>
    <a onclick="openNav()" class="menu" href="#"><button>@lang('partials.menu')</button></a>
    <div id="mobile-menu" class="overlay">
        <a onclick="closeNav()" href="#" class="close">&times;</a>
        <div class="overlay-content">
            <br><br><br><br><br>
            <a href="/news">@lang('partials.news')</a>
            <a href="/search">@lang('partials.search')</a>                                                                                                              
            <a href="/collections">@lang('partials.collection')</a>
            <a href="/collections/create">@lang('partials.add')</a>
            <a href="/chat">@lang('partials.chat')</a>
        </div>
    </div>
</header>



