<h2 class="title-create">@lang('new.createnew')</h2><br>
<form action="{{ route('news/store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label" for="title"><h5>@lang('new.title')</h5></label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="description"><h5>@lang('new.description')</h5></label>
        <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="url"><h5>@lang('new.url')</h5></label>
        <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="tags"><h5>@lang('new.tags')</h5></label>
        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="type"><h5>@lang('new.type')</h5></label><br>
        <select name="type" id="type">
            <option value="news">@lang('new.newstype')</option>
            <option value="event">@lang('new.eventtype')</option>
            <option value="launch">@lang('new.launchtype')</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="image_news"><h5>@lang('new.imagenew')</h5></label>
        <input type="file" name="image_news" id="image_news" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="visible"><h5>@lang('new.visible')</h5></label>
        <input type="checkbox" name="visible" id="visible" value="1">
    </div>

    @if($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}} <br>
        @endforeach
    @endif

    <div class="button-container">
        <input type="submit" value="@lang('new.send')" class="button">
    </div>

    @vite(['resources/js/new.js', 'resources/css/new.css'])
</form>


