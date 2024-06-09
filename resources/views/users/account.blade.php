@extends('layout')

@section('title')
<br><br>
@endsection

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-3 img_account">
            <img src="{{ asset($user->image_user) }}" alt="Imagen de Perfil" class="img-fluid img_user_account">
        </div>
        <div class="col">
            <div class="row align-center-row mb-1">
                <div class="col-2 title-user"><strong>{{ $user->name }}</strong></div>
                <div class="col-1 col-md-4 d-flex align-items-center justify-content-end actions">
                    @if ($user->id == Auth::id())
                    <button class="btn show-popup-edit" data-edit-url="{{ route('users/edit', $user) }}">
                        @lang('user.editprofile')
                    </button>
                    <div class="dropdown">
                        <button class="dropbtn">⋮</button>
                        <div class="dropdown-content">
                            <a href="{{ route('logout') }}">@lang('user.signout')</a>
                            <a href="#" id="delete-account">@lang('user.deleteaccount')</a>
                            <div class="dropdown-i">
                                <button class="dropbtn-i">@lang('user.lang')</button>
                                <div class="dropdown-content-i">
                                    <a class="dropdown-item" href="locale/es"><img alt="es" class="img-fluid img_lang_account" src="/storage/img/espana.png"></a>
                                    <a class="dropdown-item" href="locale/en"><img alt="en" class="img-fluid img_lang_account" src="/storage/img/estados-unidos.png"></a>
                                    <a class="dropdown-item" href="locale/cn"><img alt="cn" class="img-fluid img_lang_account" src="/storage/img/chino.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="delete-account-form" action="{{ route('users/delete', $user->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    @else
                        <button type="button" class="btn me-3 btn-follow" id="follow-button" data-user-id="{{ $user->id }}">
                            {{ Auth::user()->following()->where('user_id', $user->id)->exists() ? __('user.followed') : __('user.follow') }}
                        </button>
                        <a href="{{ route('chat.show', $user->id) }}" class="btn btn-sendmessage">@lang('user.sendmessage')</a>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <strong>@lang('user.collections')</strong><br>
                    {{ $collectionsCount }}
                </div>
                &nbsp;
                <div class="col-4">
                    <strong>@lang('user.followers')</strong><br>
                    {{ $followersCount }}
                </div>
                &nbsp;
                <div class="col-3">
                    <strong>@lang('user.followed')</strong><br>
                    {{ $followingCount }}
                </div>
            </div>
        </div>
        <br>
        <hr class="line-account">
        <br><br>
    </div>
    <div class="container-account">
        @forelse ($collections as $collection)
            <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <a href="javascript:void(0)" class="show-popup-collection comment-button" data-edit-url="{{ route('collections/show', $collection) }}"><img src="{{$collection->image_collection}}" alt="{{$collection->image_collection}}" class="img-fluid rounded-start d-block mx-auto img-collection-account"/></a>
                </div>
            </div>
        @empty
            <div class="text-center">
                <i class="bi bi-camera icon-camera"></i>
                <br><br>
                <p>@lang('user.textnocolection')</p>
            </div>
        @endforelse
    </div>
</div>
    <div class="popup-container-collection">
        <div class="popup-box-collection"></div>
        <button class="close-btn-collection"></button>
    </div>


    @vite(['resources/css/account.css','resources/js/account.js','resources/js/showcollection.js'])
@endsection
