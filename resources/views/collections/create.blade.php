    <h2 class="title-create">@lang('collection.titleadd')</h2><br>
    <form action="{{ route('collections/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="description"><h5>@lang('collection.description')</h5></label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" for="tags"><h5>@lang('collection.labels')</h5></label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" for="image_collection"><h5>@lang('collection.imagenews')</h5></label>
            <input type="file" name="image_collection" id="image_collection" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" for="sell"><h5>@lang('collection.sell')</h5></label>
            <input type="checkbox" name="sell" id="sell" value="1">
        </div>

        @if($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        @endif
        <br>
        <div class="button-container">
            <input type="submit" value="@lang('collection.send')" class="button">
        </div>
    </form>
    <br><br>


