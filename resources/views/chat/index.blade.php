@extends('layout')

@section('title')
<br><br>
@endsection

@section('content')
<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div id="plist" class="people-list">
                <br>
                <h2 class="text-center">@lang('partials.chat')</h2>
                <br>
                <span id="loader" class="loader" style="display: none;"></span>
                <div id="user-results">
                    <ul id="chat-list" class="list-unstyled chat-list mt-2 mb-0">
                        @if($chats->isEmpty())
                            <br><br><br>
                            <li class="clearfix text-center">
                                <i class="bi bi-chat-text icon-chat"></i>
                                <br><br>
                                <p>@lang('chat.nochat')</p>
                            </li>
                        @else
                            @foreach($chats as $chat)
                            <li class="clearfix">
                                <a href="{{ route('chat.show', $chat->id) }}" class="user-link">
                                    <img src="{{ $chat->image_user }}" alt="avatar">
                                    <div class="about">
                                        <div class="name"><strong>{{ $chat->name }}</strong></div>
                                        <div class="status">{{ $chat->last_message_text ??  __('chat.nomessages') }}</div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const translations = {
        search: @json(__('chat.search')),
        nosearch: @json(__('chat.nochat'))
    };
</script>

@vite(['resources/js/chat.js', 'resources/css/chat.css'])
@endsection
