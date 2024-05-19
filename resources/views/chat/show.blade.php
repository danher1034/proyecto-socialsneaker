@extends('layout')

@section('title', 'Chat with ' . $receiver->name)

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0">{{ $receiver->name }}</h6>
                                <small>Last seen: 2 hours ago</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-history">
                    <ul class="m-b-0">
                        @foreach($messages as $message)
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">{{ $message->hour }}, {{ $message->date }}</span>
                                <span class="message-data-name">{{ $message->user->id == Auth::id() ? 'Me' : $message->user->name }}</span>
                            </div>
                            <div class="message {{ $message->user->id == Auth::id() ? 'my-message' : 'other-message float-right' }}">
                                {{ $message->text }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat-message clearfix">
                    <form action="{{ route('chat.store', $receiver->id) }}" method="POST">
                        @csrf
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-send"></i></span>
                            </div>
                            <input type="text" name="text" class="form-control" placeholder="Enter text here...">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/chat.js','resources/css/chat.css'])
@endsection
