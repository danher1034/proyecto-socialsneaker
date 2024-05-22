<h2 class="title-create">Crear noticia</h2><br>
<form action="{{ route('news/store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label" for="title"><h5>Título</h5></label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="description"><h5>Descripción</h5></label>
        <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="url"><h5>Url</h5></label>
        <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="tags"><h5>Etiquetas</h5></label>
        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="type"><h5>Tipo</h5></label><br>
        <select name="type" id="type">
            <option value="news">Noticia</option>
            <option value="event">Evento</option>
            <option value="launch">Lanzamiento</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="image_news"><h5>Imagen noticia</h5></label>
        <input type="file" name="image_news" id="image_news" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label" for="visible"><h5>Visible</h5></label>
        <input type="checkbox" name="visible" id="visible" value="1">
    </div>

    @if($errors->any())
        Hay errores en el formulario: <br>
        @foreach ($errors->all() as $error)
            {{$error}} <br>
        @endforeach
    @endif

    <div class="button-container">
        <input type="submit" value="Enviar" class="button">
    </div>

    @vite(['resources/js/new.js', 'resources/css/new.css'])
</form>


