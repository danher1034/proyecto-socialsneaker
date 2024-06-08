<div class="row g-0 pop">
    <div class="col-md-6 img-column hide-on-small">
        <img src="{{ $collection->image_collection }}" alt="{{ $collection->image_collection }}" class="img-fluid rounded-start img-collection-show" />
    </div>
    <div class="col-md-6">
        <div class="d-flex align-items-center">
            <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle user-image">
            <div class="ms-3 flex-grow-1 d-flex flex-column">
                <h5 class="card-title mb-0">{{ $collection->user->name }}</h5>
                <small class="text-muted">{{ $collection->timeElapsed }}</small>
            </div>
            @if ($collection->user_id == Auth::id())
                <div class="dropdown">
                    <button class="dropbtn">⋮</button>
                    <div class="dropdown-content">
                        <a href="javascript:void(0)" class="show-popup-collection comment-button" data-edit-url="{{ route('collections/edit', $collection) }}"><i class="bi bi-pen-fill"></i>&nbsp;&nbsp;@lang('collection.edit')</a>
                        <a href="{{route('collections/destroy', $collection)}}" class="show-popup-collection comment-button"><i class="bi bi-trash"></i>&nbsp;&nbsp;@lang('collection.delete')</a>
                    </div>
                </div>
            @endif
        </div>
        <hr>
        <div class="card-body comments-users-show">
            <p class="card-text">
                <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle user-image-comment">
                <strong>{{ $collection->user->name }} </strong>{{ $collection->description }}
                @if ($collection->comments->count() > 0)
                    @foreach ($collection->comments as $comment)
                        <div class="d-flex align-items-center mb-1">
                            <img src="{{ $comment->user->image_user }}" alt="{{ $comment->user->name }}'s Image" class="img-fluid rounded-circle user-image-comment">
                            &nbsp;&nbsp;
                            <strong>{{ $comment->user->name }}</strong>
                            &nbsp;
                            {{ $comment->text }}
                        </div>
                    @endforeach
                @endif
            </p>
        </div>
        <hr>
        <div class="row like-comentario-show">
            <div class="col-1 like-show">
                @if (Auth::user()->likedCollections()->where('collection_id', $collection->id)->exists())
                    <a href="javascript:void(0)" class="like-button" data-id="{{ $collection->id }}"><i class="bi bi-heart-fill corazon-lleno"></i></a>
                @else
                    <a href="javascript:void(0)" class="like-button" data-id="{{ $collection->id }}"><i class="bi bi-heart corazon"></i></a>
                @endif
            </div>
            @if ($collection->sell == 1)
                <div class="col-1 sell-show">
                    <a type="button" class="btn btn-success sell-button-show" href="{{ route('chat.show', $collection->user_id) }}">@lang('collection.sell-b')</a>
                </div>
            @endif
            
        </div>
        <hr>
        <div class="comment-container">
            <form action="{{ route('collections/comment') }}" method="post" class="coment_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                <input type="text" name="text" id="input-coment-{{ $collection->id }}" placeholder="@lang('collection.addcomment')">
                <button type="submit" id="comment-{{ $collection->id }}" class="hidden">@lang('collection.send')</button>
            </form>
        </div>
    </div>
</div>


@vite(['resources/js/showcollection.js', 'resources/css/collection.css'])
