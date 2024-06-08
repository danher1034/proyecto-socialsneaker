<h2 class="title-create">@lang('collection.titleadd')</h2><br>
<form class="collection_form" action="{{route('collections/update',$collection)}}" method="POST">
    @csrf
    @method('put')

    <div data-mdb-input-init class="form-outline mb-4">
        <label for="description">Descripción:</label>
        <input type="text" name="description" id="description" value="{{$collection->description}}" class="form-control">
        <br>
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
        <label for="tags" class="form-label">Etiquetas:</label>
        <input type="text" name="tags" id="tags" value="{{$collection->tags}}" class="form-control">
        <br>
    </div>

    @if($errors->any())
        Hay errores en el formulario: <br>
        @foreach ($errors->all() as $error)
            {{$error}} <br>
        @endforeach
    @endif

    <input type="submit" value="enviar">
</form>
