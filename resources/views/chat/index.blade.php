@extends('layout')

@section('title')

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
                    @foreach($chats as $chat)
                    <li class="clearfix">
                        <a href="{{ route('chat.show', $chat->id) }}" class="user-link">
                            <img src="{{ $chat->image_user }}" alt="avatar">
                            <div class="about">
                                <div class="name"><strong>{{ $chat->name }}</strong></div>
                                <div class="status">{{ $chat->last_message_text ?? 'No messages yet' }}</div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/chat.js', 'resources/css/chat.css'])
@endsection

