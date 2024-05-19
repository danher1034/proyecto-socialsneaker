@extends('layout')

@section('title', 'Chat')

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
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <ul class="list-unstyled chat-list mt-2 mb-0">
                    @foreach($users as $user)
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar{{ $loop->index + 1 }}.png" alt="avatar">
                        <div class="about">
                            <div class="name">
                                <a href="{{ route('chat.show', $user->id) }}">{{ $user->name }}</a>
                            </div>
                            <div class="status">Último mensaje que ha enviado</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/chat.js','resources/css/chat.css'])
@endsection
