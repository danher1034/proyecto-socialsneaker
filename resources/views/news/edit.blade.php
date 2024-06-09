<h2 class="title-create">@lang('new.editnew')</h2><br>
<form action="{{ route('news/update', $news->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label" for="title"><h5>@lang('new.title')</h5></label>
        <input type="text" name="title" id="title" value="{{ $news->title }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="description"><h5>@lang('new.description')</h5></label>
        <input type="text" name="description" id="description" value="{{ $news->description }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="url"><h5>@lang('new.url')</h5></label>
        <input type="text" name="url" id="url" value="{{ $news->url }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="tags"><h5>@lang('new.tags')</h5></label>
        <input type="text" name="tags" id="tags" value="{{ $news->tags }}" class="form-control">
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="type"><h5>@lang('new.type')</h5></label><br>
        <select name="type" id="type" class="form-control">
            <option value="news" {{ $news->type == 'news' ? 'selected' : '' }}>@lang('new.newstype')</option>
            <option value="event" {{ $news->type == 'event' ? 'selected' : '' }}>@lang('new.eventtype')</option>
            <option value="launch" {{ $news->type == 'launch' ? 'selected' : '' }}>@lang('new.launchtype')</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="visible"><h5>@lang('new.visible')</h5></label>
        <input type="checkbox" name="visible" id="visible" {{ $news->visible ? 'checked' : '' }}>
    </div>

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="button-container">
        <input type="submit" value="@lang('new.send')" class="btn btn-primary">
    </div>
</form>
