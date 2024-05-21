<div class="mb-5 mt-5 row row-cols-1 row-cols-md-1 row-cols-xl-1 g-2 row justify-content-center">
    <div class="card mb-3" style="max-width: 1940px;">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ $collection->image_collection }}" alt="{{ $collection->image_collection }}" class="img-fluid rounded-start img-collection" />
            </div>
            <div class="col-md-7">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle user-image">
                    <div class="ms-3 flex-grow-1 d-flex flex-column">
                        <h5 class="card-title mb-0">{{ $collection->user->name }}</h5>
                        <small class="text-muted">{{ $collection->timeElapsed }}</small>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <p class="card-text">
                        <strong>{{ $collection->user->name }} </strong>{{ $collection->description }}
                        @if ($collection->comments->count() > 0)
                            @foreach ($collection->comments as $comment)
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $comment->user->image_user }}" alt="{{ $comment->user->name }}'s Image" class="img-fluid rounded-circle user-image-comment">
                                    &nbsp;&nbsp;
                                    <strong>{{ $comment->user->name }}</strong>
                                    &nbsp;
                                    {{ $comment->text }}
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </p>
                    <div class="comment-container">
                        <form action="{{ route('collections.comment') }}" method="post" class="coment_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                            <input type="text" name="text" id="input-coment-{{ $collection->id }}" placeholder="Añade un comentario...">
                            <button type="submit" id="comment-{{ $collection->id }}" class="hidden">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/showcollection.js', 'resources/css/collection.css'])
