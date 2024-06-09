@extends('layout')

@section('title')

@section('content')
<div class="container-news">
    <div class="header-news">
        <nav class="nav-news">
            <span class="cat" data-type="all">@lang('new.all')</span>
            <span class="cat" data-type="news">@lang('new.news')</span>
            <span class="cat" data-type="launch">@lang('new.launches')</span>
            <span class="cat" data-type="event">@lang('new.events')</span> 
        </nav>
        @if ( Auth::user()->rol == 'admin')
        <div class="admin-control">
            <button class="cat" data-type="novisible">@lang('new.novisible')</button>
            <button class="btn show-popup-edit" data-edit-url="{{ route('news/create') }}">
                @lang('new.addnew')
            </button>
        </div>
        @endif
        <div class="busqueda">
            <input type="text" placeholder="@lang('new.searchnew')" id="busqueda">
            <button id="searchButton">@lang('new.search')</button>
        </div>
    </div>

    <br><br>
    <div class="container-noticias">
        @forelse ($news as $new)
            @if ( Auth::user()->rol == 'admin' && $new->visible=='0')
                <div class="card-admin">
            @else
                <div class="card">
            @endif 
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <img src="{{ $new->image_news }}" class="img-fluid image-news"/>
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="title-line">
                        <div class="row">
                            <div class="col-9">
                                <a href="{{ $new->url }}"><h5 class="card-title">{{ $new->title }}</h5></a>
                            </div>
                            &nbsp;
                            @if ( Auth::user()->rol == 'admin')
                                <div class="col-1">
                                    <div class="dropdown">
                                        <button class="dropbtn">···</button>
                                        <div class="dropdown-content">
                                            <a href="javascript:void(0)" class="show-popup-new comment-button" data-edit-url="{{ route('news/edit', $new) }}"><i class="bi bi-pen-fill"></i>&nbsp;&nbsp;@lang('new.edit')</a>
                                            <a href="{{route('news/destroy', $new)}}" class="show-popup-new comment-button"><i class="bi bi-trash"></i>&nbsp;&nbsp;@lang('new.delete')</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="card-text">{{ $new->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>@lang('new.nonew')</p>
        @endforelse
    </div>
    <div class="popup-container-new">
        <div class="popup-box-new"></div>
        <button class="close-btn-new"></button>
    </div>
</div>
@vite(['resources/js/new.js', 'resources/css/new.css'])
@endsection

