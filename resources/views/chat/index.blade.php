@extends('layout')

@section('title')

@endsection

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div id="plist" class="people-list">
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" id="search" class="form-control" placeholder="Search...">
                </div>
                <ul id="user-results" class="list-unstyled chat-list mt-2 mb-0">
                    @foreach($users as $user)
                    <li class="clearfix">
                        <a href="{{ route('chat.show', $user->id) }}" class="user-link">
                            <img src="https://bootdey.com/img/Content/avatar/avatar{{ $loop->index + 1 }}.png" alt="avatar">
                            <div class="about">
                                <div class="name">{{ $user->name }}</div>
                                <div class="status">Último mensaje que ha enviado</div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/chat.js','resources/css/chat.css'])
@endsection
