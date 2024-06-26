@extends('layout')

@section('title')
@endsection

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <br>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="{{ $receiver->image_user }}" alt="avatar" class="img-fluid" style="max-height: 50px; margin-right: 10px;">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0"><strong>{{ $receiver->name }}</strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-history">
                    <ul class="m-b-0">
                        @foreach($messages as $message)
                        <li class="clearfix">
                            @if ($message->user->id == Auth::id())
                                <div class="message other-message float-right">
                                    {{ $message->text }}
                                </div>
                            @else
                                <div class="message my-message">
                                    {{ $message->text }}
                                </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat-message clearfix chat-send">
                    <form id="message-form" action="{{ route('chat.store', $receiver->id) }}" method="POST">
                        @csrf
                        <div class="input-group mb-0 busqueda">
                            <input type="text" name="text" id="message-text" class="form-control" placeholder="@lang('chat.message')">
                            <button type="submit" class="input-group-text"><i class="fa fa-send color-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/chat.js','resources/css/chat.css'])
@endsection
