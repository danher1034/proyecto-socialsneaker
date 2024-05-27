    <h2 class="title-create">Crear noticia</h2><br>
    <form action="{{ route('collections/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="description"><h5>Descripción</h5></label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" for="tags"><h5>Etiquetas</h5></label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" for="image_collection"><h5>Imagen noticia</h5></label>
            <input type="file" name="image_collection" id="image_collection" class="form-control">
        </div>

        @if($errors->any())
            Hay errores en el formulario: <br>
            @foreach ($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        @endif
        <br>
        <div class="button-container">
            <input type="submit" value="Enviar" class="button">
        </div>
    </form>
    <br><br>


